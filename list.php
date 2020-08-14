<?php
# 게시판 목록
header('Content-Type: text/html; charset=utf-8');

require_once 'DB.php';
$conn = db_connect();

session_start();

if(isset($_GET["page"])){
  $page = $_GET["page"];
} else{
  $page = 1;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/2a001071af.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/listStyle.css">
    <script src="https://kit.fontawesome.com/2a001071af.js" crossorigin="anonymous"></script>
    <title>게시판 목차</title>
</head>
<body>
<?php
  include "index.php";
?>
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
      $sql = 'select count(id) as total_cnt from board';
      $stmh = $conn->query($sql);
      $total_count = $stmh->fetch_assoc();

      $list = 10;
      // 한 페이지에 보여지는 list 수
      $block_cnt = 5;
      // 페이지 숫자
      $block_num = ceil($page/$block_cnt);
      $block_start = (($block_num-1)*$block_cnt) + 1;
      $block_end = $block_start + $block_cnt - 1;
      
      $total_page = ceil($total_count['total_cnt']/$list);
      if($block_end > $total_page){
        $block_end = $total_page;
      }
      $total_block = ceil($total_count['total_cnt']/$list);
      if($block_end>$total_page){
        $block_end = $total_page;
      }
      $total_block = ceil($total_page/$block_cnt);
      $page_start = ($page-1)*$list;

      $sql = "select (select count(no) from comment as a where a.board_id = b.id) as comm_cnt ,id, writer, title, content, reg_date, passwd from board as b order by id desc limit $page_start, $list";

      $stmh = $conn->query($sql);
      $board_count = $stmh->num_rows;

      if ($board_count < 1) { ?>
        <td colspan="4">
        <p class="no-board">게시물이 없습니다.</p>
        </td>
        <?php } else { ?>
      <?php while ($row = $stmh->fetch_assoc()) { ?>
        <tr style="cursor:hand">
          <th scope="row"><?php $id=$row['id']; echo $id; ?></th>
          <td><?= $row['writer'] ?></td>
          <?php 
            $title = $row['title'];
            if(strlen($title)>12){
              $title = str_replace($row['title'], mb_substr($row['title'], 0, 12, "utf-8")."...",$row['title']);
            }
    
            if(!empty($row['passwd'])){?>
            
              <td><a href="./passwd/passwd_form.php?id=<?= $row['id'] ?>"><?php echo $title." [".$row['comm_cnt']."]"; ?></a><i class='fas fa-lock'></i></td>    
            <?php
            } else{
              ?>
              <td><a href="list_view.php?id=<?= $row['id'] ?>"><?php echo $title." [".$row['comm_cnt']."]"; ?></a> </td>    
            <?php
            }
            ?>
          
          <?php
            //$content = $row['content'];
            $content = strip_tags(htmlspecialchars_decode($row['content']));
            if(strlen($content)>33){
              $content = str_replace($content, mb_substr($content,0,33,"utf-8")."...", $content);
            }
            if(!empty($row['passwd'])){?>
              <td><?php echo "비밀글입니다."; ?></td>            
            <?php
            } else{
              ?>
               <td><?php echo $content; ?></td>
            <?php
            }
            ?>
         
          <td><?= $row['reg_date'] ?></td>
        </tr>
      <?php }}
      ?>
        </table>
        <div class="col-auto input input-btn">
          <button class="btn btn-secondary btn-enroll" onclick="location.href='input.php'">등록</button>
      </div> 
  </div>   
  <div class="page-num" style="text-align: center;">
    <?php
      if($page<1){ // 빈 값
      } else{
          echo "<a href='list.php?page=1'>처음</a>";
      }
      if($page<1){// 빈 값
      } else{
        $pre = $page - 1;
        echo "<a href='list.php?page=$pre'>◀ 이전</a>";
      }
      for($i = $block_start; $i <= $block_end; $i++){
        if($page==$i){
          echo "<b> $i </b>";
        }else{
          echo "<a href = 'list.php?page=$i'> $i </a>";
        }
      }

      if($page >= $total_page){ //빈 값
      } else{
        $next = $page + 1;
        echo "<a href='list.php?page=$next'>다음 ▶</a>";
      }
      if($page >= $total_page){// 빈 값
      } else{
        echo "<a href='list.php?page=$total_page'>마지막</a>";
      } 
      ?>
  </div>
  <div class="search" style="margin:2% 20%;">
    <select name="search__nav" id="search__nav" class="form-control search__nav" form="searchForm">
      <option value="" selected>-선택-</option>
      <option value="writer">작성자</option>
      <option value="title">제목</option>
      <option value="content">내용</option>
    </select>
    <form action="search-list.php" method="GET" class="search" id="searchForm">
      <input type="text" class="form-control search__input" id="search__input" placeholder="Search" name="search__content">
      <div class="input-group-append">
        <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i class="fas fa-search"></i></button>
      </div>
    </form>
  </div>
</body>
</html>