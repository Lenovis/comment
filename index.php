<?php
  require'connect.php';
  $email = $_POST['email'];
  $name = $_POST['name'];
  $comment = $_POST['comment'];
  $submit = $_POST['submit'];
  $parent_id = NULL;

  if ($submit) {
    if ($email&&$name&&$comment) {
      $insert=mysqli_query($con,"INSERT INTO comment (email,name,comment,parent_id) VALUES ('$email','$name','$comment','$parent_id')");
    }
  }

 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Komentarai</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <p>Comment form</p>
    <form action="index.php" method="post">
      <table>
        <tr><td>Email: </td><td><input type="email" name="email" placeholder="example@example.com"/></td><td>Name: </td><td><input type="name" name="name"></td></tr>
        <tr><td>Comment: </td><td colspan="3"><textarea name="comment"></textarea></td></tr>
        <tr><td><input type="submit" name="submit" value="Submit"></td></tr>
      </table>
    </form>
    <?php
      $query = mysqli_query($con,"SELECT * FROM comment ORDER BY id DESC");
      foreach ($query as $key) {
        echo $key['name'] . '<br>' . $key['comment'] . '<br>' . '<br>';
      }
     ?>
  </body>
</html>
