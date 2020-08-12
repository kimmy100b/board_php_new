<?php
# 회원정보를 수정하는 과정
    header('Content-Type: text/html; charset=utf-8');
    session_start();
   
    require_once '../DB.php';
    $conn = db_connect();

    $user=$_SESSION['memberId'];
    $pw = $_POST['memberPw'];
    $pw_hash = hash("sha256", $pw);
    $name = $_POST['memberName'];
    $tel = $_POST['memberTel'];
    $email = $_POST['memberEmail'];

    $sql = "UPDATE member SET passwd = '".$pw_hash."', tel='".$tel."', email = '".$email."' WHERE id= '".$user."'";
    $result = mysqli_query($conn, $sql);

    if($result){ ?>
        <script>
            alert("저장되었습니다");
            location.href="../list.php";
        </script>
    <?php        
    }else{ ?>
        <script>
            alert("실패하였습니다.");
            history.back();
        </script>
    <?php
    }
?>