<?php
# 해당 게시판 내용 보기
header('Content-Type: text/html; charset=utf-8');
session_start();

require_once 'DB.php';
$conn = db_connect();

$user = $_SESSION['memberId'];
$admin = "admin";

$id = $_GET['id'];
$file = $_POST['file'];
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
    <title>게시판</title>
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
    <tr>
      <th scope="row" class="th-file">첨부파일</th>
      <td colspan="2" class="content"><?php echo $fifle; ?></td>
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
   <form action="comment/process_comm_insert.php" method="post">
   <input type="hidden" value="<?php echo $id;?>" name="id">
   <h5>댓글</h5>
   <div class="input-group mb-3">
    <input type="text" class="form-control" name="comm_content" placeholder="댓글을 작성하려면 로그인 해주세요." aria-label="Recipient's username" aria-describedby="button-addon2">
    <div class="input-group-append">
      <input class="btn btn-outline-secondary comm__btn"  type="submit" id="button-addon2" value="입력" onclick="location.href='comment/process_comm_insert.php'">
    </div>
  </div>
  <div class="comm__view">
  <hr>
      <?php
        $comm_sql = "select no, user_id, comment, date from comment where board_id = (select id from board WHERE id=$id) order by no desc";
        $comm_stmh = $conn->query($comm_sql);

        while ($row = $comm_stmh->fetch_assoc()) { ?>
          <input type="hidden" value="<?php echo $row['no'];?>" name="com_no">
          <b><?php echo $row['user_id']; ?></b>(<?php echo $row['date']; ?>)<br/>
          <?php echo $row['comment']; ?><br/>
          <?php if($row['user_id']==$user|| $row['user_id']==$admin){ ?>
          <button type="button" class="comm-btn__mod btn btn-outline-secondary" onclick="location.href='comment/comm_modify.php'">수정</button>
          <button type="button" class="comm-btn__del btn btn-outline-secondary" onclick="location.href='comment/process_comm_delete.php'">삭제</button>
          <?php } ?>
          <hr>
      <?php
        } 
      ?>    
   </div>
   </form>
   </article>
</body>
</html>