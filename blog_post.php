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
    $timestamp = $post_data['blog_post_timestamp'];
    $currentNav = $category_name;

    include('navbar.php');

    if(isset($_SESSION['cannot_comment'])) {
      print '<div class="no_comment">You must login to post comments.</div>';
      unset($_SESSION['cannot_comment']);
    }

  ?>
    <div class="blog_post">
      <div><a class="post_category_heading" href=<?php print "\"" . lcfirst($category_name) . ".php" . "\">" . ucfirst($category_name);?></a></div>
      <a class="post_title" href="blog_post.php<?php print '?id=' . $post_id?>"><?php print $title;?></a>
        <?php
          $datetime_str = explode(" ", $timestamp);
          $datetime = new DateTime($datetime_str[0]);
          $hour = (int)substr($datetime_str[1], 0, 2);
          $min = (int)substr($datetime_str[1], 3, 2);
          $datetime->setTime($hour, $min);
          $datetime->setTimezone(new DateTimeZone('-0700'));

          print '<p class="timestamp">Posted '. date_format($datetime, 'm/d/Y') . ' at ' . date_format($datetime, 'H:i') . '</p>';

          $paragraphs = explode("\n", $content);
          foreach($paragraphs as $p) {
            print '<p>' . $p . '</p>';
          }
        ?>
    </div>

    <?php
      include('comments.php');
      include('footer.php');
    ?>
  </body>
</html>
