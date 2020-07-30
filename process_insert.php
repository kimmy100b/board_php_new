<?php
# 게시물 등록
header('Content-Type: text/html; charset=utf-8');

session_start();

require_once 'DB.php';
$conn = db_connect();

$stmt = $conn->prepare('INSERT INTO board(writer, title, content, reg_date) VALUES(?,?, ?, now())');
$stmt->bind_param('sss', $writer, $title, $content);

$writer = $_SESSION['memberId'];
$title = $_POST['title'];
$content = $_POST['content'];
$stmt->execute();
header('Location: list.php');

$result = mysqli_query($conn, $sql);
?>