<?php
  class MySQL
  {
    private $q = null;
    private $q_str = '';
    
    function __construct($host = DB_HOST, $user = DB_USER, $password = DB_PSSWD, $name = DB_NAME) {
      mysql_connect(DB_HOST, DB_USER, DB_PSSWD, true)or die(mysql_error());
      mysql_select_db(DB_NAME)or die(mysql_error());
      mysql_set_charset('utf8');   
    }
    
    function setQuery($q) {
      $this->q_str = $q;
      $this->q = mysql_query($q)or die('setQuery on '.$this->q_str.' failed');
    }
    
    function runQuery($q) {
      mysql_query($q)or die('runQuery on '.$q.' failed');
    }
    
    function getNumRows() {
      $num = mysql_num_rows($this->q);
      return $num;
    }
    
    function getField($field) {
      $q = mysql_query($this->q_str);
      if($this->getNumRows()) {
        $row = mysql_fetch_array($q)or die('getField on '.$this->q_str);
        return $row[$field];
      }
      
      return null;
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