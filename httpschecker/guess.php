<?php

function necho($string) {
  echo $string . "\n";

  return 1;
}

function get_number() {
  $in_number = (int)readline("Guess a number between 1 and 10: ");

  if(!is_numeric($in_number) || $in_number <= 0 || $in_number >= 10) {
    throw new Exception("Error: Invalid number selected.");
  } else {
    return $in_number;
  }
}

function play_game() {
  $number = rand(0, 10);

  try {
    $in_number = get_number();

    if($in_number === $number) {
      necho("Congrats! You guessed $number correctly!");

      return 1;
    } else {
      necho("Sorry, you guessed $in_number, and I guessed $number.");

      return 0;
    }
  } catch (Exception $e) {
    necho($e->getMessage());

    play_game();
  }

  return 0;
}

necho("Let's play a  game ... \n");

$score = 0;
$counter = 0;

do {
  $counter++;
  $score += play_game();

  necho("You've guessed $score/$counter (" . ($score/$counter ) . "%) correctly");
} while ((strtolower(readline("Continue (y/n)? ")) == "y" ? true : false));

?>
