<?php

  include('db/Dao.php');
  session_start();

  $dao = new Dao();

  $_SESSION['username'] = $_POST['username'];

  if($dao->isPasswordCorrectForUser($_POST["username"], $_POST["password"])) {
    $_SESSION['logged_in'] = true;
    $_SESSION['login_successful'] = true;
    header("Location: index.php");
  }
  else {
    $_SESSION['message'] = "Invalid username or password.";
    header("Location: login.php");
    exit();
  }

?>
