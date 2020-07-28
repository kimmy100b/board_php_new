<?php
# 게시물 등록
header('Content-Type: text/html; charset=utf-8');

require_once 'DB.php';
$conn = db_connect();

$stmt = $conn->prepare('UPDATE board SET title=?, content=? WHERE id=?');
$stmt->bind_param('ssi', $title, $content, $id);
$title = $_POST['title'];
$content = $_POST['content'];
$id = $_POST['id'];
$stmt->execute();
header("Location: list.php?id={$_POST['id']}");

$resert = mysqli_query($conn, $sql);
?>
