<?php

require 'card.class.php';

class Deck {
  private $cards = array(); # new Card[]
  private $suits = ['♠', '♦', '♥', '♣'];
  private $specials = ["Jack", "Queen", "King", "Ace"];


  public function __construct(){
    $this->initialize();

    $this->shuffle();
  }

  private function initialize() {
    foreach($this->suits as $suit){
      for($x = 1; $x <= 10; $x++){
        array_push($this->cards, new Card($suit, $x));
      }

      foreach($this->specials as $special){
        array_push($this->cards, new Card($suit, $special));
      }
    }
  }

  public function shuffle(){
    $temp = $this->cards;
    $this->cards = [];

    while($size = count($temp)) {
      $rand = rand(0, $size - 1);

      array_push($this->cards, $temp[$rand]);

      unset($temp[$rand]);
      $temp = array_values($temp);
    }
  }

  public function deal($num = 1){
    if($this->cards <= 0) {
      throw new Exception("No cards remaining.");

      return 0;
    }

    if($num === 1){
      return array_shift($this->cards);
    } else {
      $temp = array();

      for($x = 0; $x < $num; $x++){
        $temp[] = array_shift($this->cards);
      }

      return $temp;
    }
  }


}

 ?>
