<?php
  class Player {
    private $name;
    private $cards;
    private $status; #active, deactive, failed

    public function __construct($name){
      $this->name = $name;
      $this->cards = array();
      $this->status = "active";
    }

    public function get_status(){
      return $this->status;
    }

    public function set_status($status){
      $this->status = $status;
    }

    public function get_name(){
      return $this->name;
    }

    public function is_active(){
      if($this->status === "active") {
        return true;
      } else {
        return false;
      }
    }

    public function give_card($card) {
      $this->cards[] = $card;
    }

    public function get_hand(){
      if(count($this->cards) > 0) {
        return $this->cards;
      } else {
        return false;
      }
    }

    public function get_hand_value(){
      $hand_value = 0;

      foreach($this->get_hand() as $card){
        $hand_value += (int)$card->get_value();
      }

      return $hand_value;
    }

    public function clear_hand(){
      $this->cards = array();
    }

  }


?>
