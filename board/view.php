<?php
#게시물 보기
header('Content-Type: text/html; charset=utf-8');
include "../include/header.php";
session_start();

//섹션으로 받아온 사용자
$user = $_SESSION['user_id'];
//관리자 레벨 : 1
$adm_level = 1;
//게시판 번호
$board_sid = $_GET['board_sid'];
//제목, 작성자, 내용 SQL
$sql = "SELECT title, writer, content FROM board WHERE board_sid=$board_sid";
$result = mysqli_query($conn, $sql);
$board = mysqli_fetch_array($result);
//제목
$title = $board['title'];
//내용
$content = htmlspecialchars_decode($board['content']);
//작성자
$writer = $board['writer'];
//첨부파일
// TODO : 첨부파일 기능구현
$sql = "SELECT board_sid, file_name_down FROM file WHERE board_sid=$board_sid";
$result = mysqli_query($conn, $sql);
$file = mysqli_fetch_array($result);
$f_name = $file['file_name_down']; 
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/screens/board_view.css">
    <title>게시판</title>
</head>
<body>
    <!-- <div class="move">
      <a href="list_view.php?board_sid=<?= ($board_sid-1) ?> ">< 이전 게시물</a>
      <a href="list_view.php?board_sid=<?= ($board_sid+1) ?>">다음 게시물 ></a>
    </div> -->
    <div class="table-content">
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
      <td colspan="2" class="content"><?php echo $content;?></td>
    </tr>
    <?php
      if(!is_null($f_name)){
    ?>
      <tr>
        <th scope="row" class="th-file">첨부파일</th>
        <td colspan="2" class="file-name"><a href="file-download.php?fname=<?= $f_name?>&id=<?=$board_sid?>"><?php echo $f_name; ?></a></td>
      </tr>
    <?php
      }
    ?>
  </tbody>
</table>
   <div class="col-auto submit submit-btn">
        <button type="button" class="btn btn-outline-secondary submit-btn__list" onclick="location.href='list.php'">목차</button>
        <?php if($user==$writer || $user==$admin) {?>
          <button type="button" class="btn btn-secondary submit-btn__delete" onclick="location.href='process.php?mode=delete&board_sid=<?= $board_sid ?>'">삭제</button>
          <button type="button" class="btn btn-secondary submit-btn__modify" onclick="location.href='modify_write.php?board_sid=<?= $board_sid ?>'">수정</button>
        <?php } ?>
    </div> 
    </div>
 
   <div class="comment">
    <form action="comment/process_comm_insert.php" method="post">
      <input type="hidden" value="<?php echo $id;?>" name="id">
      <h5>댓글</h5>
      <div class="input-group mb-3">
        <input type="text" class="form-control" name="comm_content" placeholder="댓글을 입력하세요." aria-label="Recipient's user_name" aria-describedby="button-addon2">
        <div class="input-group-append">
          <input class="btn btn-outline-secondary comm__btn"  type="submit" id="button-addon2" value="입력" onclick="location.href='comment/process_comm_insert.php'">
        </div>
      </div>
      <div class="comm__view">
      <hr>
    </form>
      <?php
        $comm_sql = "select no, user_id, comment, date from comment where board_id = (select id from board WHERE id=$id) order by no desc";
        $comm_stmh = $conn->query($comm_sql);

        while ($row = $comm_stmh->fetch_assoc()) { ?>
          <b><?php echo $row['user_id']; ?></b>(<?php echo $row['date']; ?>)<br/>
          <?php echo $row['comment']; ?><br/>
          <?php if($user==$row['user_id']|| $user==$admin){ ?>
          <div class="comm__forms" style="display:flex">
          <form action="comment/comm_modify.php?id=<?=$id?>" mode="POST" class="comm__form">
            <input type="hidden" value="<?php echo $row['no'];?>" name="comm_no">
            <button type="submit" class="comm-btn__mod btn btn-outline-secondary">수정</button>
          </form> 
          <form action="comment/process_comm_delete.php" mode="POST" class="comm_form">
            <input type="hidden" value="<?php echo $row['no'];?>" name="comm_no">
            <button type="submit" class="comm-btn__del btn btn-outline-secondary">삭제</button>
          </form>
          </div>
          <?php } ?>
          <hr>
      <?php
        } 
      ?>    
   </div>
   </div>
</body>
</html>