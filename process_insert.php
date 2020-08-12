<?php
# 게시물 등록
header('Content-Type: text/html; charset=utf-8');

session_start();

require_once 'DB.php';
$conn = db_connect();

$uploads_dir = "./files";
$file = $_FILES['userfile']['tmp_name'];

$writer = $_SESSION['memberId'];
$title = $_POST['title'];
$content = htmlspecialchars($_POST['content'],ENT_QUOTES);
$passwd = $_POST['passwd'];

if(empty($passwd)){
    $stmt = $conn->prepare('INSERT INTO board(writer, title, content, reg_date) VALUES(?,?, ?, now())');
    $stmt->bind_param('sss', $writer, $title, $content);
} else{
    $stmt = $conn->prepare('INSERT INTO board(writer, title, content, reg_date, passwd) VALUES(?,?, ?, now(), ?)');
    $stmt->bind_param('ssss', $writer, $title, $content, $passwd);
}
$stmt->execute();

$sql = "SELECT id FROM board WHERE writer = '".$writer."' and title = '".$title."' and content = '".$content."'";
$result = mysqli_query($conn, $sql);
$board = mysqli_fetch_array($result);
/*
for($i=0;$i<count($_FILES['userfile'];$i++){

}
*/
if(!empty($file)){
    $tmp_name = $_FILES["userfile"]["tmp_name"];
    $name = $_FILES["userfile"]["name"];
    $type = $_FILES["userfile"]["type"];
    $error = $_FILES["userfile"]["error"];
    $size = $_FILES["userfile"]["size"];

    if(!is_dir("{$uploads_dir}/{$board['id']}")){
        mkdir("{$uploads_dir}/{$board['id']}",0777,true);
    }else{
    }

    move_uploaded_file($tmp_name, "{$uploads_dir}/{$board['id']}/{$name}");

    if($error !=0){ ?>
        <script>
            alert("파일 업로드에 오류가 발생했습니다.");
        </script>
    <?php  
    } else{
        // $sql = "INSERT INTO file(board_id, name, type, tmp, error, size) VALUES($board['id'],'".$name."','".$type."', '".$tmp_name."', $error, $size)";
        $sql = "INSERT INTO file(board_id, name, type, tmp, error, size) VALUES('".$board['id']."','".$name."','".$type."','".$tmp_name."','".$error."','".$size."')";
        $result = mysqli_query($conn, $sql);
    }
}
header('Location: list.php');
?>