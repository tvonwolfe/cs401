<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <title>Life of Tony</title>
    <link rel="shortcut icon" type="image/png" href="resources/favicon.png"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="resources/style.css">
  </head>
  <body>
  <?php
    $currentNav="home";
    include('header.php');
    include('navbar.php');
  ?>

  <div class="rh_container">
  <?php
    if(isset($_SESSION['login_successful'])) {
      print '<div class="login_message">Hello, ' . $_SESSION['username'] . "!</div>\n";
      unset($_SESSION['login_successful']);
    }
    include('popular.php');
  ?>
  </div>

  <?php
    include('recent_posts.php');
    include('footer.php');
  ?>
  </body>
</html>
