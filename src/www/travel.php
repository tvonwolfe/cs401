<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="shortcut icon" type="image/png" href="resources/favicon.png"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="resources/style.css"/>
    <title>Life of Tony</title>
  </head>
  <body>
  <?php
    $currentNav="travel";
    include('header.php');
    include('navbar.php');
    include('popular.php');

    $result = $dao->getBlogPostsForCategory('Travel');

    // regex to only grab first 3 sentences for preview.
    $regex = '/(.*\.){3}/';

    foreach ($result as $post) {
      $title = $post["post_title"];
      $post_id = $post["blog_post_id"];
      $content = $post["content"];
      $cat_id = $post["blog_post.category_id"];


      print '<div class="blog_post">
        <div><a class="post_category_heading" href="travel.php">Travel</a></div>';

      print "\n";
      print '<a class="post_title" href="blog_post.php?id=' . $post_id . '"' . '>';
      print $title . '</a>';
      print '<p>';
      preg_match($regex, $content, $matches);
      print $matches[0];
      print '</p>';
      print "\n";
      print '</div>';
    }


    include('footer.php');
  ?>
  </body>
</html>
