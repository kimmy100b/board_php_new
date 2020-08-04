<?php
# 게시물 내용 수정
require_once '../DB.php';
$conn = db_connect();

$sql = "SELECT comment FROM comment WHERE no=$comm_no";
$comm_no = $_GET['comm_no'];
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

</body>
</html>