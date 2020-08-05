<?php
    require_once 'DB.php';
    $conn = db_connect();   

    session_start();
    $user=$_SESSION['memberId'];

    $sql = "SELECT passwd, name, tel, email, reg_date FROM WHERE id = $user";
    $result = mysqli_query($conn, $sql);
    $member = mysqli_fetch_array($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/signupFormStyle.css">
    <title>회원정보 수정</title>
</head>
<body>
<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link" href="../list.php">게시물</a>
    </li>
    <?php
        if($user == $admin){ ?>
            <li class="nav-item">
                <a class="nav-link" href="#">회원관리</a>
            </li>
        <?php
        }
    ?>
    <li class="nav-item">
        <a class="nav-link active" href="#">정보수정</a>
    </li>
    </ul>

<form action="./process_signup.php" method="POST">
  <div class="form-group">
    <label for="exampleInputEmail1">아이디 : <?php echo $user;?></label>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">비밀번호*</label>
    <input type="password" class="form-control" name="memberPw" value="<?= $pw ?>"  required>
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
    <input type="text" class="form-control" name="memberEmail" placeholder="example@email.com" required>
  </div>
  <div class="form-group btn-group">
      <button type="reset" class="btn btn-secondary btn__reset">재작성</button> 
      <button type="submit" class="btn btn-secondary btn__submit">회원가입</button> 
</div>
</form>
<script>
  function checkid(){
    var memid = document.getElementById("inputId").value;
    if(memid){
      url = "process_idOverlap.php?memid="+memid;
      window.open(url,"아이디 중복체크", "width=300,height=100");
    }else{
      alert("아이디를 입력하세요.");
    }
  }
</script>
</body>
</html>