<?php
/*
Martynas Petruška
Didelis pagalbos saltinis:
https://www.webslesson.info/2017/12/comments-system-using-php-and-ajax.html
*/

$connect = new PDO('mysql:host=localhost;dbname=comment', 'root', '');

$query = "SELECT * FROM comment WHERE parent_id = '0' ORDER BY id DESC";

$statement = $connect->prepare($query);
$statement->execute();

$result = $statement->fetchAll();
$output = '';

foreach($result as $row){
  $output .= '
    <div class="panel panel-default">
    <div class="panel-heading"><b>'.$row["name"].'</b> <i>'.$row["date"].'</i></div>
    <div class="panel-body">'.$row["comment"].'</div>
    <div class="panel-footer" align="right"><button type="button" class="btn btn-default reply" id="'.$row["id"].'">Reply</button></div>
    </div>
  ';
  //$output .= get_reply_comment($connect, $row["id"]);
}

echo $output;

?>
