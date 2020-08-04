<?php
# 게시물 등록
header('Content-Type: text/html; charset=utf-8');

session_start();

require_once 'DB.php';
$conn = db_connect();


$writer = $_SESSION['memberId'];
$title = $_POST['title'];
$content = $_POST['content'];
$passwd = $_POST['passwd'];

if(empty($passwd)){
    $stmt = $conn->prepare('INSERT INTO board(writer, title, content, reg_date) VALUES(?,?, ?, now())');
    $stmt->bind_param('sss', $writer, $title, $content);
} else{
    $stmt = $conn->prepare('INSERT INTO board(writer, title, content, reg_date, passwd) VALUES(?,?, ?, now(), ?)');
    $stmt->bind_param('ssss', $writer, $title, $content, $passwd);
}
$stmt->execute();
header('Location: list.php');
?>