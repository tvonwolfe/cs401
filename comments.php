<div class="comment_section">
  <h3>Leave a comment...</h3>
  <form id="comment_form" method="post" action="comment_handler.php">
    <textarea name="comment_text" id="comment" class="comment_textarea"></textarea>
    <div class="submit_comment_button_container">
      <input id="submit_button" type="submit" value="Post Comment">
    </div>
  </form>
</div>
  <?php
    $dao = new Dao();
    $_SESSION['current_post'] = $post_id;
    $comments = $dao->getCommentsForBlogPost($post_id);

      print '<div class="user_comments">';
      if(sizeof($comments) != 0) {
        print '<hr>';
        foreach($comments as $comment) {
          $datetime_str = explode(" ", $comment['comment_timestamp']);
          $datetime = new DateTime($datetime_str[0]);
          $hours = (int)substr($datetime_str[1], 0, 2);
          $min = (int)substr($datetime_str[1], 3, 2);
          $datetime->setTime($hours, $min);
          $datetime->setTimezone(new DateTimeZone('-0700'));
          print '<p class="timestamp">/ ' . date_format($datetime, 'm/d/Y H:i') .' /</p>';
          print '<div class="usr_cmmnt">';
          print '<a href="user.php?user=' . $comment['username'] . '" class="usrnm">' . $comment['username'] . '</a>';
          $paragraphs = explode("\n", $comment['comment_text']);
          foreach($paragraphs as $p) {
            print '<p>' . htmlentities($p) . '</p>';
          }

          print '</div>';
          print '<hr>';
        }
      }
      else {
        print "<h2 class=\"no_content\">Be the first to leave a comment...</h2>";
      }
      print '</div>';
  ?>
</div>
