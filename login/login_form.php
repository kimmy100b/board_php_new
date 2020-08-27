<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/loginFormStyle.css">
    <title>로그인</title>
</head>
<body class="align">
  <?php
         /*  if(isset($_COOKIE["user_id"])){
              $_SESSION["user_id"]=$_COOKIE["user_id"];
          }

          if(!isset($_SESSION["user_id"])) { */
      ?>
  <div class="grid">
  <div class="wrapper">
    <form class="form-signin" action="login_result.php" method="POST">       
      <h2 class="form-signin-heading">Please login</h2>
      <input type="text" class="form-control" name="user_id" placeholder="아이디" required="" autofocus="" />
      <input type="password" class="form-control" name="userPw" placeholder="비밀번호" required=""/>      
          <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>   
    </form>
  </div>
<?php
        } else{
    ?>
    <?=$_SESSION["user_id"]?>님 환영합니다.<br/>
    <a href="logout.php">로그아웃</a>
<?php
        }
    ?>
</body>
</html>