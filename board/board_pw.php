<?php
#게시물 목록
header('Content-Type: text/html; charset=utf-8');
include "../include/header.php";
include "../include/loginCheck.php";

$board_sid = $_GET['board_sid'];
if (isset($is_admin)) { ?>
    <script>
        document.location.href = 'view.php?board_sid=<?= $board_sid ?>'
    </script>
<?php
}
?>
<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/passwdStyle.css">
    <title>비밀글 인증</title>
</head>

<body>
    <form action="chkPwd_process.php?board_sid=<?= $board_sid ?>" class="infopw" method="POST">
        <h1>비밀글 보기</h1>
        <p>이 글은 비밀입니다. <b>비밀번호를 입력하여 주세요.</b></p>
        <div class="form-group">
            <label for="inputPwd">▶ 비밀번호</label>
            <input type="password" name="inputPwd" class="input-pw form-control" placeholder="비밀번호">
        </div>
        <input type="submit" class="btn btn-secondary" value="확인">
    </form>
</body>

</html>