<div class="popular_post_sidebar">
  <p class="sidebar_title">Most Popular</p>
    <ol class="sidebar_list">

<?php 


$dao = new Dao();

$result = $dao->getTop5();

foreach($result as $top_post) {
  print '   <li><a href="blog_post.php?id=';
  print $top_post["blog_post_id"] . '">';
  print $top_post["post_title"] . '</a></li>';
  print("\n");
}

?>
    </ol>
</div>
