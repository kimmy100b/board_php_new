<?php
# 게시물 등록
header('Content-Type: text/html; charset=utf-8');

require_once 'DB.php';
$conn = db_connect();

settype($_POST['id'], 'integer');
$filtered = array(
  'id'=>mysqli_real_escape_string($conn, $_POST['id']),
  'title'=>mysqli_real_escape_string($conn, $_POST['title']),
  'content'=>mysqli_real_escape_string($conn, $_POST['content'])
);

$sql = "
  UPDATE board
    SET
      title = '{$filtered['title']}',
      content = '{$filtered['content']}'
    WHERE
      id = {$filtered['id']}
";

$result = mysqli_query($conn, $sql);
if($result === false){
  echo '저장하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요';
  error_log(mysqli_error($conn));
} else {
  header('Location: list_view.php?id='.$filtered['id']);
}
?>