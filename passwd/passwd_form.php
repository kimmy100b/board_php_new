<?php
# 비밀번호 입력 창

header('Content-Type: text/html; charset=utf-8');

require_once '../DBconnect.php';
session_start();
$conn = db_connect();

$id = $_GET['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/passwdStyle.css">
    <title>비밀글 인증</title>
</head>
<body>
    <form action="process_passwd.php?id=<?= $id ?>" class="infopw" method="POST">
        <input type="hidden" value="<?php echo $id;?>" name="id">
        <h1>비밀글 보기</h1>
        <p>이 글은 비밀입니다. <b>비밀번호를 입력하여 주세요.</b><br/>관리자는 확인버튼만 누르시면 됩니다.</p>
        <div class="form-group">
            <label for="exampleFormControlInput1">▶ 비밀번호</label>
            <input type="password" name="input_pw" class="input-pw form-control" id="exampleFormControlInput1" placeholder="비밀번호">
        </div>
        <input type="submit" class="btn btn-secondary" value="확인">
    </form>
</body>
</html>