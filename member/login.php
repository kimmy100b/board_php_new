<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/screens/login.css">
    <title>로그인</title>
</head>
<body class="align">
  <div class="grid">
  <div class="wrapper">
    <form class="form-signin" action="login_process.php" method="POST">       
      <h2 class="form-signin-heading">로그인하세요</h2>
      <input type="text" class="form-control" name="user_id" placeholder="아이디" required="" autofocus="" />
      <input type="password" class="form-control" name="user_pw" placeholder="비밀번호" required=""/>      
          <button class="btn btn-lg btn-primary btn-block" type="submit">로그인</button>   
    </form>
  </div>
</body>
</html>