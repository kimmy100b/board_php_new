<?php
# 비밀번호 입력 창

header('Content-Type: text/html; charset=utf-8');

require_once '../DB/DBconnect.php';
session_start();
$conn = db_connect();

$user = $_SESSION['user_id'];
$id = $_GET['id'];
$input_pw = $_POST['input_pw'];

$sql = "select id, passwd from board where id = $id";
$result = mysqli_query($conn, $sql);
$board = mysqli_fetch_array($result);

if ($board['passwd'] == $input_pw || $user == "admin") {  ?>
    <script>
        location.href = "../list_view.php?id=<?= $id ?>";
    </script>
<?php
} else {  ?>
    <script>
        alert("비밀번호가 일치하지 않습니다.");
        history.back();
    </script>
<?php
}
?>