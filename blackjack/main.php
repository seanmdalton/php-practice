<?php
    require 'deck.class.php';
    require 'player.class.php';

  class BlackJack {
    private $players = array();
    private $deck;
    private $MAX_SCORE = 21;

    public function __construct(){
      $this->players["dealer"] = new Player("Dealer");

      $this->deck = new Deck();

      $this->draw_screen();

      return $this;
    }

    public function add_players() {
      do{
        $num = count($this->players);

        $this->players["player$num"] = new Player(readline("Enter your name: "));

      } while((readline("Add more players(y/n)? ") == "y" ? true : false));

      $this->draw_screen();

      return $this;
    }

    public function deal(){
      foreach($this->players as $player){
        #check to see if this is the first time we're being dealt,
        #   if so, everyone gets two cards

        if(!$player->get_hand()){
          $player->give_card($this->deck->deal());
          $player->give_card($this->deck->deal());
        }
      }

      $this->draw_screen();

      $active_players = 0;

      for($num = 1; $num <= count($this->players) - 1; $num++ ){
        if($this->players["player$num"]->is_active() &&
            (readline("Deal to " . $this->players["player$num"]->get_name() . " (y/n)? ") === "y" ? true: false)
          ){

          $this->players["player$num"]->give_card($this->deck->deal());

          if($this->players["player$num"]->get_hand_value() > $this->MAX_SCORE) {
            $this->players["player$num"]->set_status("deactive");
          } else {
            $active_players++;
          }
        } else {
          $this->players["player$num"]->set_status("deactive");
        }

        $this->draw_screen();
      }

      if($active_players === 0){
        $this->end_game();
      }

      $this->deal();
    }

    private function necho($string){
      echo "$string\n\r";
    }

    private function draw_screen($end = false){
        system('clear');

        $this->necho("
Welcome to PHP BlackJack!
=========================================");

      $this->necho("\nCurrent Players: ");

      foreach ($this->players as $player) {
        $card_string = "";
        $hand_value = 0;

        if($cards = $player->get_hand() && ($end || $player->get_name() !== "Dealer")){
          $card_string = " -> (";

          foreach($player->get_hand() as $card){
            $card_string .= " " . $card->get_card_pretty() . " ";
          }

          $card_string .= ")" . " -> " . $player->get_hand_value();
        } else if ($cards = $player->get_hand() && $end && $player->get_name() === "Dealer"){
          $card_string = " -> ( *[*] " . ($player->get_hand()[1])->get_card_pretty();

          $card_string .= ")";
        }

        $status = "";

        switch ($player->get_status()){
          case "active":
            $status = "+";
            break;
          case "deactive":
            $status = "-";
            break;
          case "failed":
            $status = "x";
            break;
        }

        $this->necho(" [$status] " . $player->get_name() . $card_string);
      }

      $this->necho("");
    }

    private function end_game(){
      $this->draw_screen($end = true);

      $dealer = $this->players["dealer"];

      while($dealer->get_hand_value() < 17) {
        $this->necho("Dealer is below 17, hitting...");
        sleep(2);

        $dealer->give_card($this->deck->deal());

        $this->draw_screen($end = true);
      }

      exit;
    }
  }

  $blackjack = new  BlackJack();

  $blackjack->add_players()->deal();

?>
