<?php
  class timeManip {
    public function __construct(){
      return $this;
    }

    public function convert_unix_timestamp($timestamp) {
      return gmdate("Y-m-d\TH:i:s\Z", $timestamp);
    }

    public function calc_time_until($timestamp){
      $now = time();
      $diff = 0;
      $time_string = '';
      $postfix = '';
      $seconds["min"] = 60;
      $seconds["hour"] = $seconds["min"] * 60;
      $seconds["day"] = $seconds["hour"] * 24;
      $seconds["week"] = $seconds["day"] * 7;
      $seconds["month"] = $seconds["week"] * 4;
      $seconds["year"] = $seconds["month"] * 12;

      arsort($seconds);

      echo "Now: " . $this->convert_unix_timestamp($now);
      echo "\n";
      echo "Cert: " . $this->convert_unix_timestamp($timestamp);
      echo "\n";

      if($timestamp > $now) {
          $diff = $timestamp - $now;

          $postfix = 'until';
      } else if($timestamp < $now) {
          $diff = abs($timestamp - $now);

          $postfix = 'ago';
      } else {
        $postfix = 'now';

        return $postfix;
      }

      foreach($seconds as $key => $value) {
        if($diff > $value) {
          $num = floor($diff/$value);

          $time_string .= " $num $key" . ($num > 1 ? "s" : "");

          $mod =  $diff % $value;

          // echo "Key: $key, Diff: $diff, Value: $value, Mod: $mod\n";

          $diff = $diff - $num*$value;

        }
      }

      return $time_string . " " . $postfix . "\n ";

    }

  }
?>
