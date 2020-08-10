<?php
# 게시판 목록
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<?php
require_once 'DB.php';
$conn = db_connect();

session_start();

$user=$_SESSION['memberId'];
$admin = "admin"
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link active" href="#">게시물</a>
    </li>
    <?php
        if($user == $admin){ ?>
            <li class="nav-item">
                <a class="nav-link" href="member/manager.php"">회원관리</a>
            </li>
        <?php
        }
    ?>
    <li class="nav-item">
        <a class="nav-link" href="member/mem_modify.php">정보수정</a>
    </li>
    </ul>
</body>
</html>