<?php
  include('db/Dao.php');
  session_start();

  $dao = new Dao();

  $user = $_POST['username'];
  $email = $_POST['email'];
  $pass = $_POST['password'];

  $accountCreateResult = $dao->createNewAccount($email, $user, $pass);

  $_SESSION['username'] = $user;
  $_SESSION['email'] = $email;
  $_SESSION['password'] = $pass;

  switch($accountCreateResult) {
    case Dao::GOOD_USER_DATA:
      $_SESSION['account_created'] = true;
      $_SESSION['message'] = "Account creation successful!";
      header("Location: login.php");
      break;
    case Dao::BAD_EMAIL:
      $_SESSION['message'] = "Invalid email address.";
      header("Location: signup.php");
      exit();
    case Dao::BAD_USER:
      $_SESSION['message'] = "Invalid username. (Must be 20 characters or less and contain only alphanumeric/special characters.)";
      header("Location: signup.php");
      exit();
    case Dao::BAD_PASS:
      $_SESSION['message'] = "Invalid password. (Must be at least 8 characters and only use alphanumeric/special characters.)";
      header("Location: signup.php");
      exit();
    case Dao::USER_EXISTS:
      $_SESSION['message'] = "Sorry, that username is taken.";
      header("Location: signup.php");
      exit();
  }
?>
