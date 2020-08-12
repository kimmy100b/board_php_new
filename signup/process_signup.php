<?php

header('Content-Type: text/html; charset=utf-8');

require_once '../DB.php';
$conn = db_connect();

$id = $_POST["memberId"];
$pw = $_POST["memberPw"];
$pw_hash = hash("sha256", $pw);
$name = $_POST["memberName"];
$tel = $_POST['memberTel'];
$email = $_POST['memberEmail'];

$idsql = "select id from member where id = '".$id."'";
$idstmt = mysqli_query($conn, $idsql);
$idmember = mysqli_fetch_array($idstmt);

if($idmember !=0){
?>
<script>
    alert("아이디가 중복되었습니다.");
    history.back();
</script>
<?php
} else{
$sql = "INSERT INTO member(id, passwd, name, tel, email, reg_date, level) VALUES('".$id."', '".$pw_hash ."', '".$name."', '".$tel."', '".$email."',now(), 1)";
$result = mysqli_query($conn, $sql);
header('Location: signup_result.php');}

?>