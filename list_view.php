<?php
# 해당 게시판 내용 보기

session_start();

require_once 'DB.php';
$conn = db_connect();

$user = $_SESSION['memberId'];
$admin = "admin";

$id = $_GET['id'];
$sql = "SELECT title, writer, content FROM board WHERE id=$id";
//$board = $conn->query($sql);
$result = mysqli_query($conn, $sql);
$board = mysqli_fetch_array($result);
$title = $board['title'];
$content = nl2br($board['content']);
$writer = $board['writer'];
//$board = mysqli_fetch_row($stmt);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/listViewStyle.css">
    <title>Document</title>
</head>
<body>
    <article class="article">
    <table class="table table-bordered">
  <tbody>
    <tr>
      <th scope="row" class="th-title">제목</th>
      <td><?php echo $title; ?></td>
    </tr>
    <tr>
      <th scope="row" class="th-writer">작성자</th>
      <td><?php echo $writer; ?></td>
    </tr>
     <tr>
      <td colspan="2" class="content"><?php echo $content; ?></td>
    </tr>
  </tbody>
</table>
   <div class="col-auto submit submit-btn">
        <button type="button" class="btn btn-outline-secondary submit-btn__list" onclick="location.href='list.php'">목차</button>
        <?php if($user==$writer || $user==$admin) {?>
          <button type="button" class="btn btn-secondary submit-btn__delete" onclick="location.href='process_delete.php?id=<?= $id ?>'">삭제</button>
          <button type="button" class="btn btn-secondary submit-btn__modify" onclick="location.href='modify.php?id=<?= $id ?>'">수정</button>
        <?php } ?>
    </div> 
   </article>
 
   <article class="comment">
   <h5>댓글</h5>
   <div class="input-group mb-3">
    <input type="text" class="form-control" name="comment_content" placeholder="댓글을 입력하세요." aria-label="Recipient's username" aria-describedby="button-addon2">
    <div class="input-group-append">
      <button class="btn btn-outline-secondary comment__btn" type="button" id="button-addon2">입력</button>
    </div>
  </div>
   <hr>
   <div class="comment__view">
     <p>댓글 내용</p>
   </div>
   </article>
</body>
</html>