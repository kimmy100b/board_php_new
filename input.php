<?php
# 회원가입 양식 폼
header('Content-Type: text/html; charset=utf-8');
session_start();
$user=$_SESSION['memberId'];
if(isset($user)){ ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/inputStyle.css">
    <title>게시물 작성</title>
</head>
<body>
<form id="form" action="./process_insert.php" method="POST" enctype="multipart/form-data">
    <?php 
      if(isset($user)){ ?>
    <div class="form-group">
      <label for="exampleFormControlInput1">작성자</label>
      <p> <?php echo $user; ?> </p>
    </div>
    <?php
      }
    ?>

  <div class="form-group">
    <label for="exampleFormControlInput1">제목</label>
    <input type="text" name="title" class="form-control" id="exampleFormControlInput1" placeholder="글 제목" required>
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">비밀번호</label>
    <input type="password" name="passwd" class="form-control" id="exampleFormControlInput1" placeholder="비밀글을 원하실 비밀번호를 입력해주세요">
  </div>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">내용</label>
    <!-- <textarea name="content" class="form-control" id="exampleFormControlTextarea1" rows="4" placeholder="글 내용" required></textarea> -->
    <textarea name="content" id="ir1" rows="10" cols="100"> </textarea>
     
  </div>
  <div class="form-group">
    <label for="exampleFormControlFile1">첨부파일</label>
    <input type="file" name="userfile" class="form-control-file" id="exampleFormControlFile1">
    <!--
    <input type="file" name="userfile[]" class="form-control-file" id="exampleFormControlFile2">
    <input type="file" name="userfile[]" class="form-control-file" id="exampleFormControlFile3">
    <input type="file" name="userfile[]" class="form-control-file" id="exampleFormControlFile4">
    -->
  </div>
   <div class="col-auto submit">
      <input id="saveBtn" type="submit" class="btn btn-secondary" onclick="submitContents(this)" value="제출">
    </div> 
</form>

<?php
}
else{
?>
<script>
  alert("로그인하세요");
  location.href="./login/login_form.php";
</script>
<?php
}
?>
<!-- <script type="text/javascript" src="./se2/js/service/HuskyEZCreator.js" charset="utf-8"></script> -->
<!-- <script type="text/javascript" src="./smarteditor2/workspace/static/js/service/HuskyEZCreator.js" charset="utf-8"></script> -->
<script type="text/javascript" src="./se2/js/service/HuskyEZCreator.js" charset="utf-8"></script>
<!-- <script type="text/javascript" src="./smarteditor2/workspace/static/js/service/HuskyEZCreator.js" charset="utf-8"></script> -->
<script type="text/javascript">
  var oEditors = [];
  nhn.husky.EZCreator.createInIFrame({
      oAppRef: oEditors,
      elPlaceHolder: "ir1",
      sSkinURI: "./se2/SmartEditor2Skin.html",
      fCreator: "createSEditor2"
  });
  function submitContents(elClickedObj) {
 // 에디터의 내용이 textarea에 적용된다.
    oEditors.getById["ir1"].exec("UPDATE_CONTENTS_FIELD", []);

    // 에디터의 내용에 대한 값 검증은 이곳에서
    // document.getElementById("ir1").value를 이용해서 처리한다.

    try {
      elClickedObj.form.submit();
    } catch(e) {}
  }
</script>
</body>
</html>