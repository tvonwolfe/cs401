<?php session_start(); ?>

<!DOCTYPE html>
<html>
  <head>
    <title>Create Blog Post</title>
    <link rel="shortcut icon" type="image/png" href="resources/favicon.png"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="resources/style.css">
  </head>
  <body>
  <?php
    include('db/Dao.php');
    $dao = new Dao();
    $conn = $dao->getConnection();
    if($_SESSION['username'] != 'tony') {
      print '<h1 class="unauthorized">Hahahahahahahaha get outta here bro</h1>';
      exit();
    }
  ?>
    <div class="new_post_creator">
      <form method="post" action="new_post_handler.php">
        <div class="textbox_container">
          <h1>Title</h1>
            <input class="textbox" type="text" name="title" value ="" autofocus>
        </div>
        <div class="textbox_container">
          <h1>Catgeory</h1>
          <select name="category" class="dropdown">
            <?php
              $categories = $dao->getCategories();
              foreach($categories as $cat) {
                $name = $cat['category_name'];
                print '<option value="' . $name . '">' . $name . "</option>\n";
              }
            ?>
          </select>
        </div>
        <div class="textbox_container">
          <h1>Post Content</h1>
          <textarea name="content" class="post_content_area"></textarea>
        </div>
        <div class="create_button_container">
          <input type="submit" value="Create">
        </div>
      </form>
    </div>
    </body>
</html>
