<?php
# 해당 게시판 내용 보기

require_once 'DB.php';
$conn = db_connect();
$id = $_GET['id'];
$sql = "SELECT * FROM board WHERE id=$id";
//$board = $conn->query($sql);
$result = mysqli_query($conn, $sql);
$board = mysqli_fetch_array($result);
$title = $board['title'];
$content = nl2br($board['content']);
//$board = mysqli_fetch_row($stmt);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="css/listViewStyle.css">
    <title>Document</title>
</head>
<body>
    <article class="article">
    <table class="table table-bordered">
  <tbody>
    <tr>
      <th scope="row" class="th-title">제목</th>
      <td><?= $title ?></td>
    </tr>
     <tr>
      <td colspan="2" class="content"><?= $content ?></td>
    </tr>
  </tbody>
</table>
   <div class="col-auto submit">
        <button type="button" class="btn btn-outline-secondary btn-list" onclick="location.href='list.php'">목차</button>
        <button type="button" class="btn btn-secondary btn-modify" onclick="location.href='modify.php?id=<?= $board['id'] ?>'">수정</button>
        <button type="button" class="btn btn-secondary btn-delete" onclick="location.href='process_delete.php?id=<?= $board['id'] ?>'">삭제</button>
    </div> 
   </article>
</body>
</html>