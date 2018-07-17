<?php
mysqli_query($con,"INSERT INTO comment (email,name,comment,parent_id) VALUES ('$email','$name','$comment','$parent_id')");
mysqli_query($con,"SELECT * FROM comment ORDER BY id DESC");
