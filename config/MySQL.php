<?php
  class MySQL
  {
    public $q = ''; // latest set query
    
    function __construct($host = DB_HOST, $user = DB_USER, $password = DB_PSSWD, $name = DB_NAME) {
      mysql_connect(DB_HOST, DB_USER, DB_PSSWD)or die(mysql_error());
      mysql_select_db(DB_NAME)or die(mysql_error());
      mysql_set_charset('utf8');   
    }
    
    /*
     If a query string is specified, returns the
     result of that query. If no string is 
     specified, returns the default class query result.
    */
    function getQuery($q) {
      if(empty($q))
        $q = $this->q;
      else
        $q = mysql_query($q);
        
      return $q;
    }
    
    function query($q, $set = false) {   
      $newQuery = $this->getQuery($q);
      if($set) $this->q = $newQuery;
    }
    
    function getNumRows($q = '') {
      $num = mysql_num_rows($this->getQuery($q));
      return $num;
    }
    
    function getResult($q, $row, $col) {
      $res = null;
      if($this->getNumRows($q) > 0)
        $res = mysql_result($this->getQuery($q), $row, $col)or die(mysql_error());
      return $res;
    }
    
    function fetchArray($q = '') {
      $retArr = array();
      while($row = mysql_fetch_array($this->getQuery($q))) {
        $retArr[] = $row;
      }

      return $retArr;
    }
  }
?>