<?php
  include('db/Dao.php');
  session_start();

  $dao = new Dao();

  $user = $_POST['username'];
  $email = $_POST['email'];
  $pass = $_POST['password'];

  if(strlen($pass) < 8) {
    $_SESSION['bad_pass'] = "Invalid password. (Must be at least 8 characters and only use alphanumeric/special characters.)";
  }

  if(strlen($user) == 0 || strlen($user) > 20) {
    $_SESSION['bad_user'] = "Invalid username. (Must be 20 characters or less and contain only alphanumeric/special characters.)";
  }

  $accountCreateResult = $dao->createNewAccount($email, $user, $pass);

  $_SESSION['username'] = $user;
  $_SESSION['email'] = $email;
  $_SESSION['password'] = $pass;

  switch($accountCreateResult) {
    case Dao::GOOD_USER_DATA:
      $_SESSION['account_created'] = true;
      $_SESSION['message'] = "Account creation successful!";
      header("Location: login.php");
    case Dao::BAD_EMAIL:
      $_SESSION['bad_email'] = "Invalid email address.";
      header("Location: signup.php");
      exit();
    case Dao::BAD_USER:
      header("Location: signup.php");
      exit();
    case Dao::BAD_PASS:
    case Dao::USER_EXISTS:
      $_SESSION['user_taken'] = "Sorry, that username is taken.";
      header("Location: signup.php");
      exit();
  }
?>
