<?php

$dao = new Dao();

$result = $dao->getFrontPage();

// regex for grabbing the first 3 sentences of a blog post to show
// as a preview.
$regex = "/(.*[.!?]){3}/";

foreach ($result as $frontPagePost) {
  $category = $frontPagePost["category_name"];
  $title = $frontPagePost["post_title"];
  $post_id = $frontPagePost["blog_post_id"];
  $content = $frontPagePost["content"];
  $cat_id = $frontPagePost["category_id"];

  print '<div class="blog_post">
    <div><a class="post_category_heading" href=';

  // probably should have made the categories some sort of enumeration,
  // but here we are.
  if($category === "Programming") {
    print '"programming.php">Programming';
  }
  else if($category === "Cars") {
    print '"cars.php">Cars';
  }
  else if($category === "Life") {
    print '"life.php">Life';
  }
  else {
    print '"travel.php"';
  }

  print '</a></div>';
  print("\n");
  print '<a class="post_title" href="blog_post.php?id=' . $post_id . '"' . '>';
  print $title . '</a>';
  print '<p>';
  preg_match($regex, $content, $matches);
  print $matches[0];
  print '</p>';
  print "\n";
  print '</div>';

}
?>
