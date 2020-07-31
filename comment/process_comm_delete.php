<?php 
# 댓글 창 수정
    header('Content-Type: text/html; charset=utf-8');

    session_start();

    require_once '../DB.php';
    $conn = db_connect();

    $user_id = $_SESSION['memberId'];
    $board_id = $_POST['id'];
    $comment = $_POST['comm_content'];
    $comm_no = $_POST['com_no'];

    $sql = "DELETE FROM comment WHERE ";
?>