<?php
  // Function copied from: http://stackoverflow.com/questions/7933228/convert-utf8-characters-returned-from-facebook-graph-api
  function unicode_decode($string) {
      $string = preg_replace_callback('#\\\\u([0-9a-f]{4})#ism',
      create_function('$matches', 'return mb_convert_encoding(pack("H*", $matches[1]), "UTF-8", "UCS-2BE");'), 
      $string);

      return $string;
  }
  
  require('config/main.php');   // general config (FB API, Smarty, etc.)
  require('config/db.php');     // database config
  require('User.php');          // User class
  require('FBUser.php');        // FBUser class
  require('AppUser.php');       // AppUser class
  require('logic/layout.php');  // main page
?>