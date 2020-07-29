<?php
# 해당 게시판 내용 보기
header('Content-Type: text/html; charset=utf-8');
require_once 'DB.php';
$conn = db_connect();
$id = $_GET['id'];
$sql = "SELECT title, content FROM board WHERE id=$id";
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
   <div class="col-auto submit submit-btn">
        <button type="button" class="btn btn-outline-secondary submit-btn__list" onclick="location.href='list.php'">목차</button>
        <button type="button" class="btn btn-secondary submit-btn__delete" onclick="location.href='process_delete.php?id=<?= $id ?>'">삭제</button>
        <button type="button" class="btn btn-secondary submit-btn__modify" onclick="location.href='modify.php?id=<?= $id ?>'">수정</button>
    </div> 
   </article>
 
   <article class="comment">
   <h5>댓글</h5>
   <div class="input-group mb-3">
   <textarea name="content" class="form-control comment_text" placeholder="댓글을 입력하세요." id="commentText" rows="2" value="" required></textarea>
    <div class="input-group-append">
      <button class="btn btn-outline-secondary comment__btn" type="button" id="commentButton">등록</button>
    </div>
  </div>
   <hr>
   <div class="comment__view">
     <ul id="comLists">
      <?php
        $comSql = "SELECT content FROM comment WHERE board_id=$id";
        $comStmh = $conn->query($comSql);
        while($comRow = $comStmh->fetch_assoc()){?>
          <li><?php echo $comRow['content'] ?></li>
        <?php
        }
      ?>
  </ul>
   </div>
   </article>
</body>
</html>