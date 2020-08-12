<?php
#회원레벨 수정
    header('Content-Type: text/html; charset=utf-8');
    require_once '../DB.php';
    $conn = db_connect();   

    session_start();
    $user=$_SESSION['memberId'];

?>