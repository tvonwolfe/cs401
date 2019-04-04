CREATE TABLE blog_post_category (
  category_id INTEGER PRIMARY KEY AUTO_INCREMENT,
  category_name VARCHAR(20) NOT NULL
);

CREATE TABLE blog_post (
  blog_post_id INTEGER PRIMARY KEY AUTO_INCREMENT,
  post_title VARCHAR(140) NOT NULL,
  blog_post_timestamp TIMESTAMP NOT NULL,
  content TEXT NOT NULL,
  num_views INTEGER NOT NULL,
  category_id INTEGER NOT NULL REFERENCES blog_post_category
);

CREATE TABLE blog_user (
  user_id INTEGER PRIMARY KEY AUTO_INCREMENT,
  username VARCHAR(20) NOT NULL,
  email VARCHAR(64),
  password_hash VARCHAR(100),
  date_account_created DATE NOT NULL
);

CREATE TABLE post_comment (
  comment_id INTEGER PRIMARY KEY AUTO_INCREMENT,
  comment_timestamp TIMESTAMP NOT NULL,
  comment_text TEXT NOT NULL,
  user_id INTEGER NOT NULL REFERENCES blog_user,
  blog_post_id INTEGER NOT NULL REFERENCES blog_post
);

CREATE TABLE comment_reply (
  reply_id INTEGER PRIMARY KEY AUTO_INCREMENT,
  parent_id INTEGER NOT NULL REFERENCES post_comment,
  child_id INTEGER NOT NULL REFERENCES post_comment
);
