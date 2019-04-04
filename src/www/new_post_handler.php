<?php
  include('db/Dao.php');
  session_start();

  $dao = new Dao();

  $title = $_POST['title'];
  $cat_name = $_POST['category'];
  $content = $_POST['content'];
  
  $dao->createNewBlogPost($cat_name, $title, $content);
  header('Location: index.php');
?>
