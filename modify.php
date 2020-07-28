<?php
# 게시물 내용 수정

require_once 'DB.php';
$conn = db_connect();
$sql = "SELECT * FROM board WHERE id=$id";
$id = $_GET['id'];
$result = mysqli_query($conn, $sql);
$board = mysqli_fetch_array($result);
$title = $board['title'];
$content = nl2br($board['content']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<form action="./process_modify.php" method="POST" >
  <div class="form-group">
    <label for="exampleFormControlInput1">제목</label>
    <input type="text" name="title" class="form-control" id="exampleFormControlInput1" value="<?= strip_tags($title) ?>" required>
  </div>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">내용</label>
    <textarea name="content" class="form-control" id="exampleFormControlTextarea1" rows="4" required>
    <?= strip_tags($content) ?></textarea>
  </div>
   <div class="col-auto submit">
      <button type="submit" class="btn btn-secondary">제출</button>
    </div> 
</form>
</body>
</html>