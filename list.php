<?php
# 게시판 목록
?>
<!DOCTYPE html>
<?php
require_once 'DB.php';
$conn = db_connect();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="css/listStyle.css">
    <title>게시판 목차</title>
</head>
<body>
    <div class="list-table">
    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">목차</th>
          <th scope="col">제목</th>
          <th scope="col">내용</th>
          <th scope="col">작성일</th>
        </tr>
      </thead>
      <?php
      $sql = 'select id, title, content, reg_date from board order by id desc';
      // $com_sql = 'select count(no) from comment';
      // $comSql = 'select no from comment,board where comment.board_id= board.id';
      $stmh = $conn->query($sql);
      $comSql = 'select no from comment';
      $comStmh = $conn->query($comSql);
      $boardCount = $stmh->num_rows;
      $comCount = $comStmh->num_rows;
      if ($boardCount < 1) { ?>
        <td colspan="4">
        <p class="no-board">게시물이 없습니다.</p>
        </td>
        <?php } else { ?>
      <?php while ($row = $stmh->fetch_assoc()) { ?>
        <tr onclick="location.href='list_view.php?id=<?= $row['id'] ?>'" style="cursor:hand">
          <th scope="row"><?= $row['id'] ?></th>
          <td><?php echo $row['title']." [".$comCount."]"; ?></td>
          <td><?= $row['content'] ?></td>
          <td><?= $row['reg_date'] ?></td>
        </tr>
      <?php }}
      ?>
        </table>
        <div class="col-auto input input-btn">
          <button class="btn btn-secondary" onclick="location.href='input.php'">등록</button>
      </div> 
  </div>   
</body>
</html>