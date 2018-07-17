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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  </head>
  <body>
    <h1 align="center">Comment form</h1>
    <br>

    <div class="container">
      <form method="post" id="comment_form">

        <div class="form-group">
          <input type="email" name="comment_email" id="comment_email" class="form_control" placeholder="example@example.com"/>
          <input type="name" name="comment_name" id="comment_name" class="form_control" placeholder="Your name here"/>
        </div>

        <div class="form-group">
          <textarea name="comment_content" id="comment_content" class="form-control" rows="5"></textarea>
        </div>

        <div class="form-group">
          <input type="hidden" name="comment_id" value="0" id="comment_id"/>
          <input type="submit" name="submit" value="Submit" id="submit" class="btn btn-info"/>
        </div>
      </form>
      <span id="comment_message"></span>
      <br>
      <div id="display_comment"></div>
    </div>
  </body>
</html>

<script>
  $(document).ready(function(){
    $('#comment_form').on('submit', function(event){
      event.preventDefoult();
      var form_data = $(this).serialize();
      $.ajax({
        url:"add_comment.php";
        method:"POST";
        data:form_data;
        dataType:"JSON";
        success:function(data){
          if(data.error != ''){
            $('comment_form')[0].reset();
            $('comment_message').html(data.error);
            $('comment_id').val('0');
            load_comment();
          }
        }
      })
    })

  load_comment();

  function load_comment(){
    $.ajax({
      url:"fetch_comment.php";
      method:"POST";
      success:function(data){
        $('#display_comment').html(data);
      }
    })
  }

  $(document).on('click', '.reply', function(){
    var comment_id = $(this).attr("id");
    $('#comment_id').val(comment_id);
    $('#comment_email').focus();
  });

});
</script>
