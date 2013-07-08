<?php
  /*
  check.php
  
  Handles any logic related to comparing old and new friends lists to derive which friends
  were added, deleted, deactivated, etc. Updates records on database regarding changes
  in friends list and user activity.
  */

  $fbUser = new FBUser($facebook);
  $appUser = new AppUser($fbUser->getId(), $db);

  if($fbUser->getId()) {
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
    $first_time = ($appUser->getId() ? false : true); // is this their first time using the app?
    $date_display = null; // date to display in view
    $date_join = date('dmY', $appUser->getJoinTime());
    $date_join_display = date('F d, Y', $appUser->getJoinTime());
    $friends_changed = array(); // friends that have either been added or removed
    
    // put together the string representing the current date to be displayed
    if($date_day == date('d', time()) && $date_month == date('m', time()) && $date_year == date('Y', time()))
      $date_display = "Today";
    else {
      $date_timestamp = strtotime($date_month.'/'.$date_day.'/'.$date_year);
      $date_display = strftime('%B %d, %Y', $date_timestamp);
    }
    
    if($first_time) {
      $friends_insert = mysql_real_escape_string($fbUser->getFriends('json'));
      $db->runQuery('INSERT INTO users (id, time, last_check, user_id,
                  user_friends_json, access_token) VALUES 
                  (\'\', \''.time().'\', \''.time().'\', \''.$fbUser->getId().'\', \''.$friends_insert.'\', \''.$fbUser->getAccessToken().'\')');
    
    } else {
      // User has used app before  

      if($appUser->getFriends('json') != $fbUser->getFriends('json')) {
        // User's friends list has changed since his/her last visit
        $friends_compare = array();

        foreach($fbUser->getFriends('array') as $friend) {
          $friends_compare['\''.$friend['id'].'\''] = 1;
        }
        
        foreach($appUser->getFriends('array') as $friend) {
          if(!isset($friends_compare['\''.$friend['id'].'\''])) {
            $type = ActionTypes::deleted;
            try {
              $facebook->api('/'.$friend['id']);
            } catch (FacebookApiException $e) {
              $type = ActionTypes::deactivated;
            }
            $db->runQuery('INSERT INTO history (id, user_id, friend_id, friend_name, type, time)
            VALUES (\'\', \''.$fbUser->getId().'\', \''.$friend['id'].'\', \''.$friend['name'].'\', \''.$type.'\', \''.time().'\')');
          }
        }
        

        $friends_compare = array(); // reset the hashtable
        
        foreach($appUser->getFriends('array') as $friend)
          $friends_compare['\''.$friend['id'].'\''] = 1;
        
        foreach($fbUser->getFriends('array') as $friend) {
          if(!isset($friends_compare['\''.$friend['id'].'\''])) {
            $db->setQuery('SELECT * FROM history WHERE user_id = \''.$fbUser->getId().'\' AND type = \'2\' AND friend_id = \''.$friend['id'].'\' ORDER BY id DESC LIMIT 1');
            
            if($db->getNumRows() == 1)
              $type = ActionTypes::reactivated;
            else
              $type = ActionTypes::added;
              
            $db->runQuery('INSERT INTO history (id, user_id, friend_id, friend_name, type, time) VALUES (\'\', \''.$fbUser->getId().'\', \''.$friend['id'].'\', \''.$friend['name'].'\', \''.$type.'\', \''.time().'\')');
          }
        }

        $friends_insert = mysql_real_escape_string($fbUser->getFriends('json'));
        $db->runQuery('UPDATE users SET `user_friends_json` = \''.$friends_insert.'\' WHERE `user_id` = \''.$fbUser->getId().'\'');
      }

      $db->runQuery('UPDATE users SET `last_check` = \''.time().'\' WHERE `user_id` = \''.$fbUser->getId().'\'');
    }
    
    // Fetch history for today only
    $q = mysql_query('SELECT * FROM history WHERE user_id = \''.$fbUser->getId().'\' AND time > \''.$time_date.'\' AND time < \''.($time_date + 24 * 60 * 60).'\'');

    while($friend = mysql_fetch_array($q)) {
      $friend_show = array('name' => $friend['friend_name'],
                              'id' => $friend['friend_id'], 
                              'time' => date('h:i a', $friend['time']),
                              'time_unix' => $friend['time'], 
                              'type' => $friend['type']);
      
      $friends_changed[] = $friend_show;
    }
  
    $smarty->assign('user_id', $fbUser->getId());
    $smarty->assign('user_name', $fbUser->getName());
    $smarty->assign('first_time', $first_time);
    $smarty->assign('time_tomorrow', mktime(0, 0, 0, date('n'), date('j'), date('Y')) + 24 * 60 * 60);
    $smarty->assign('user_time', $appUser->getJoinTime());
    $smarty->assign('time_date', $time_date);
    $smarty->assign('friends_changed', $friends_changed);
    $smarty->assign('date_display', $date_display);
    $smarty->assign('date_join', $date_join);
    $smarty->assign('date_join_display', $date_join_display);
    $smarty->assign('user_last_check', $appUser->getLastCheck());
  }
?>