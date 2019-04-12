<?php
  session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="shortcut icon" type="image/png" href="resources/favicon.png" />
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="resources/style.css" />
    <title>Sign Up</title>
  </head>
  <body>
  <?php
  $currentNav = 'login';
  include('header.php');
  include('navbar.php');
  ?>

  <?php
    if(isset($_SESSION['bad_email']) && !isset($_SESSION['account_created'])) {
      print "<div class=\"bad_message\">" . $_SESSION['bad_email'] . "</div>";
    }
    unset($_SESSION["bad_email"]);

    if(isset($_SESSION['bad_user']) && !isset($_SESSION['account_created'])) {
      print "<div class=\"bad_message\">" . $_SESSION['bad_user'] . "</div>";
    }
    unset($_SESSION["bad_user"]);

    if(isset($_SESSION['bad_pass']) && !isset($_SESSION['account_created'])) {
      print "<div class=\"bad_message\">" . $_SESSION['bad_pass'] . "</div>";
    }
    unset($_SESSION["bad_pass"]);

    if(isset($_SESSION['user_taken']) && !isset($_SESSION['account_created'])) {
      print "<div class=\"bad_message\">" . $_SESSION['user_taken'] . "</div>";
    }
    unset($_SESSION["user_taken"]);
  ?>

  <div id="signup" class="login_panel">
    <h1>Create Account</h1>
    <form id="signup_form" method="post" action="signup_handler.php">
      <div class="textbox_container">
        <label for="email"><h3>Email:</h3></label>
        <input class="textbox" type="text" id="email" name="email" value ="<?php print $_SESSION['email']; ?>">
      </div>
      <div class="textbox_container">
        <label for="username"><h3>Username:</h3></label>
        <p>(Up to 20 alphanumeric/special characters)</p>
        <input class="textbox" type="text" id="username" name="username" value="<?php print $_SESSION['username']; ?>">
      </div>
      <div class="textbox_container">
        <label for="password"><h3>Password:</h3></label>
        <p>(At least 8 alphanumeric/special characters)</p>
        <input class="textbox" type="password" id="password" name="password">
      </div>
      <div id="signup_button" class="login_button">
        <input type="submit" value="Sign Up">
      </div>
    </form>
  </div>

  <?php include('footer.php'); ?>
  </body>

</html>
