<?php
  class MySQL
  {
    private $q = null;
    
    function __construct($host = DB_HOST, $user = DB_USER, $password = DB_PSSWD, $name = DB_NAME) {
      mysql_connect(DB_HOST, DB_USER, DB_PSSWD, true)or die(mysql_error());
      mysql_select_db(DB_NAME)or die(mysql_error());
      mysql_set_charset('utf8');   
    }
    
    function setQuery($q) {
      $this->q = mysql_query($q)or die(mysql_error());
    }
    
    function runQuery($q) {
      mysql_query($q)or die(mysql_error());
    }
    
    function getNumRows() {
      $num = mysql_num_rows($this->q);
      return $num;
    }
    
    function getResult($row, $col) {
      $res = null;
      if($this->getNumRows($this->q) > 0)
        $res = mysql_result($this->q, $row, $col)or die(mysql_error());

      return $res;
    }
    
    function fetchArray() {
      $retArr = array();
      while($row = mysql_fetch_array($this->q)) {
        $retArr[] = $row;
      }

      return $retArr;
    }
  }
?>