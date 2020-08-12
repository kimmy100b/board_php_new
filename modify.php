<?php
# 게시물 내용 수정
require_once 'DB.php';
$conn = db_connect();

$sql = "SELECT title, content FROM board WHERE id=$id";
$id = $_GET['id'];
$result = mysqli_query($conn, $sql);
$board = mysqli_fetch_array($result);
$title = strip_tags($board['title']);
$content = strip_tags(nl2br($board['content']));

$sql = "SELECT board_id, name, type FROM file WHERE board_id=$id";
$result = mysqli_query($conn, $sql);
$file = mysqli_fetch_array($result);
$f_name = $file['name']; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="css/modifyStyle.css">
    <title>Document</title>
</head>
<body>
<form id="form" action="./process_modify.php" method="POST" enctype="multipart/form-data">
<input type="hidden" value="<?php echo $_GET['id'];?>" name="id">
  <div class="form-group">
    <label for="exampleFormControlInput1">제목</label>
    <input type="text" name="title" class="form-control" id="exampleFormControlInput1" value="<?= $title ?>" required>
  </div>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">내용</label>
    <!-- <textarea name="content" class="form-control" id="exampleFormControlTextarea1" rows="4" required> -->
    <textarea name="content" id="ir1" rows="10" cols="100"><?php echo $content; ?></textarea>
  </div>
 
    <div class="form-group">
      <label for="exampleFormControlTextarea1">첨부파일</label>
      <?php if(!is_null($f_name)){?>
        <p><?php echo $f_name; ?><button class="btn-delete btn btn-outline-secondary" onclick="delFile()">삭제</button></p>
      <? } else{?>
        <!-- <button class="btn-delete btn btn-outline-secondary" onclick="">삽입</button></p> -->
        <input type="file" name="userfile" class="form-control-file" id="exampleFormControlFile">
      <?php } ?>
    </div>
  
   <div class="col-auto submit submit-btn">
      <input id="saveBtn" type="submit" class="btn-submit btn btn-secondary" onclick="submitContents(this)" value="수정"></button>
    </div> 
</form>

<script>
  function delFile(){
    unlink("./files/<?=$id?>/<?=$f_name?>");
    <?php
      $sql = "DELETE FROM file WHERE board_id=$id";
      $result = mysqli_query($conn, $sql);
    ?>
  } 
</script>
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