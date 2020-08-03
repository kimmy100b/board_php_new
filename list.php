<?php
# 게시판 목록
?>
<!DOCTYPE html>
<?php
require_once 'DB.php';
$conn = db_connect();

session_start();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/listStyle.css">
    <title>게시판 목차</title>
</head>
<body>
  <div class="login">
    <?php 
      if(isset($_SESSION['memberId'])){ ?>
      <p class="login__msg"><?php echo $_SESSION['memberId'];?>님 안녕하세요  </p> <button class="btn btn-outline-secondary logout__btn" onclick="location.href='login/logout.php'">로그아웃</button>

    <?php
      }else{
        ?>
      <button class="btn btn-outline-secondary login__btn" onclick="location.href='login/login_form.php'">로그인</button>
      <button class="btn btn-outline-secondary signup__btn" onclick="location.href='signup/signup_form.php'">회원가입</button>
    <?php
      }
    ?>
  </div>
    <div class="list-table">
    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">목차</th>
          <th scope="col">작성자</th>
          <th scope="col">제목</th>
          <th scope="col">내용</th>
          <th scope="col">작성일</th>
        </tr>
      </thead>
      <?php
      $sql = 'select (select count(no) from comment as a where a.board_id = b.id) as comm_cnt ,id, writer, title, content, reg_date from board as b order by id desc';
      $stmh = $conn->query($sql);
      $board_count = $stmh->num_rows;
      if ($board_count < 1) { ?>
        <td colspan="4">
        <p class="no-board">게시물이 없습니다.</p>
        </td>
        <?php } else { ?>
      <?php while ($row = $stmh->fetch_assoc()) { ?>
        <tr style="cursor:hand">
          <th scope="row"><?= $row['id'] ?></th>
          <td><?= $row['writer'] ?></td>
          <?php 
            $title = $row['title'];
            if(strlen($title)>12){
              $title = str_replace($row['title'], mb_substr($row['title'], 0, 12, "utf-8")."...",$row['title']);
            }
          ?>
          <td><a href="list_view.php?id=<?= $row['id'] ?>"><?php echo $title." [".$row['comm_cnt']."]"; ?></a></td>
          <?php
            $content = $row['content'];
            if(strlen($content)>33){
              $content = str_replace($row['content'], mb_substr($row['content'],0,33,"utf-8")."...",$row['content']);
            }
          ?>
          <td><?php echo $content; ?></td>
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