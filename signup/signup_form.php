<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/signupFormStyle.css">
    <title>로그인</title>
</head>
<body>
<form action="./process_signup.php" method="POST">
  <div class="form-group">
    <label for="exampleInputEmail1">아이디*</label>
    <input type="text" class="form-control" name="memberId" placeholder="아이디" aria-describedby="emailHelp" required>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">비밀번호*</label>
    <input type="password" class="form-control" name="memberPw" required>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">이름*</label>
    <input type="text" class="form-control" name="memberName" required>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">전화번호*</label>
    <input type="text" class="form-control" name="memberTel" required>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">이메일*</label>
    <input type="text" class="form-control" name="memberEmail" placeholder="name@example.com" required>
  </div>
  <div class="form-group btn-group">
      <button type="reset" class="btn btn-secondary btn__reset">재작성</button> 
      <button type="submit" class="btn btn-secondary btn__submit">회원가입</button> 
</div>
</form>
</body>
</html>