<?php
/*
Martynas Petruška
Didelis pagalbos saltinis:
https://www.webslesson.info/2017/12/comments-system-using-php-and-ajax.html
*/
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Comments</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="js/jquery-3.2.1.min.js"></script>
  </head>
  <body>
    <hr>
    <h1 align="center">Comment form</h1>
    <hr>
    <br>
    <div class="container">
      <?php include'commentForm.php';?>
      <span id="comment_message"></span>
      <br>
      <div id="display_comment"></div>
    </div>
  </body>
</html>

<script>
  $(document).ready(function(){//Si eilute reikalinga tam, kad scriptas butu paleistas tada tikkai visas puslapis uzkrautas.
    $('#comment_form').on('submit', function(event){
      event.preventDefault(); //reikalingas kad neperkrautu puslapio
      var form_data = $(this).serialize(); //reikalingas uzkoduoti duomenis
      $.ajax({
        url:"add_comment.php",
        method:"POST",
        data:form_data,
        dataType:"JSON",
        success:function(data){
          if(data.error != ''){
            $('#comment_form')[0].reset();
            $('#comment_message').html(data.error);
            $('#comment_id').val('0');
            load_comment();
          }
        }
      })
    });

  load_comment();

  function load_comment(){
    $.ajax({
      url:"fetch_comment.php",
      method:"POST",
      success:function(data){
        $('#display_comment').html(data);
      }
    })
  }

  $(document).on('click', '.reply', function(){
    var comment_id = $(this).attr("id");
    $('#comment_id').val(comment_id);
    $('#comment_email').focus();
    //$('#comment_form').hide(500);
    //$('#reply_form').show(500);
  });

});

</script>
