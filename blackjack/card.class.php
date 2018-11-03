<?php

class Card {
  public $suit;
  public $identifier;
  public $value;

  public function __construct($suit = null, $identifier){

    if(!is_numeric($identifier)){
      switch($identifier) {
        case "Ace":
          $this->value = [1, 11];
          break;
        default:
          $this->value = 10;
      }
    } else {
      $this->value = $identifier;
    }

    $this->identifier = $identifier;
    $this->suit       = $suit;
  }

  public function get_value(){
    return $this->value;
  }

  public function get_card_pretty(){
    return $this->identifier . "[" . $this->suit . "]";
  }

}

 ?>
