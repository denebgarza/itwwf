<?php
  $q = mysql_query('SELECT * FROM users ORDER BY last_check DESC');
  
  while($row = mysql_fetch_array($q)) {
    $user_profile = $facebook->api('/'.$row['user_id'], 'GET');
    $username = $user_profile['name'];
    
    echo '<strong>'.$username.'</strong> last check - '.date('r', $row['last_check']).'<br />';
  }
?>