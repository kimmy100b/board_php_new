<?php
# 회원가입 화면
include "../include/header.php";
?>
<!DOCTYPE html>
<html lang="ko">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/index.css">
  <title>회원가입</title>
</head>

<body class=".join">
  <main class="main-join">
    <form action="./join_process.php" method="POST" class="row g-3">
      <div class="mb-3 row">
        <label for="inputId" class="col-sm-2 col-form-label">아이디*</label>
        <div class="col-sm-10 join-id">
          <input type="text" class="form-control" id="inputId" name="inputId" placeholder="아이디를 입력하세요" required>
          <button type="button" class="btn btn-primary mb-3 join-id-btn" onclick="checkid()">중복</button>
        </div>
      </div>

      <div class="mb-3 row">
        <label for="inputPassword" class="col-sm-2 col-form-label">비밀번호*</label>
        <div class="col-sm-10">
          <input type="password" class="form-control" id="inputPassword" name="inputPassword" placeholder="비밀번호를 입력하세요" required>
        </div>
      </div>

      <div class="mb-3 row">
        <label for="inputName" class="col-sm-2 col-form-label">이름*</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="inputName" name="inputName" placeholder="이름을 입력하세요" required>
        </div>
      </div>
      <div class="mb-3 row">
        <label for="inputTel" class="col-sm-2 col-form-label">전화번호*</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="inputTel" name="inputTel" placeholder="전화번호를 입력하세요" required>
        </div>
      </div>
      <div class="mb-3 row">
        <label for="inputEmail" class="col-sm-2 col-form-label">이메일*</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="inputEmail" name="inputEmail" placeholder="이메일을 입력하세요" required>
        </div>
      </div>
      <button type="submit" class="btn btn-primary">회원가입</button>
    </form>
    <main>
      <script>
        function checkid() {
          var inputId = document.getElementById("inputId").value;
          var checkId = false;
          if (inputId) {
            url = "idOverlap.php?inputId=" + inputId;
            window.open(url, "아이디 중복체크", "width=300,height=100");
          } else {
            alert("아이디를 입력하세요.");
          }
        }
      </script>
</body>

</html>