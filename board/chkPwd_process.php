<?php
#비밀게시물 비밀번호 Check
header('Content-Type: text/html; charset=utf-8');
// DB연동
include_once "../DB/DBconnect.php";

$board_sid = $_GET['board_sid'];
$board_pwd = $_POST['inputPwd'];

$sql = "SELECT passwd FROM board WHERE board_sid = '" . $board_sid . "'";
$stmt = mysqli_query($conn, $sql);
$result = mysqli_fetch_array($stmt);

if ($board_pwd == $result['passwd']) {
?>
    <script>
        location.href = "./view.php?board_sid=<?php echo $board_sid ?>";
    </script>
<?php
} else {
?>
    <script>
        alert("비밀번호가 일치하지 않습니다");
        history.back();
    </script>
<?php
}
?>