<?php 
# 댓글 창 수정
    header('Content-Type: text/html; charset=utf-8');

    session_start();

    require_once '../DB.php';
    $conn = db_connect();

    $comm_no = $_GET['comm_no'];
    
    $sql = "DELETE FROM comment WHERE no = $comm_no";    
    $result = mysqli_query($conn, $sql);
?>
<script>
    history.back();
</script>