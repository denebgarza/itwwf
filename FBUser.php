<?php
  /*
   *
   FBUser.php
   FBUser class represents a Facebook user, without taking into
   consideration any application functionalities.
   */

  class FBUser extends User
  {
    private $fb = null;
    private $profile = null;
    private $access_token = null;

    function __construct($fb) {
      if($fb) {
        $this->fb = $fb;
        $this->id = $fb->getUser();
        $this->initialize();
      }
    }

    private function initialize() {      
      $id = $this->getId();
      $fb = $this->getFB();
      if($id) {
        try {
          $this->profile = $fb->api($id, 'GET');
          $this->friends_array = $fb->api('/'.$id.'/friends?fields=id,name&limit=0', 'GET');
          $this->friends_json = unicode_decode(json_encode($this->getFriends('array')));
        } catch(FacebookAPIException $e) {
          $this->id = null;
        }
      }
    }

    public function getFB() {
      return $this->fb;
    }
    
    public function getName() { 
      if($this->getId())
        return $this->profile['name'];
      else
        return null;
    }
  }
?>