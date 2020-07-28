<?php
# 게시물 등록
header('Content-Type: text/html; charset=utf-8');

require_once 'DB.php';
$conn = db_connect();

$stmt = $conn->prepare('DELETE FROM board WHERE id = ?');
$stmt->bind_param('i', $id);
$id = $_POST['id'];
$stmt->execute();
header('Location: list.php');

$resert = mysqli_query($conn, $sql);
?>
