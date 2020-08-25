<?php
#게시물 목록
header('Content-Type: text/html; charset=utf-8');
include "../include/header.php";
session_start();

if(isset($_GET["page"])){
    $page = $_GET["page"];
  } else{
    $page = 1;
  }
  
  ?>
  <!DOCTYPE html>
  <html lang="ko">
  <head>
      <meta charset="UTF-8">
      <title>게시판 목차</title>
  </head>
  <body>
    <div class="board-list">
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
        //페이징하는 기능

        //게시물 전체 개수 구하는 SQL
        $total_cnt_sql = 'select board_sid from board';
        $total_cnt_data = mysqli_query($conn, $total_cnt_sql);
        //게시물 전체 개수
        $total_cnt = mysqli_num_rows($total_cnt_data);

        //한 화면에 보여줄 게시물 개수
        $list = 10;
        $block_cnt = 5;
        $block_num = ceil($page/$block_cnt);
        $block_start = (($block_num-1)*$block_cnt) + 1;
        $block_end = $block_start + $block_cnt - 1;
        
        $total_page = ceil($total_cnt/$list);
        if($block_end > $total_page){
          $block_end = $total_page;
        }
        $total_block = ceil($total_cnt/$list);
        if($block_end>$total_page){
          $block_end = $total_page;
        }
        $total_block = ceil($total_page/$block_cnt);
        $page_start = ($page-1)*$list;
        
        //게시판 리스트에 출력할 데이터들 SQL
        $sql = "SELECT (SELECT COUNT(comment_sid) FROM comment AS a where a.board_sid = b.board_sid) AS comm_cnt ,board_sid, writer, title, content, register_date, passwd FROM board AS b ORDER BY board_sid DESC LIMIT $page_start, $list";
        $result = mysqli_query($conn, $sql);
        //게시판 목차 숫자
        $index = $total_cnt/$page;

        if ($total_cnt < 1) { ?>
          <td colspan="4">
          <p class="board-no">게시물이 없습니다.</p>
          </td>
          <?php } else { ?>
        <?php while ($row = mysqli_fetch_array($result)) { ?>
          <tr>
            <th scope="row"><?php echo $index; $index = $index-1; ?></th>
            <td><?= $row['writer'] ?></td>
            <?php 
              $title = $row['title'];
              if(strlen($title)>12){
                $title = str_replace($row['title'], mb_substr($row['title'], 0, 12, "utf-8")."...",$row['title']);
              }
      
              if(!empty($row['passwd'])){?>
              <!-- TODO : 비밀번호 입력 페이지 -->
                <td><a href="./passwd/passwd_form.php?board_sid=<?= $row['board_sid'] ?>"><?php echo $title." [".$row['comm_cnt']."]"; ?></a><i class='fas fa-lock'></i></td>    
              <?php
              } else{
                ?>
                <td><a href="view.php?board_sid=<?= $row['board_sid'] ?>"><?php echo $title." [".$row['comm_cnt']."]"; ?></a> </td>    
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
           
            <td><?= $row['register_date'] ?></td>
          </tr>
        <?php }}
        ?>
          </table>
          <div class="enroll">
            <button class="btn btn-secondary enroll-btn" onclick="location.href='write.php'">등록</button>
        </div> 
    </div>   
    <div class="board-page">
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
    <div class="search">
      <select name="search-opt" id="search-opt" class="form-control search-opt" form="searchForm">
        <option value="" selected>-선택-</option>
        <option value="writer">작성자</option>
        <option value="title">제목</option>
        <option value="content">내용</option>
      </select>
      <!-- TODO : search-list만들기 -->
      <form action="search-list.php" method="GET" class="search" id="searchForm">
        <input type="text" class="form-control search-input" id="search-input" placeholder="Search" name="search-content">
          <button class="btn btn-outline-secondary search-btn" type="submit" id="button-addon2"><i class="fas fa-search"></i></button>
      </form>
    </div>
  </body>
  </html>