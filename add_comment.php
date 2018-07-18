<?php
/*
Martynas Petruška
Didelis pagalbos saltinis:
https://www.webslesson.info/2017/12/comments-system-using-php-and-ajax.html
*/
$connect = new PDO('mysql:host=localhost;dbname=comment', 'root', '');

$error = '';
$comment_email = '';
$comment_name = '';
$comment_content = '';

if(empty($_POST["comment_email"])){
  $error .= '<p class="text-danger">Email is required!</p>';
}else {
  $comment_email = test_input($_POST["comment_email"]);//"Isvalo" emaila ir paduoda filtrui tas kas parasyta s visais simboliais
  if(!filter_var($comment_email, FILTER_VALIDATE_EMAIL)){//Jei emeilas negaliojantis ismeta error pranesima, kadangi jame atsiranda kazkas, tai nekelia blogo emailo i db.
    $error .='<p class="text-danger">Invalid email format!</p>';
  }
}

if(empty($_POST["comment_name"])){
  $error .= '<p class="text-danger">Name is required!</p>';
}else {
  $comment_name = $_POST["comment_name"];
}

if(empty($_POST["comment_content"])){
  $error .= '<p class="text-danger">Content is required!</p>';
}else {
  $comment_content = $_POST["comment_content"];
}

if($error == ''){
  $query = "
  INSERT INTO comment (parent_id,email,name,comment) VALUES (:parent_id, :comment_email, :comment_name, :comment_content)
  ";
  $statement = $connect->prepare($query);
  $statement->execute(
    array(
      ':parent_id' => $_POST["comment_id"],
      ':comment_email' => $comment_email,
      ':comment_name' => $comment_name,
      ':comment_content' => $comment_content
    )
  );
  $error = '<label class="text-success">Comment added</label>';
}

$data = array(
  'error' => $error
);

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

echo json_encode($data);

?>
