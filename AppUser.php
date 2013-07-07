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
    
    function __construct($id, $db) {
      if($id && $db) {
        $this->db = $db;
        $this->db->setQuery('SELECT * FROM users WHERE user_id = '.$id.' LIMIT 1');
        $this->id = $db->getResult(0, 'user_id');
        
        if($id) { // If the user exists in the database
          // $this->name = $db->getResult($q, 0, 'name');
          $this->friends_json = $db->getResult(0, 'user_friends_json'); // ### REMOVE 'user_' ###
          $this->friends_array = json_decode($this->friends_json);
        }
      }
    }
    
    public function getLastCheck() {
      return $this->db->getResult(0, 'last_check');
    }
    
    public function getJoinTime() {
      return $this->db->getResult(0, 'time');
    }
    
    public function getName() { 
      return null;
    }
  }
?>