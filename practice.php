<?php

class User  {
  private $firstName;
  private $lastName;

  public function __construct($vars){
    $this->setFirstName($vars[0]);
    $this->setLastName($vars[1]);

    throw new Exception("testing");

    return $this;
  }

  public function hello(){
    echo "Hello! " . $this->getFirstName() . " " . $this->getLastName() . "!\n";

    return $this;
  }

  public function register(){
    echo " >> registered.\n";

    return $this;
  }

  public function email(){
    echo " >> emailed.\n";

    return $this;
  }

  public function setFirstName($firstName){
    $this->firstName = $firstName;
  }

  public function setLastName($lastName){
    $this->lastName = $lastName;
  }

  public function getFirstName(){
    return $this->firstName;
  }

  public function getLastName(){
    return $this->lastName;
  }

  public function getFullName(){
      return $this->getFirstName() . " " . $this->getLastName();

  }
}

// list($firstName, $lastName) =;

try {
  $user = new User(explode(" ", readline("Please enter your first and last name: ")));
} catch (Exception $e) {
  echo "Error messages: " . $e->getMessage();
} finally {
  echo "Exiting...";
}

$user->hello()->register()->email();

echo $user->getFullName();

?>
