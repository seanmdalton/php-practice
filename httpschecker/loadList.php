<?php

class loadList {
  public $list;

  public function __construct(){

  }

  public function from_file($filename) {
    $this->list = file($filename);

    return $this;
  }

  public function print_list(){
    print_r($this->list);

    return $this;
  }
}

?>
