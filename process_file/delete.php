<?php
# 첨부파일을 삭제하는 기능
header('Content-Type: text/html; charset=utf-8');
session_start();

require_once '../DB.php';
$conn = db_connect();

$user = $_SESSION['memberId'];

$id = $_GET['id'];

$sql = "SELECT board_id, name, type FROM file WHERE board_id=$id";
$result = mysqli_query($conn, $sql);
$file = mysqli_fetch_array($result);
$f_name = $file['name']; 

unlink("../files/".$f_name);

$sql = "DELETE FROM file WHERE board_id=$id";
$result = mysqli_query($conn, $sql);
echo $sql;
exit;
?>
<script>
    // history.back();
</script>