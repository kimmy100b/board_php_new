<?php
# 회원가입 기능 구현
header('Content-Type: text/html; charset=utf-8');

//DB연동
require_once '../DB/DBconnect.php';

//사용자 아이디
$userId = $_POST["inputId"];
//사용자 비밀번호
$userPw = $_POST["inputPassword"];
//사용자비밀번호 암호화
$userPwHash = hash("sha256", $userPw);
//사용자 이름
$userName = $_POST["inputName"];
//사용자 전화번호
$userTel = $_POST['inputTel'];
//사용자 이메일
$userEmail = $_POST['inputEmail'];

//중복체크
$sql = "select count(*) as cnt from user where user_id = '" . $userId . "'";
$stmt = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($stmt);

if ($row['cnt'] != 0) {
?>
    <script>
        alert("아이디가 중복되었습니다.");
        history.back();
    </script>
    <?php
} else {
    $sql = "INSERT INTO user(user_id, user_pw, user_name, user_phone, user_email, reg_date, admin) VALUES('" . $userId . "', '" . $userPwHash . "', '" . $userName . "', '" . $userTel . "', '" . $userEmail . "',now(), 0)";
    $result = mysqli_query($conn, $sql);

    if ($result) {
    ?>
        <script>
            alert("회원가입이 완료되었습니다.");
            location.href = "../member/login.php";
        </script>
    <?php
    } else { ?>
        <script>
            alert("회원가입을 실패하였습니다.");
            location.href = "../main/main.php";
        </script>
<?php
    }
    // header('Location: ../board/list.php');
}
?>