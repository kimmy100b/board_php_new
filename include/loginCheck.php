<?php
//로그인 되어있는 지 확인
if (isset($_SESSION['is_login'])) {
    $user = $_SESSION['user_id'];
    if (isset($_SESSION['is_admin'])) {
        $is_admin = true;
    }
} else { ?>
    <script>
        alert("로그인하세요");
        location.href = "../member/login.php";
    </script>
<?php
}
?>