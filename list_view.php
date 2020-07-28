<?php
# 해당 게시판 내용 보기

require_once 'DB.php';
$conn = db_connect();
$id = $_GET['id'];
$sql = "SELECT title, content, reg_date FROM board WHERE id=$id";
//$board = $conn->query($sql);
$result = mysqli_query($conn, $sql);
$board = mysqli_fetch_array($result);

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
    <article>
    <table class="table table-bordered">
  <tbody>
    <tr>
      <th scope="row" class="th-title">제목</th>
      <td><?= $board['title'] ?></td>
    </tr>
     <tr>
      <td colspan="2" class="content"><?= $board['content'] ?></td>
    </tr>
  </tbody>
</table>
   <div>
   <div class="col-auto submit">
        <button type="button" class="btn btn-outline-secondary btn-list">목차</button>
        <button type="button" class="btn btn-secondary btn-modify">수정</button>
        <button type="button" class="btn btn-secondary btn-delete">삭제</button>
    </div> 
        <a href="modify.php?id=<?= $board['id'] ?>">수정</a>
        <form method="POST" action="process_delete.php">
            <input type="hidden" name="id" value="<?= $board['id'] ?>" />
            <input type="submit" value="삭제" />
        </form>
    </div>
   </article>
</body>
</html>