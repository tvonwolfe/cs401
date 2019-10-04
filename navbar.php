<div class="nav_bar">
  <a <?php if ($currentNav=="home")
  print " class=\"currentpage\"";?> href="index.php">Home</a>

  <a <?php if ($currentNav=="programming")
  print " class=\"currentpage\"";?> href="blog_category_posts.php?cat=programming">Programming</a>

  <a <?php if ($currentNav=="cars")
  print " class=\"currentpage\"";?> href="blog_category_posts.php?cat=cars">Cars</a>

  <a <?php if ($currentNav=="life")
  print " class=\"currentpage\"";?> href="blog_category_posts.php?cat=life">Life</a>

  <a <?php if ($currentNav=="travel")
  print " class=\"currentpage\"";?> href="blog_category_posts.php?cat=travel">Travel</a>

  <a <?php if ($currentNav=="about")
  print " class=\"currentpage\"";?> href="about.php">About</a>

  <a class= "
  <?php
  if ($currentNav=="login") {
    print "currentpage ";
  }
  print 'login" href=';
  if(isset($_SESSION['logged_in'])) {
    print '"user.php?user='. $_SESSION['username'] . '">' . htmlentities($_SESSION['username']) . '</a>';
  }
  else {
    print '"login.php">Login/Signup</a>';
  }
  ?>

</div>
