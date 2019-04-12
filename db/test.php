<?php

  include('Dao.php');

  $user = 'testUser';
  $pass = 'password';
  $email = "test@test.com";

  $dao = new Dao();
  $result = $dao->createNewAccount($email, $user, $pass);

  if($result === 0) {
    print("true");
  }
  else {
    print("false");
  }

?>
