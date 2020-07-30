<?php

header('Content-Type: text/html; charset=utf-8');

require_once '../DB.php';
$conn = db_connect();

$id = $_POST["memberId"];
$pw = $_POST["memberPw"];
$name = $_POST["memberName"];
$tel = $_POST['memberTel'];
$email = $_POST['memberEmail'];
$sql = "INSERT INTO member(id, passwd, name, title, email, reg_date, level) VALUES($id, $passwd, $name, $tel, $email,now(), 1)";

header('Location: signup_result.php');

$result = mysqli_query($conn, $sql);

?>