<?php 
  session_start(); 

  include('db/Dao.php');
  $dao = new Dao();
  
  $post_id = $_SESSION['current_post'];

  // user cannot post a comment if they're not logged in.
  if(!isset($_SESSION['logged_in'])) {
    $_SESSION['cannot_comment'] = true;
  }
  else {
    $comment_text = $_POST['comment_text'];
    $username = $_SESSION['username'];

    // put the comment in the DB.
    $dao->postNewComment($username, $comment_text, $post_id);

  }
  header('Location: blog_post.php?id=' . $post_id);
  exit();
?>
