<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="resources/style.css">
    <link rel="shortcut icon" type="image/png" href="resources/favicon.png"/>
    <title>Life of Tony</title>
  </head>
  <body>
  <?php
    $currentNav="about";
    include('header.php');
    include('navbar.php');
  ?>
  <div>
    <div class="profile_img_container">
      <div class="profile_card">
        <img class= "about_img" src="resources/profile.jpeg">
      </div>
      <div class="icon_links">
        <a href="https://twitter.com/tonyvonwolfe" target="_blank">
          <img id = "first" class="profile_link_icon" src="resources/twittericon.png">
        </a>
        <a href="https://www.instagram.com/t__wolfe/" target= "_blank">
          <img class="profile_link_icon" src="resources/instagramicon.png">
        </a>
        <a href="https://github.com/twolfe21" target="_blank">
          <img class="profile_link_icon" src="resources/githubicon.png">
        </a>
        <a href="https://www.linkedin.com/in/tony-von-wolfe-b4a878141/" target="_blank">
          <img class="profile_link_icon" src="resources/linkedinicon.png">
        </a>
      </div>
    </div>
    <div class="blog_post">
      <div><h2>About Me</h2></div>
      <p>My name is Tony Von Wolfe. I was born and raised in the suburbs of Los Angeles, California.
      When I was 10, my parents made the decision to move us away from the big city
      to a small Idaho town called Middleton. It was here that I did most of my actual
      growing up.</p>

      <p>As I graduated from high school I knew I wanted to go to college, I just
      wasn't sure what I wanted to study. It was also around this time that I was
      set up on a blind date to senior prom with the girl who would become my wife, Ciera.</p>

      <p>I eventually landed on Computer Science as my major of choice, and began taking
      general courses from my local community college. Ciera and I moved into a place of our own,
      where we both learned that affording your own living situation meant you had to work hard
      if you weren't yet qualified for skilled labor. </p>

      <p>Now, 4 years later, I am a happily employed software engineer. I greatly enjoy programming of nearly any kind,
      and I love growing or expanding my skillset in any way I can. I'm into cars, and more specifically euro imports, but I love many JDM cars too.
      I also love spending time with my wife, and trying new things together. I'm a soon-to-be graduate
      from the computer science program at Boise State University, a homeowner, and parent to a very
      cute and fluffy wiener dog named Piper.</p>
    </div>
  </div>
  <?php include('footer.php'); ?>

<!--
    ________  ++    ________
   /        \++++  /        \
   \        /++++++\        /
    |      |++++++++/     /'
    |      |++++++/     /'
   +|      |++++/     /'+
 +++|      |++/     /'+++++
++++|      |/     /'+++++++++
 +++|           /'+++++++++
   +|         /'+++++++++
    |       /'+++++++++
    |     /'+++++++++
    |   /'+++++++++
    | /'   ++++++
     '       ++
-->
  </body>
</html>
