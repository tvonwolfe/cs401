<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="shortcut icon" type="image/png" href="resources/favicon.png"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="resources/style.css" />
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/post_page.js"></script>
    <title>Life of Tony</title>
  </head>
  <body>
  <?php
    include('header.php');

    $post_id = $_GET['id'];
    $dao = new Dao();

    $post_data = array_pop($dao->getBlogPostForID($post_id));
    $title = $post_data['post_title'];
    $content = $post_data['content'];
    $category_name = $post_data['category_name'];
    $currentNav = $category_name;

    include('navbar.php');
  ?>

  <div class="rh_container">
  <?php
    include('popular.php');
  ?>
  </div>

  <?php
    if(isset($_SESSION['cannot_comment'])) {
      print '<div class="no_comment">You must login to post comments.</div>';
      unset($_SESSION['cannot_comment']);
    }

  ?>
    <span class="blog_post">
      <div><a class="post_category_heading" href=<?php print "\"" . lcfirst($category_name) . ".php" . "\">" . ucfirst($category_name);?></a></div>
      <a class="post_title" href="blog_post.php<?php print '?id=' . $post_id?>"><?php print $title;?></a>
        <?php
          $paragraphs = explode("\n", $content);
          foreach($paragraphs as $p) {
            print '<p>' . $p . '</p>';
          }
        ?>
    </span>

    <?php
      include('comments.php');
      include('footer.php');
    ?>
  </body>
</html>
