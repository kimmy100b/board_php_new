<?php
# 게시물 등록
header('Content-Type: text/html; charset=utf-8');

require_once 'DB.php';
$conn = db_connect();
$title = $_POST['title'];
$content = $_POST['content'];
$id = $_POST['id'];
$sql = "UPDATE board SET title='".$title."', content='".$content."' WHERE id=$id";
$result = mysqli_query($conn, $sql);

if($result === false){
  echo '저장하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요';
  error_log(mysqli_error($conn));
} else {
  header('Location: list_view.php?id='.$id);
}
?>