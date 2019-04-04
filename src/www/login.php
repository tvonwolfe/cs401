<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="shortcut icon" type="image/png" href="resources/favicon.png"/>
    <link rel="stylesheet" href="resources/style.css"/>
    <title>Life of Tony</title>
  </head>
  <body>
  <?php
    $currentNav="login";
    include('header.php');
    include('navbar.php');
  ?>

  <?php
    if(isset($_SESSION['message'])) {
      if(isset($_SESSION['account_created'])) {
        print "<div class=\"good_message\">" . $_SESSION['message'] . "</div>";
        unset($_SESSION['account_created']);
      }
      else {
        print "<div class=\"bad_message\">" . $_SESSION['message'] . "</div>";
      }
    }
    unset($_SESSION["message"]);
  ?>

    <div class="login_panel">
      <h1>Log In</h1>
      <form method="post" action="login_handler.php">
        <div class="textbox_container">
          <h3>Username:</h3>
          <input class="textbox" type="text" name="username" value="<?php if (isset($_SESSION['username'])) echo $_SESSION['username']; unset($_SESSION['username']); ?>" autofocus>
        </div>
        <div class="textbox_container">
          <h3>Password:</h3>
          <input class="textbox" type="password" name="password">
        </div>
        <div class="login_button">
          <input type="submit" value="Sign In">
        </div>
      </form>
      <p>Sign up <a href="signup.php">here</a>!</p>
    </div>
    <?php include('footer.php'); ?>
  </body>
</html>
