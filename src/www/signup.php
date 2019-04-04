<?php 
  session_start(); 
?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="shortcut icon" type="image/png" href="resources/favicon.png" />
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
    if(isset($_SESSION['message']) && !isset($_SESSION['account_created'])) {
      print "<div class=\"bad_message\">" . $_SESSION['message'] . "</div>";
    }
    unset($_SESSION["message"]);
    unset($_SESSION['account_created']);
  ?>

  <div id="signup" class="login_panel">
    <h1>Create Account</h1>
    <form method="post" action="signup_handler.php">
      <div class="textbox_container">
        <h3>Email:</h3>
        <input class="textbox" type="text" name="email" value ="<?php print $_SESSION['email']; ?>">
      </div>
      <div class="textbox_container">
        <h3>Username:</h3>
        <p>(Up to 20 alphanumeric/special characters)</p>
        <input class="textbox" type="text" name="username" value="<?php print $_SESSION['username']; ?>">
      </div>
      <div class="textbox_container">
        <h3>Password:</h3>
        <p>(At least 8 alphanumeric/special characters)</p>
        <input class="textbox" type="password" name="password">
      </div>
      <div id="signup_button" class="login_button">
        <input type="submit" value="Sign Up">
      </div>
    </form>
  </div>

  <?php include('footer.php'); ?>
  </body>

</html>
