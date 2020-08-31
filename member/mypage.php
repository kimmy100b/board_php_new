<?php
# 마이페이지 
    header('Content-Type: text/html; charset=utf-8');
    include "../include/header.php";
    session_start();

    $user_id = $_SESSION['user_id'];

    $sql = "SELECT user_name, user_pw, user_phone, user_email, reg_date FROM user WHERE user_id = '".$user_id."'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_array($result);

    //사용자 이름
    $user_name = $user['user_name'];
    //사용자 비밀번호
    $user_pw = $user['user_pw'];
    //사용자 전화번호
    $user_phone = $user['user_phone'];
    //사용자 이메일
    $user_email = $user['user_email'];
    
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/screens/mypage.css">
    <title>회원정보 수정</title>
</head>
<body>
  <h2>회원정보 수정</h2>
<form action="mypage_process.php" method="POST">
  <div class="form-group">
    <label for="id">아이디*</label>
    <input type="text" id="userId" class="form-control" name="userId" placeholder="아이디" value="<?= $user_id?>" required disabled>
  </div>
  <div class="form-group">
    <label for="pw">비밀번호*</label>
    <input type="password" class="form-control" name="userPw"  minlength="6" required>
  </div>
  <div class="form-group">
    <label for="name">이름*</label>
    <input type="text" class="form-control" name="userName" value="<?= $user_name?>" required disabled>
  </div>
  <div class="form-group">
    <label for="phone">전화번호*</label>
    <input type="text" class="form-control" name="userTel" value="<?= $user_phone ?>" required>
  </div>
  <div class="form-group">
    <label for="email">이메일*</label>
    <input type="email" class="form-control" name="userEmail" value="<?= $user_email ?>" required>
  </div>
  <div class="form-group btn-group">
      <button type="submit" class="btn btn-secondary btn-submit">수정</button> 
  </div>
</form>
</body>
</html>