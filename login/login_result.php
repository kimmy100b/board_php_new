<?php
    header('Content-Type: text/html; charset=utf-8');
    session_start();

    require_once '../DB.php';
    $conn = db_connect();

    $mem_id = $_POST["memberId"];
    $mem_pw = $_POST["memberPw"];
    $chbox = $_REQUEST["chbox"];

    if(isset($chbox)){ //isset는 안에 변수가 설정되어있는 지 확인, 설정되어있으면 true, 설정 안 되어있으면 false
        $a = setcookie("memberId", $mem_id, time()+60*60*60);
        $b = setcookie("memberPw", $mem_pw,time()+60*60*60);
    }

    $sql = "SELECT id, passwd, name FROM member WHERE id='".$mem_id."'";
    $result = mysqli_query($conn, $sql);
    
    //아이디가 있다면 비밀번호 검사
    if(mysqli_num_rows($result)==1){
        $row = mysqli_fetch_assoc($result);

        if($row['passwd']==$mem_pw){
            $_SESSION["memberId"]= $mem_id;
            if(isset($_SESSION['memberId'])){
            ?>
             <script>
                alert("로그인되었습니다.");
                location.href="../list.php"
            </script>
            <?php } else{
                echo "세션 저장실패";
            }
        }
        else{ ?>
            <script>
                alert("아이디 혹은 비밀번호가 일치하지 않습니다.");
                history.back();
            </script>
        <?php
        }
    }  
?>
