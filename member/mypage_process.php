<?php
# 회원정보를 수정하는 과정
    header('Content-Type: text/html; charset=utf-8');
    // DB연동
    include_once "../DBconnect.php";
    $DBconnect = new DBconnect();
    session_start();

    //사용자 아이디
    $user_id = $_SESSION["user_id"];
    //사용자 비밀번호
    $user_pw = $_POST["userPw"];
    //sha256으로 암호화한 비밀번호
    $pw_hash = hash("sha256",$user_pw);
    //사용자 이름
    $user_name = $_POST['userName'];
    //사용자 전화번호
    $user_tel = $_POST['userTel'];
    //사용자 이메일
    $user_email = $_POST['userEmail'];

    $sql = "UPDATE user SET user_pw = '".$pw_hash."', user_phone='".$user_tel."', user_email = '".$user_email."' WHERE user_id= '".$user_id."'";
    $result = mysqli_query($conn, $sql);
    
    if($result){ ?>
        <script>
            alert("저장되었습니다");
            location.href="../board/list.php";
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