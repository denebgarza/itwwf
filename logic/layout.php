<?php
  // list of files allowed to be included
  // used as a security measure
  $includes = array(
    'check', 
    'about', 
    'privacy', 
    'contact',
    'faq',
    'tos', 
    'cpanel'
  );
  
  if(isset($_GET['page']))
    $page = $_GET['page'];
  else
    $page = $includes[0];
  
  $allowed = 0;
  for($i = 0; $i < sizeof($includes); $i++) {
    if($includes[$i] == $page) {
      $allowed = 1;
      break;
    }
  }
  
  if(!$allowed)
    $page = $includes[0];

  if(file_exists('logic/'.$page.'.php'))
    include('logic/'.$page.'.php');
    
  $q = mysql_query('SELECT * FROM users');
  $user_count = mysql_num_rows($q);
  $smarty->assign('user_count', $user_count);
  $smarty->assign($page);
  
  if(file_exists('views/'.$page.'.tpl'))
    $smarty->display($page.'.tpl');
?>