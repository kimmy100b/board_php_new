<?php
#게시물 작성화면
header('Content-Type: text/html; charset=utf-8');
include "../include/header.php";
include "../include/loginCheck.php";

if (isset($_GET['board_sid'])) {
    $boardSid = $_GET['board_sid'];

    $sql = "SELECT title, content, writer FROM board WHERE board_sid=$boardSid";
    $result = mysqli_query($conn, $sql);
    $board = mysqli_fetch_array($result);
    //제목
    $title = strip_tags($board['title']);
    //내용
    $content = htmlspecialchars_decode($board['content']);
    $writer = $board['writer'];

    $mode = "modify&board_sid='" . $boardSid . "'";
} else {
    $title = "";
    $content = "";
    $mode = "insert";
}
?>
<!DOCTYPE html>
<html lang="ko">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>게시물 작성</title>
</head>

<body>
    <div class="write-content">
        <form action="./process.php?mode=<?php echo $mode ?>" method="POST" enctype="multipart/form-data">
            <div class="write_form">
                <label for="writer">작성자</label>
                <input type="text" name="writer" class="form-control" id="writer" value="<?php echo $user; ?>" required readonly>
                <!-- <label for="writer">작성자</label>
                <input type="text" name="writer" class="form-control" id="writer" placeholder="작성자" required> -->
            </div>
            <div class="write_form">
                <label for="title">제목</label>
                <input type="text" name="title" class="form-control" id="title" value="<?php echo $title; ?>" placeholder=" 글 제목" required>
            </div>
            <div class="write_form">
                <label for="passwd">비밀번호</label>
                <input type="password" name="passwd" class="form-control" id="passwd" placeholder="비밀글을 원하실 비밀번호를 입력해주세요">
            </div>
            <div class="write_form write_not_setting">
                <label for="content">본문</label>
                <textarea name="content" id="ir1" rows="20" cols="154"><?php echo $content; ?></textarea>
            </div>
            <div class="write_form write_not_setting">
                <label for="file">첨부파일</label>
                <input type="file" name="userfile" class="form-control-file" id="file">
                <!--
                    <input type="file" name="userfile[]" class="form-control-file" id="exampleFormControlFile2">
                    <input type="file" name="userfile[]" class="form-control-file" id="exampleFormControlFile3">
                    <input type="file" name="userfile[]" class="form-control-file" id="exampleFormControlFile4">
                -->
            </div>
            <div class="col-auto submit">
                <input id="saveBtn" type="submit" class="btn btn-secondary" onclick="submitContents(this)" value="등록">
            </div>
        </form>
    </div>
    <script type="text/javascript" src="../se2/js/service/HuskyEZCreator.js" charset="utf-8"></script>
    <script type="text/javascript">
        var oEditors = [];
        nhn.husky.EZCreator.createInIFrame({
            oAppRef: oEditors,
            elPlaceHolder: "ir1",
            sSkinURI: "../se2/SmartEditor2Skin.html",
            fCreator: "createSEditor2"
        });

        function submitContents(elClickedObj) {
            // 에디터의 내용이 textarea에 적용된다.
            oEditors.getById["ir1"].exec("UPDATE_CONTENTS_FIELD", []);

            // 에디터의 내용에 대한 값 검증은 이곳에서
            try {
                elClickedObj.form.submit();
            } catch (e) {}
        }
    </script>

</body>

</html>