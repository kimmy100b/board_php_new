<?php
# 게시물 내용 수정

require_once 'DB.php';
$conn = db_connect();
$stmt = $conn->prepare('INSERT INTO board(title, content, reg_date) VALUES(?, ?, now())');
$stmt->bind_param('ss', $title, $content);
$title = $_POST['title'];
$content = $_POST['content'];
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
<form action="./process.php?mode=modify" method="POST" >
  <div class="form-group">
    <label for="exampleFormControlInput1">제목</label>
    <input type="text" name="title" class="form-control" id="exampleFormControlInput1" value="<?= htmlspecialchars(
        $topic['title']
    ) ?>" required>
  </div>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">내용</label>
    <textarea name="content" class="form-control" id="exampleFormControlTextarea1" rows="4" required>
    <?= htmlspecialchars($topic['description']) ?></textarea>
  </div>
   <div class="col-auto submit">
      <button type="submit" class="btn btn-secondary">제출</button>
    </div> 
</form>
</body>
</html>