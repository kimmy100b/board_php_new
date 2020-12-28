<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/screens/login.css">
    <title>로그인</title>
</head>
<body class="login">
<?php 
  include "../include/header.php";
  ?>
  <main class="main-login">
  <form class="form-login" action="login_process.php" method="POST">
    <h1 class="h3 mb-3 fw-normal">Please log in</h1>
    <label for="inputId" class="visually-hidden">아이디</label>
    <input type="text" id="userId" name="userId" class="form-control" placeholder="아이디를 입력하세요" required="" autofocus="">
    <label for="inputPassword" class="visually-hidden">비밀번호</label>
    <input type="password" id="userPw" name="userPw" class="form-control" placeholder="비밀번호를 입력하세요" required="">
    <div class="checkbox mb-3">
      <label>
        <input type="checkbox" value="remember-me"> Remember me
      </label>
    </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit">login in</button>
  </form>
</main>
</body>
</html>