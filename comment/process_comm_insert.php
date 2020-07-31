<?php
 #댓글 창 

    header('Content-Type: text/html; charset=utf-8');

    session_start();

    require_once 'DB.php';
    $conn = db_connect();

    $user_id = $_SESSION['memberId'];
    $board_id = $_POST['id'];
    $comment = $_POST['comm_content'];

    if(isset($user_id)){
        $sql = "INSERT INTO comment(user_id, board_id, comment, date) VALUES ('".$user_id."', $board_id ,'".$comment."', now())";
        $stmt = mysqli_query($conn, $sql);
        
    } else{ ?>
        <script>
            alert("로그인하세요");
            history.back();
        </script>

    <?php
    } ?>
