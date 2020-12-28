<?php
#검색한 게시물 목록
header('Content-Type: text/html; charset=utf-8');
include "../include/header.php";
// DB연동
include_once "../DB/DBconnect.php";
$DBconnect = new DBconnect();

session_start();

if (isset($_GET["page"])) {
  $page = $_GET["page"];
} else {
  $page = 1;
}

//옵션
$search = $_GET['search-opt'];
//내용
$search_content = $_GET['search-content'];
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
      if ($search == "not") {
        $total_cnt_sql = "SELECT board_sid FROM board WHERE writer LIKE '%$search_content%' OR title LIKE '%$search_content%' OR content LIKE '%$search_content%'";
      } else {
        $total_cnt_sql = "SELECT board_sid FROM board WHERE $search LIKE '%$search_content%'";
      }
      $total_cnt_data = mysqli_query($conn, $total_cnt_sql);
      //게시물 전체 개수
      $total_cnt = mysqli_num_rows($total_cnt_data);
      echo $total_cnt_sql;
      //한 화면에 보여줄 게시물 개수
      $list = 10;
      $block_cnt = 5;
      $block_num = ceil($page / $block_cnt);
      $block_start = (($block_num - 1) * $block_cnt) + 1;
      $block_end = $block_start + $block_cnt - 1;

      $total_page = ceil($total_cnt / $list);
      if ($block_end > $total_page) {
        $block_end = $total_page;
      }
      $total_block = ceil($total_cnt / $list);
      if ($block_end > $total_page) {
        $block_end = $total_page;
      }
      $total_block = ceil($total_page / $block_cnt);
      $page_start = ($page - 1) * $list;


      if (!is_null($search)) {
        $sql = "SELECT (SELECT COUNT(comment_sid) FROM comment AS a where a.board_sid = b.board_sid) AS comm_cnt ,board_sid, writer, title, content, register_date, passwd FROM board AS b WHERE $search LIKE '%$search_content%' ORDER BY board_sid DESC LIMIT $page_start, $list";
      } else {
        $sql = "SELECT (SELECT COUNT(comment_sid) FROM comment AS a where a.board_sid = b.board_sid) AS comm_cnt ,board_sid, writer, title, content, register_date, passwd FROM board AS b WHERE title LIKE '%$search_content%' OR writer LIKE '%$search_content%' OR content LIKE '%$search_content%' ORDER BY board_sid DESC LIMIT $page_start, $list";
      }
      $result = mysqli_query($conn, $sql);

      if ($total_cnt < 1) { ?>
        <td colspan="4">
          <p class="no-board">게시물이 없습니다.</p>
        </td>
      <?php } else { ?>
        <?php while ($row = mysqli_fetch_array($result)) { ?>
          <tr>
            <th scope="row">
              <?php
              echo $index;
              $index = $index - 1;
              ?>
            </th>
            <td><?= $row['writer'] ?></td>
            <?php
            $title = $row['title'];
            if (strlen($title) > 12) {
              $title = str_replace($row['title'], mb_substr($row['title'], 0, 12, "utf-8") . "...", $row['title']);
            }

            if (!empty($row['passwd'])) { ?>
              <!-- TODO : 비밀번호 게시물 -->
              <td><a href="./board/board_pw.php?board_sid=<?= $row['board_sid'] ?>"><?php echo $title . " [" . $row['comm_cnt'] . "]"; ?></a><i class='fas fa-lock'></i></td>
            <?php
            } else {
            ?>
              <td><a href="view.php?board_sid=<?= $row['board_sid'] ?>"><?php echo $title . " [" . $row['comm_cnt'] . "]"; ?></a> </td>
            <?php
            }
            ?>

            <?php
            $content = strip_tags(htmlspecialchars_decode($row['content']));
            if (strlen($content) > 33) {
              $content = str_replace($content, mb_substr($content, 0, 33, "utf-8") . "...", $content);
            }
            if (!empty($row['passwd'])) { ?>
              <td><?php echo "비밀글입니다."; ?></td>
            <?php
            } else {
            ?>
              <td><?php echo $content; ?></td>
            <?php
            }
            ?>

            <td><?= $row['reg_date'] ?></td>
          </tr>
      <?php }
      }
      ?>
    </table>
    <div class="col-auto input input-btn">
      <button class="btn btn-secondary btn-enroll" onclick="location.href='input.php'">등록</button>
    </div>
  </div>
  <div class="page-num" style="text-align: center;">
    <?php
    if ($page < 1) { // 빈 값
    } else {
      echo "<a href='search-list.php?page=1&search__nav=$search&search__content=$search_content'>처음</a>";
    }
    if ($page < 1) { // 빈 값
    } else {
      $pre = $page - 1;
      echo "<a href='search-list.php?page=$pre&search__nav=$search&search__content=$search_content'>◀ 이전</a>";
    }
    for ($i = $block_start; $i <= $block_end; $i++) {
      if ($page == $i) {
        echo "<b> $i </b>";
      } else {
        echo "<a href = 'search-list.php?page=$i&search__nav=$search&search__content=$search_content'> $i </a>";
      }
    }

    if ($page >= $total_page) { //빈 값
    } else {
      $next = $page + 1;
      echo "<a href='search-list.php?page=$next&search__nav=$search&search__content=$search_content'>다음 ▶</a>";
    }
    if ($page >= $total_page) { // 빈 값
    } else {
      echo "<a href='search-list.php?page=$total_page&search__nav=$search&search__content=$search_content'>마지막</a>";
    }
    ?>
  </div>
  <div class="search">
    <select name="search-opt" id="search-opt" class="form-control search-opt" form="searchForm">
      <option value="not" selected>-선택-</option>
      <option value="writer">작성자</option>
      <option value="title">제목</option>
      <option value="content">내용</option>
    </select>
    <!-- TODO : search-list만들기 -->
    <form action="search.php" method="GET" class="search" id="searchForm">
      <input type="text" class="form-control search-input" id="search-input" placeholder="Search" name="search-content">
      <button class="btn btn-outline-secondary search-btn" type="submit" id="button-addon2"><i class="fas fa-search"></i></button>
    </form>
  </div>
</body>

</html>