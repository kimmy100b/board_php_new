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
    <?php
    $sql = 'select * from board';
    $stmh = $conn->query($sql);
    $count = $stmh->num_rows;
    if ($count < 1) {
        print '게시물이 없습니다.<br/>';
    } else {
         ?>
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">목차</th>
      <th scope="col">제목</th>
      <th scope="col">내용</th>
      <th scope="col">작성일</th>
    </tr>
  </thead>
  <?php while ($row = $stmh->fetch_assoc()) { ?>
    <tr onclick="location.href='list_view.php?id=<?= $row['id'] ?>'" style="cursor:hand">
      <th scope="row"><?= $row['id'] ?></th>
      <td><?= $row['title'] ?></td>
      <td><?= $row['content'] ?></td>
      <td><?= $row['reg_date'] ?></td>
    </tr>
  <?php }
    }
    ?>
    </table>
    
</body>
</html>