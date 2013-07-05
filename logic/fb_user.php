<?php
  /*
    fb_user.php
    
    Checks for user authentication with Facebook. Sets necessary user related
    variables to be used.
   */
  
  $user = $facebook->getUser();
  $user_profile = null;
  $user_friends_json = '';
  
  $access_token = $facebook->getAccessToken();
  
  // Function copied from: http://stackoverflow.com/questions/7933228/convert-utf8-characters-returned-from-facebook-graph-api
  function unicode_decode($string) {
      $string = preg_replace_callback('#\\\\u([0-9a-f]{4})#ism',
      create_function('$matches', 'return mb_convert_encoding(pack("H*", $matches[1]), "UTF-8", "UCS-2BE");'), 
      $string);

      return $string;
  }

  if($user) {
    try {
      $db->query('SELECT * FROM users WHERE user_id = \''.$user.'\' LIMIT 1', true);
      $user_exists = $db->getNumRows('SELECT * FROM users WHERE user_id = \''.$user.'\' LIMIT 1');
      $user_access_token = $facebook->getAccessToken();
      $user_profile = $facebook->api($user, 'GET');
      $user_friends_array = $facebook->api('/'.$user.'/friends?fields=id,name&limit=0', 'GET');
      $user_friends_json = unicode_decode(json_encode($user_friends_array['data']));
      //$user_time = mysql_result($q, 0, 'time');
      $user_time = $db->getResult('', 0, 'time');
    } catch (FacebookApiException $e) {
      $e_res = $e->getResult();
      $user = null;
    }
  }
  
  $smarty->assign('user', $user);
  
  /*for($i = 0; $i < sizeof($user_friends_array['data']); $i++) {
    $obj = $user_friends_array['data'][$i];
    echo unenc_utf16_code_units($obj['name']).'<br />';
  }*/
  
  if($user) {
    $smarty->assign('user_name', $user_profile['name']);
    $smarty->assign('user_id', $user);
    $smarty->assign('user_friends_json', $user_friends_json);
  }
?>