<?php
# 게시물 등록
header('Content-Type: text/html; charset=utf-8');

require_once 'DB.php';
$conn = db_connect();

$stmt = $conn->prepare('INSERT INTO board(title, content, reg_date) VALUES(?, ?, now())');
$stmt->bind_param('ss', $title, $content);

$title = $_POST['title'];
$content = $_POST['content'];
$stmt->execute();
header('Location: list.php');

$resert = mysqli_query($conn, $sql);
?>