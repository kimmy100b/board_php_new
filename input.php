<?php
# 회원가입 양식 폼
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/inputStyle.css">
    <title>게시물 작성</title>
</head>
<body>
<form action="./process_insert.php" method="POST" >
  <div class="form-group">
    <label for="exampleFormControlInput1">제목</label>
    <input type="text" name="title" class="form-control" id="exampleFormControlInput1" placeholder="제목을 입력하시오" required>
  </div>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">내용</label>
    <textarea name="content" class="form-control" id="exampleFormControlTextarea1" rows="4" required></textarea>
  </div>
   <div class="col-auto submit">
      <button type="submit" class="btn btn-secondary">제출</button>
    </div> 
</form>
</body>
</html>