<?php
    header('Content-Type: text/html; charset=utf-8');
    session_start();
    $mem_id = $_POST["memberId"];
    $mem_pw = $_POST["memberPw"];
    $mem_name = $_POST["memberName"];
    $mem_tel = $_POST['memberTel'];
    $mem_email = $_POST['memberEmail'];
    $chbox = $_POST['chbox'];
    // $chbox = $_REQUEST["chbox"];

    $_SESSION["memberId"]= $mem_id;

    if(isset($chbox)){ //isset는 안에 변수가 설정되어있는 지 확인, 설정되어있으면 true, 설정 안 되어있으면 false
        $a = setcookie("memberId", $mem_id, time()+60*60*60);
        $b = setcookie("memberPw", $mem_pw,time()+60*60*60);
    }

    if($mem_id== "admin"&&$mem_pw =="12345"){
        echo "관리자 로그인";

        
    }

    else{
?>

<script>alert("아이디와 비밀번호가 틀립니다!");
history.back();</script>

<?php
    }
?>
