<?php
  date_default_timezone_set('America/Mexico_City');

  require_once('facebook/facebook.php');
  require('../Smarty-3.1.13/libs/Smarty.class.php');
  
  define('BASE_URL', 'http://localhost');
  
  abstract class ActionTypes
  {
    const deleted = 0;
    const added = 1;
    const deactivated = 2;
    const reactivated = 3;
  }
  
  define('APP_ID', 'XXXXXXXXXXXXXXX');
  define('APP_SECRET', 'XXXXXXXXXXXXXXX');
  
  $facebook = new Facebook(array(
    'appId' => APP_ID,
    'secret' => APP_SECRET
  ));
  
  $smarty = new Smarty();
  $smarty->setTemplateDir('views/');
  $smarty->setCompileDir('views_temp/');
?>