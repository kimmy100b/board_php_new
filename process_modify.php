<?php
# 게시물 등록
header('Content-Type: text/html; charset=utf-8');

session_start();

require_once 'DB.php';
$conn = db_connect();

$writer = $_SESSION['memberId'];
$admin = "admin";
$title = $_POST['title'];
$content = $_POST['content'];
$id = $_POST['id'];
$sql = "UPDATE board SET title='".$title."', content='".$content."' WHERE id=$id";
$result = mysqli_query($conn, $sql);

$uploads_dir = "./files";
$file = $_FILES['userfile']['tmp_name'];

if(!empty($file)){
  $tmp_name = $_FILES["userfile"]["tmp_name"];
  $name = $_FILES["userfile"]["name"];
  $type = $_FILES["userfile"]["type"];
  $error = $_FILES["userfile"]["error"];
  $size = $_FILES["userfile"]["size"];
  move_uploaded_file($tmp_name, "$uploads_dir/$name");
  
  if($error !=0){ ?>
      <script>
          alert("파일 업로드에 오류가 발생했습니다.");
      </script>
  <?php  
  } else{
      // $sql = "INSERT INTO file(board_id, name, type, tmp, error, size) VALUES($board['id'],'".$name."','".$type."', '".$tmp_name."', $error, $size)";
      $sql = "INSERT INTO file(board_id, name, type, tmp, error, size) VALUES('".$id."','".$name."','".$type."','".$tmp_name."','".$error."','".$size."')";
      $result = mysqli_query($conn, $sql);
  }
}

if($result === false){
  echo '저장하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요';
  error_log(mysqli_error($conn));
} else {
  header('Location: list_view.php?id='.$id);
}
?>