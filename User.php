<?php
  /*
   *
   User.php
   Base abstract User class
   */
   
  abstract class User
  {
    protected $id = null;
    protected $name = null;
    protected $friends_array = null;
    protected $friends_json = '';
    
    public function getFriends($format) {
      if($format == 'json')
        return $this->friends_json;
      else if($format == 'array') 
        return $this->friends_array;
      else
        return null;
    }
    
    public function getId() {
      return $this->id;
    }
    
    abstract public function getName();
  }
?>