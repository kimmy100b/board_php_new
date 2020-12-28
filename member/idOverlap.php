<?php
header('Content-Type: text/html; charset=utf-8');
include_once "../DB/DBconnect.php";

$inputId = $_GET['inputId'];
$sql = "select count(*) as cnt from user where user_id = '" . $inputId . "'";
$stmt = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($stmt);
?>


<?php
if ($row['cnt'] <= 0) {
?>
    <div><?php echo $inputId; ?>는 사용가능한 아이디입니다.</div>

<?php
} else {
?>
    <div><?php echo $inputId; ?>는 중복된 아이디입니다.</div>
<?php
}
?>
<button value="닫기" onclick="window.close()">닫기</button>