<?php
 #댓글 창 

    header('Content-Type: text/html; charset=utf-8');

    session_start();

    require_once 'DB.php';
    $conn = db_connect();

    $userid = $_SESSION['memberId'];
    $board_id = $_POST['id'];
    $comment = $_POST['comm_content'];
    
    echo $userid;
    echo $board_id;
    echo $comment;
    $sql = "INSERT INTO comment(userid, board_id, comment, date) VALUES (?, ? ,?, now())";
    
    echo $sql;
    $stmt = mysqli_query($conn, $sql);
?>
<script>
    // histroy.back();
</script>