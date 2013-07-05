<?php
  /*
  check.php
  
  Handles any logic related to comparing old and new friends lists to derive which friends
  were added, deleted, deactivated, etc. Updates records on database regarding changes
  in friends list and user activity.
  */

  require('logic/fb_user.php');
  
  if($user) {
    // User is logged in
    
    // Get the specified date to view
    if(isset($_REQUEST['d']))
      $date = $_REQUEST['d'];
    else
      $date = date('dmY');
      
    // Make sure date's in correct format
    if(!preg_match('/^\d{8}$/', $date))
      $date = date('dmY');
    
    //parse the date into appropriate date/month/year
    $date_day = substr($date, 0, 2);
    $date_month = substr($date, 2, 2);
    $date_year = substr($date, 4, 4);
    $time_date = mktime(0, 0, 0, $date_month, $date_day, $date_year); // UNIX timestamp of specified date
    $first_time = false; // is this their first time using the app?
    $date_display = null; // date to display in view
    // $date_join = date('dmY', $user_time);
    // $date_join_display = date('B d, Y', $user_time);
    $friends_changed = array(); // friends that have either been added or removed
    $user_last_check = time();
    // put together the string representing the current date to be displayed
    if($date_day == date('d', time()) && $date_month == date('m', time()) && $date_year == date('Y', time()))
      $date_display = "Today";
    else {
      $date_timestamp = strtotime($date_month.'/'.$date_day.'/'.$date_year);
      $date_display = strftime('%B %d, %Y', $date_timestamp);
    }

    if(!$user_exists) {
      // This is the first time the user's used the application
      $first_time = true;
      $user_friends_json = mysql_real_escape_string($user_friends_json);
      // mysql_query('INSERT INTO users (id, time, last_check, user_id, user_friends_json, access_token) VALUES (\'\', \''.time().'\', \''.time().'\', \''.$user.'\', \''.$user_friends_json.'\', \''.$user_access_token.'\')')or die(mysql_error());
      $db->query('INSERT INTO users (id, time, last_check, user_id,
                  user_friends_json, access_token) VALUES 
                  (\'\', \''.time().'\', \''.time().'\', \''.$user.'\', \''.$user_friends_json.'\', \''.$user_access_token.'\')');
    } else {
      // User has used app before
      // $user_friends_json_old = mysql_result($q, 0, 'user_friends_json');
      // $user_last_check = mysql_result($q, 0, 'last_check');
      $user_friends_json_old = $db->getResult('', 0, 'user_friends_json');
      $user_last_check = $db->getResult('', 0, 'last_check');
      $changes = false;
      
      if($user_friends_json_old != $user_friends_json) {
        // User's friends list has changed since his/her last visit
        $friends_array_old = json_decode($user_friends_json_old, true);
        $friends_array_new = $user_friends_array['data'];
        $friends_hashtable = array();

        
        /*
          Compare old friends list to new one. There's 3 posibilities:
          1. old friend exists in new friends list: Nothing has happened
          2. old friend does  not exist in new friends list, in which case:
            i) If we can obtain that friend's data, it's marked as a deletion
            ii) if an exception is caught (can't obtain friend's data) we
                assume they've deactivated their account. Although other 
                possibilities are possible (blocked friend, blocked app)
                they're all classified under "deactivated" for now.
        */
        foreach($friends_array_new as $friend) {
          $friends_hashtable['\''.$friend['id'].'\''] = 1;
        }
        
        foreach($friends_array_old as $friend) {
          if(!isset($friends_hashtable['\''.$friend['id'].'\''])) {
            $type = ActionTypes::deleted;
            try {
              $facebook->api('/'.$friend['id']);
            } catch (FacebookApiException $e) {
              $type = ActionTypes::deactivated;
            }
            // mysql_query('INSERT INTO history (id, user_id, friend_id, friend_name, type, time) VALUES (\'\', \''.$user.'\', \''.$friend['id'].'\', \''.$friend['name'].'\', \''.$type.'\', \''.time().'\')')or die(mysql_error());
            $db->query('INSERT INTO history (id, user_id, friend_id, friend_name, type, time)
            VALUES (\'\', \''.$user.'\', \''.$friend['id'].'\', \''.$friend['name'].'\', \''.$type.'\', \''.time().'\')');
          }
        }
        
        /*
          Compare new friends list to old one. There's only 2 posibilities:
          1. new friend exists in old friends list: Nothing has happened
          2. new friend does  not exist in new friends list:
            i) If the new friend is previously stored in history as deactivated,
               he/she must've reactivated the account.
            ii) else, new friend was added!
        */
        $friends_hashtable = array(); // reset the hashtable
        foreach($friends_array_old as $friend)
          $friends_hashtable['\''.$friend['id'].'\''] = 1;
        
        foreach($friends_array_new as $friend) {
          if(!isset($friends_hashtable['\''.$friend['id'].'\''])) {
            $q = 'SELECT * FROM history WHERE user_id = \''.$user.'\' AND type = \'2\' AND friend_id = \''.$friend['id'].'\' ORDER BY id DESC LIMIT 1';
            
            if($db->getNumRows($q) == 1)
              $type = ActionTypes::reactivated;
            else
              $type = ActionTypes::added;
              
            $db->query('INSERT INTO history (id, user_id, friend_id, friend_name, type, time) VALUES (\'\', \''.$user.'\', \''.$friend['id'].'\', \''.$friend['name'].'\', \''.$type.'\', \''.time().'\')');
          }
        }
        
        $user_friends_json = mysql_real_escape_string($user_friends_json);
        // mysql_query('UPDATE users SET `user_friends_json` = \''.$user_friends_json.'\' WHERE `user_id` = \''.$user.'\'')or die(mysql_error());
        $db->query('UPDATE users SET `user_friends_json` = \''.$user_friends_json.'\' WHERE `user_id` = \''.$user.'\'');
      }
      
      // mysql_query('UPDATE users SET `last_check` = \''.time().'\' WHERE `user_id` = \''.$user.'\'')or die(mysql_error());
      $db->query('UPDATE users SET `last_check` = \''.time().'\' WHERE `user_id` = \''.$user.'\'');
    }
    
    $q = 'SELECT * FROM history WHERE user_id = \''.$user.'\' AND time > \''.$time_date.'\' AND time < \''.($time_date + 24 * 60 * 60).'\'';
    $db->query($q, true);
    $history_res = $db->fetchArray();
    
    foreach($history_res as $friend) {
      $friend_show = array('name' => $friend['friend_name'],
                              'id' => $friend['friend_id'], 
                              'time' => date('h:i a', $friend['time']),
                              'time_unix' => $friend['time'], 
                              'type' => $friend['type']);
      
      $friends_changed[] = $friend_show;
    }

    $smarty->assign('first_time', $first_time);
    $smarty->assign('time_tomorrow', mktime(0, 0, 0, date('n'), date('j'), date('Y')) + 24 * 60 * 60);
    $smarty->assign('user_time', $user_time);
    $smarty->assign('date_join', 
    $smarty->assign('time_date', $time_date);
    $smarty->assign('friends_changed', $friends_changed);
    $smarty->assign('date_display', $date_display);
    // $smarty->assign('date_join', $date_join);
    // $smarty->assign('date_join_display', $date_join_display);
    $smarty->assign('user_last_check', $user_last_check);
  }
?>