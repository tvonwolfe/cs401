<?php

class Dao {

  private $host = "us-cdbr-iron-east-03.cleardb.net";
  private $db = "heroku_1b0bf582dc4a692";
  private $user = "b9b4a6a6dd5063";
  private $pass = "3a66046e";

  public const GOOD_USER_DATA = 0;
  public const BAD_EMAIL = 1;
  public const BAD_USER = 2;
  public const BAD_PASS = 3;
  public const USER_EXISTS = 4;

  private const SALT = "ja;'sjasfpqwf[&65&%$#lakh^9]";
  private const HASH = "sha256";

  public function getConnection() {
    try {
      $conn = new PDO("mysql:host={$this->host};dbname={$this->db}", $this->user, $this->pass);
    } catch (Exception $e) {
      echo print_r($e, 1);
      exit;
    }

    return $conn;
  }

  public function checkIfUserExists($username, $conn) {
    $q_str = "SELECT EXISTS(SELECT * FROM blog_user WHERE username = :username);";
    $stmt = $conn->prepare($q_str);
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    $result = $stmt->fetchAll();
    $s = array_pop($result);

    return ((int)array_pop($s) == 1);
  }

  public function createNewAccount($email, $user, $pass) {
    $conn = $this->getConnection();
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      return self::BAD_EMAIL;
    }
    else if(strlen($user) > 20) {
      return self::BAD_USER;
    }
    else if($this->checkIfUserExists($user, $conn)) {
      return self::USER_EXISTS;
    }
    else if(strlen($pass) < 8) {
      return self::BAD_PASS;
    }
    else {
      //made it through all checks!
      $pass_hash = hash(self::HASH, $pass . self::SALT);
      $insert_str = " INSERT INTO blog_user (username, email, password_hash, date_account_created)
        VALUES (:username, :email_addr, :passwd_hash, CURDATE());";

      $stmt = $conn->prepare($insert_str);
      $stmt->bindParam(':username', $user);
      $stmt->bindParam(':email_addr', $email);
      $stmt->bindParam(':passwd_hash', $pass_hash);

      $stmt->execute();

      return self::GOOD_USER_DATA;
    }
  }

  /* function to query the db for blog posts within the current category, sorted
     sorted by timestamps, newest posts first.
   */
  public function getBlogPostsForCategory($category) {
    $conn = $this->getConnection();
    $qStr = " SELECT blog_post_id, post_title, DATE(blog_post_timestamp), content, blog_post.category_id, category_name
      FROM blog_post
      JOIN blog_post_category ON blog_post.category_id = blog_post_category.category_id
      WHERE category_name LIKE :category
      ORDER BY blog_post_timestamp DESC;";
    $stmt = $conn->prepare($qStr);
    $stmt->bindParam(':category', $category);

    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    return $stmt->fetchAll();
  }

  // function to retrieve the 15 most recent blog posts.
  public function getFrontPage() {
    $conn = $this->getConnection();

    return $conn->query(" SELECT blog_post_id, post_title, blog_post_timestamp, content, category_name
        FROM blog_post
        JOIN blog_post_category ON blog_post.category_id = blog_post_category.category_id
        ORDER BY blog_post_timestamp DESC
        LIMIT 15;", PDO::FETCH_ASSOC);
  }

  // function to retrieve titles of the top 5 most viewed posts.
  public function getTop5() {
    $conn = $this->getConnection();

    return $conn->query(" SELECT post_title, blog_post_id
        FROM blog_post
        ORDER BY num_views DESC;
        LIMIT 5;", PDO::FETCH_ASSOC);
  }

  // function to get the category names in the blog_post_category table.
  public function getCategories() {
    $conn = $this->getConnection();
    return $conn->query(" SELECT category_id, category_name
        FROM blog_post_category;", PDO::FETCH_ASSOC);
  }

  // function to insert a new blog post into the blog_post table.
  public function createNewBlogPost($category, $post_title, $post_text) {
    $conn = $this->getConnection();
    $insert_query = " INSERT INTO blog_post (post_title, blog_post_timestamp, content, num_views, category_id)
      VALUES (:title, NOW(), :text, 0, (SELECT category_id FROM blog_post_category WHERE category_name LIKE :cat_name));";
    $q = $conn->prepare($insert_query);
    $q->bindParam(':title', $post_title);
    $q->bindParam(':text', $post_text);
    $q->bindParam(':cat_name', $category);
    $q->execute();
  }

  private function incNumPageViewsForID($id, $conn) {
    $update_str = " UPDATE blog_post
                    SET num_views = num_views + 1
                    WHERE blog_post_id = :idNum;";

    $stmt = $conn->prepare($update_str);
    $stmt->bindParam(':idNum', $id);
    $stmt->execute();
  }

  public function getBlogPostForID($id) {
    $conn = $this->getConnection();
    $query_str = "SELECT post_title, blog_post_timestamp, content, category_name
      FROM blog_post
      JOIN blog_post_category ON blog_post.category_id = blog_post_category.category_id
      WHERE blog_post_id = :post_id;";
    $stmt = $conn->prepare($query_str);
    $stmt->bindParam(':post_id', $id);
    $stmt->execute();

    $this->incNumPageViewsForID($id, $conn);

    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    return $stmt->fetchAll();
  }

  public function isPasswordCorrectForUser($user, $password) {
    $conn = $this->getConnection();
    $query_str = "SELECT password_hash
      FROM blog_user
      WHERE username LIKE :username";
    $stmt = $conn->prepare($query_str);
    $stmt->bindParam(':username', $user);
    $stmt->execute();

    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetch(); // there SHOULD only be one user with this username.

    if($result) {
      if($result['password_hash'] === hash(self::HASH, $password . self::SALT)) {
        return true;
      }
      else {
        return false;
      }
    }
    else {
      return false;
    }
  }

  public function getUserActivitySummary($username, $conn) {
    $q_str = "SELECT COUNT(comment_id)
              FROM post_comment
              JOIN blog_user ON post_comment.user_id = blog_user.user_id
              WHERE blog_user.username = :user;";
    $stmt = $conn->prepare($q_str);
    $stmt->bindParam(':user', $username);
    $stmt->execute();

    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    $result = $stmt->fetch();

    return array_pop($result);
  }

  public function getAccountCreateDate($username, $conn) {
    $q_str = "SELECT date_account_created
              FROM blog_user
              WHERE username = :user;";

    $stmt = $conn->prepare($q_str);
    $stmt->bindParam(':user', $username);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    $result = $stmt->fetch();

    $date = date_create(array_pop($result));

    return date_format($date, 'm/d/Y');
  }

  public function getCommentsForBlogPost($blog_post_id) {
    $conn = $this->getConnection();
    $q_str = "SELECT comment_text, username, comment_timestamp
              FROM post_comment
              JOIN blog_user ON post_comment.user_id = blog_user.user_id
              WHERE post_comment.blog_post_id = :id
              ORDER BY comment_timestamp DESC;";
    $stmt = $conn->prepare($q_str);
    $stmt->bindParam(':id', $blog_post_id);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    return $stmt->fetchAll();
  }

  public function postNewComment($username, $text, $post_id) {
    $conn = $this->getConnection();
    $insert_query = " INSERT INTO post_comment (comment_timestamp, comment_text, user_id, blog_post_id)
                      VALUES (NOW(), :text, (SELECT user_id FROM blog_user WHERE username = :user_id), :post_id);";

    $stmt = $conn->prepare($insert_query);
    $stmt->bindParam(':text', $text);
    $stmt->bindParam(':user_id', $username);
    $stmt->bindParam(':post_id', $post_id);
    $stmt->execute();
  }

  public function getUserComments($username) {
    $conn = $this->getConnection();

    $query_str = "SELECT comment_timestamp, comment_text, post_title, post_comment.blog_post_id
                  FROM post_comment
                  JOIN blog_post ON post_comment.blog_post_id = blog_post.blog_post_id
                  JOIN blog_user ON post_comment.user_id = blog_user.user_id
                  WHERE username = :username;";
    $stmt = $conn->prepare($query_str);
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    return $stmt->fetchAll();
  }

}
?>
