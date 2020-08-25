<?php
# 회원가입 기능 구현
header('Content-Type: text/html; charset=utf-8');

//DB연동
require_once '../DBconnect.php';
$DBconnect = new DBconnect();

//사용자 아이디
$userId = $_POST["userId"];
//사용자 비밀번호
$userPw = $_POST["userPw"];
//사용자비밀번호 암호화
$userPw_hash = hash("sha256", $userPw);
//사용자 이름
$userName = $_POST["userName"];
//사용자 전화번호
$userTel = $_POST['userTel'];
//사용자 이메일
$userEmail = $_POST['userEmail'];

$id_sql = "select id from user where id = '".$id."'";
$id_stmt = mysqli_query($conn, $idsql);
$id_user = mysqli_fetch_array($id_stmt);

if($id_user !=0){
?>
<script>
    alert("아이디가 중복되었습니다.");
    history.back();
</script>
<?php
} else{
$sql = "INSERT INTO user(userId, userPasswd, userName, userPhone, userEmail, reg_date, level) VALUES('".$userId."', '".$userPw_hash ."', '".$userName."', '".$userTel."', '".$userEmail."',now(), 0)";
$result = mysqli_query($conn, $sql);
header('Location: ../board/list.php');
}
?>