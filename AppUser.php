<?php
  /*
   *
   AppUser.php
   AppUser class represents a user of the application only, with
   NO Facebook user overlap.
   */

  class AppUser extends User
  {
    private $db = null;
    private $join_time = 0;
    private $last_check = 0;
    
    function __construct($id, &$db) {
      $last_check = time();
      if($id && $db) {
        $this->db = $db;
        $this->db->setQuery('SELECT * FROM users WHERE user_id = '.$id.' LIMIT 1');
        $this->id = $this->db->getField('user_id');
        
        if($this->id) { // If the user exists in the database
          // $this->name = $db->getResult($q, 0, 'name');
          $this->friends_json = $this->db->getField('user_friends_json'); // ### REMOVE 'user_' ###
          $this->friends_array = json_decode($this->friends_json, true);
        }
      }
    }
    
    public function getLastCheck() {
      if(!$this->last_check) $this->last_check = $this->db->getField('last_check');
      return $this->last_check;
    }
    
    public function getJoinTime() {
      if(!$this->join_time) $this->join_time = $this->db->getField('time');
      return $this->join_time;
    }
    
    public function getName() { 
      // supposed to get name from database
      return null;
    }
  }
?>