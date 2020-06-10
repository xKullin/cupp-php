<?php

  function printMenu(){
    ?>
    <nav class="navbar navbar-expand-sm navbar-toggleable-sm navbar-dark bg-dark border-bottom box-shadow mb-3">
    <div class="container">
        <a class="navbar-brand" href = "index.php">Web</a>
        <div class="navbar-collapse collapse d-sm-inline-flex flex-sm-row-reverse">
            <ul class="navbar-nav flex-grow-1">
                <li class="nav-item">
                    <a class="nav-link text-white" href = "index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href = "forum.php">Forum</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href = "post.php">Post</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href = "logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
    <?php
  }
  /* LOGIN PAGE FUNCTIONS*/
  function dbConnect(){
    try {
      $dsn = "mysql:dbname=examusers;host=localhost";
      $user = "root";
      $password = "";
      $options = array( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
      $db = new PDO($dsn, $user, $password, $options);
      return $db;
    } catch( PDOException $e ) {
      throw $e;
    }
  }
  function dbDes(){
    $db = null;
  }
  function validateLoginForm(){
    $username = trim(strtolower($_POST['username']));
    $passwordLogIn = trim($_POST['password']);
    $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $db = dbConnect();
    $sql = "SELECT username, password FROM login WHERE username = :username";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':username', $username);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if($user === false){
      echo('<p class = "alert alert-warning">Incorrect combination.<p>');
    }else{
      $passwordCorrect = password_verify($passwordLogIn, $user['password']);

      if($passwordCorrect){
          $_SESSION['username'] = $username;
      }else{
        echo('<p class = "alert alert-warning">Incorrect combination.<p>');
      }
    }

    $msg;
    return $username;
  }
  function validateRegisterForm(){
    $username = trim(strtolower($_POST['username']));
    $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);
    $db = dbConnect();
    $sql = "SELECT username FROM login WHERE username = :username";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':username', $username);
    $stmt->execute();
    if($stmt->rowCount() > 0){
      echo('<p class = "alert alert-warning">That username already exists, please try again using a different name.<p>');
    }else{
      $sql = "INSERT INTO login (username, password) VALUES (:username, :password)";
      $stmt = $db->prepare($sql);
      $stmt->bindValue(':username', $username);
      $stmt->bindValue(':password', $password);

      $result = $stmt->execute();
      if($result){
        echo('<p class = "alert alert-success">Account created!</p>');
      }else{
        echo('<p class = "alert alert-danger">Something went wrong, please try again.</p>');
      }
    }

    dbDes();
    $msg;
    return $username;
  }
  /* POST PAGE FUNCTIONS*/
  function postContent(){
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $db = dbConnect();
    $sql = "SELECT Title FROM posts WHERE Title = :title";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':title', $title);
    $stmt->execute();
    if($stmt->rowCount() > 0){
      echo('<p class = "alert alert-warning">That title already exists, please try again using a different title.<p>');
    }else{
      $sql = "INSERT INTO posts (Title, Content) VALUES(:title, :content)";
      $stmt = $db->prepare($sql);
      $stmt->bindValue(':title', $title);
      $stmt->bindValue(':content', $content);
      $result = $stmt->execute();
      if($result){
        echo('<p class = "alert alert-success">Posted!</p>');
      }else{
        echo('<p class = "alert alert-danger">Something went wrong, please try again.</p>');
      }
    }
  }
  /*FORUM PAGE FUNCTIONS*/
  function printPosts(){
    $db = dbConnect();
    $sql = "SELECT * FROM posts";
    $stmt = $db->prepare($sql);
    $posts = array();
    if($stmt->execute()){
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $posts[] = $row;

      }
    }
    foreach($posts as $value){
      echo('<div class = "post">Title: ' . $value['Title'] . '<br /><br />Content: ' . $value['Content'] . '</div><br />');

    }


  }
 ?>
