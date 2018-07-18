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
      <div class="panel-heading">
        <div id="phl">
          <b>'.$row["name"].'</b> <i>'.$row["date"].'</i>
        </div><div id="phr" align="right">
          <button type="button" class="btn btn-default reply" id="'.$row["id"].'">Reply</button>
        </div>
      </div>
    <div class="panel-body">'.$row["comment"].'</div>
    </div>
  ';
  $output .= get_reply_comment($connect, $row["id"]);
}

echo $output;

function get_reply_comment($connect, $parent_id = 0, $marginleft = 0){
  $query = "SELECT * FROM comment WHERE parent_id = '".$parent_id."'";

  $output = '';
  $statement = $connect->prepare($query);
  $statement->execute();
  $result = $statement->fetchAll();
  $count = $statement->rowCount();
  if($parent_id == 0){
    $marginleft = 0;
  }else {
    $marginleft = $marginleft + 45;
  }
  if($count > 0){
    foreach($result as $row){
      $output .= '
        <div class="panel panel-default" style="margin-left:'.$marginleft.'px">
        <div class="panel-heading"><b>'.$row["name"].'</b> <i>'.$row["date"].'</i></div>
        <div class="panel-body">'.$row["comment"].'</div>
        </div>
      ';
      //sioje vietoje galima padaryti rekursini sakini kad funkcija kreiptusi i save ir taip butu galima atsakyti i vaiku vaiku komentarus ir pan.
    }
  }
  return $output;
}

?>
