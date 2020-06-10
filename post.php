<?php
  session_start();
  include 'php/functions.php'; ?>
<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Home</title>
  <meta name="description" content="Examensarbeter">
  <meta name="author" content="Nicklas Kullin">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>

<body>
 <?php printMenu(); ?>
<br />
<br />
  <div class = "logInForm border border-dark p-2 w-50">
    <form method="POST" action="post.php" name = "myForm" id = "myForm">
      <label for = "title">Title:</label>
      <input type = "text" name = "title" id = "title"placeholder = "Post title" /> <br /> <br />
      <label for = "content">Post content:</label><br />
      <textarea name = "content" id = "content" rows = "4" cols = "50"></textarea> <br /><br />
      <input type = "submit" class = "btn btn-dark" value = "Post"  name = "postForum"/>
      <?php
        if(isset($_POST['postForum'])){
          if(!empty($_POST['title']) && strlen(trim($_POST['content']))){
            postContent();
          }else{
            echo('<p class = "alert alert-warning">You need to enter a username and password to log in!</p>');
          }
        }?>
    </form>
</div>
</body>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html>
