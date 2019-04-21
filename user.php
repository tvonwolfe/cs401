<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <title>User - <?php print $_SESSION['username']?></title>
    <link rel="shortcut icon" type="image/png" href="resources/favicon.png"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="resources/style.css">
  </head>
  <body>
  <?php
    include('db/Dao.php');
    $dao = new Dao();
    $conn = $dao->getConnection();

    if(isset($_SESSION['username']) && $_SESSION['username'] === $_GET['user']) {
      $currentNav="login";
    }
    include('header.php');
    include('navbar.php');
  ?>

  <?php


  // make sure the username exists before doing anything else.
  $user_exists = $dao->checkIfUserExists($_GET['user'], $conn);

  if($user_exists) {
    $num_comments = (int)$dao->getUserActivitySummary($_GET['user'], $conn);
    print '<div class="profile_content">';
    print '<h1 class="profile_page_username">' . htmlentities($_GET['user']) . '</h1>';
    if($num_comments === 0) {
      print "<h1 class=\"no_content\">There doesn't seem to be anything here...</h1>";
    }
    else {
      $comments = $dao->getUserComments($_GET['user']);
      foreach($comments as $comment) {
        print '<div class="userpage_cmmnt">';
        $dt_str = explode(" ", $comment['comment_timestamp']);
        $dt = new DateTime($dt_str[0]);
        $hours = (int)substr($dt_str[1], 0, 2);
        $min = (int)substr($dt_str[1], 3, 2);
        $dt->setTime($hours, $min);
        $dt->setTimezone(new DateTimeZone('-0700'));
        print '<p class="timestamp">/ ' . date_format($dt, 'm/d/Y H:i') . ' /</p>';
        print '<a class="userpage_post_title" href="blog_post.php?id=' . $comment['blog_post_id'] . '">' . $comment['post_title'] . '</a>';
        $paragraphs = explode("\n", $comment['comment_text']);
        foreach($paragraphs as $p) {
          print '<p>' . htmlentities($p) . '</p>';
        }
        print '</div>';
      }
    }
    print '</div>';
  }
  else {
    print '<h1 class="user_not_exist">Sorry, this user does not exist.</h1>';
  }
  ?>

  <?php

    if($user_exists) {
      print '<div class="profile_page_sidebar">';
      // show the logout button if we're looking at the currently signed-in user.
      if(isset($_SESSION['username']) && $_SESSION['username'] === $_GET['user']) {
        print
        '<form method="post" action="logout_handler.php">
          <div>
            <input type="submit" value="Sign Out">
          </div>
        </form>';
        if($_SESSION['username'] == 'tony' && $_GET['user'] == 'tony') {
         print
         '<form method="post" action="create_post_handler.php">
          <div>
            <input type="submit" value="Create New Post">
          </div>
        </form>';
        }
      }

      print '<h2 class="profile_summary">Profile Summary</h2>';
      print '<p class="profile_sidebar_data_header">Total Comments Posted:</p><p class="profile_sidebar_data">' . $num_comments . '</p>';
      print '<p class="profile_sidebar_data_header">Member since:</p>';
      $db_date = $dao->getAccountCreateDate($_GET['user'], $conn);
      print '<p class="profile_sidebar_data">' .  $dao->getAccountCreateDate($_GET['user'], $conn) . '</p>';

      print '</div>';

    }
  ?>

  <?php
    include('footer.php');
  ?>
  </body>
