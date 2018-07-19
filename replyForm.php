<form method="POST" id="reply_form">

  <div class="form-group">
    <input type="email" name="comment_email" id="comment_email" class="form-control" placeholder="example@example.com"/>
    <input type="name" name="comment_name" id="comment_name" class="form-control" placeholder="Your name here"/>
  </div>

  <div class="form-group">
    <textarea name="comment_content" id="comment_content" class="form-control" rows="5"></textarea>
  </div>

  <div class="form-group">
    <input type="hidden" name="comment_id" value="0" id="comment_id"/>
    <input type="submit" name="submit" id="submit" class="btn btn-info" value="Submit" />
  </div>
</form>
