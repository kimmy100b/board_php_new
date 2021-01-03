<?php
#게시물 CUD
header('Content-Type: text/html; charset=utf-8');
// DB연동
include_once "../DB/DBconnect.php";


switch ($_GET['mode']) {
    case "insert":
        $uploads_dir = "../board_files";
        $file = $_FILES['userfile']['tmp_name'];

        $writer = $_POST['writer'];
        $title = $_POST['title'];
        $content = htmlspecialchars($_POST['content'], ENT_QUOTES);
        $passwd = $_POST['passwd'];

        if (empty($passwd)) {
            $sql = "INSERT INTO board(writer, title, content, register_date) VALUES('" . $writer . "','" . $title . "','" . $content . "', now())";
            $result = mysqli_query($conn, $sql);
        } else {
            $sql = "INSERT INTO board(writer, title, content, register_date, passwd) VALUES('" . $writer . "','" . $title . "','" . $content . "', now(), '" . $passwd . "')";
            $result = mysqli_query($conn, $sql);
        }

        $sql = "SELECT board_sid FROM board WHERE writer = '" . $writer . "' and title = '" . $title . "' and content = '" . $content . "'";
        $result = mysqli_query($conn, $sql);
        $board = mysqli_fetch_array($result);

        if (!empty($file)) {
            $tmp_name = $_FILES["userfile"]["tmp_name"];
            $name = $_FILES["userfile"]["name"];
            $type = $_FILES["userfile"]["type"];
            $error = $_FILES["userfile"]["error"];
            $size = $_FILES["userfile"]["size"];
            $timestamp = time();
            $time = date('Y-m-d H:i:s', $timestamp);

            move_uploaded_file($tmp_name, "{$uploads_dir}/{$timestamp}");

            if ($error != 0) { ?>
                <script>
                    alert("파일 업로드에 오류가 발생했습니다.");
                </script>
            <?php
            } else {
                // $sql = "INSERT INTO file(board_id, name, type, tmp, error, size) VALUES($board['id'],'".$name."','".$type."', '".$tmp_name."', $error, $size)";
                $sql = "INSERT INTO file(board_sid, file_name_org, file_name_down, file_type, file_size, file_reg_data) VALUES('" . $board['board_sid'] . "','" . $timestamp . "','" . $name . "','" . $type . "','" . $size . "','" . $time . "')";
                $result = mysqli_query($conn, $sql);
            }
        }

        $msg = "게시물이 등록되었습니다.";
        break;

    case "modify":
        $boardSid = $_GET['board_sid'];

        $uploads_dir = "../board_files";
        $file = $_FILES['userfile']['tmp_name'];

        $writer = $_POST['writer'];
        $title = $_POST['title'];
        $content = htmlspecialchars($_POST['content'], ENT_QUOTES);
        $passwd = $_POST['passwd'];

        if (empty($passwd)) {
            $sql = "UPDATE board SET writer ='" . $writer . "' , title='" . $title . "', content='" . $content . "', modify_date = now() WHERE board_sid = $boardSid";
            $result = mysqli_query($conn, $sql);
        } else {
            $sql = "UPDATE board SET writer='" . $writer . "', title='" . $title . "', content='" . $content . "', modify_date = now() , passwd ='" . $passwd . "' WHERE board_sid = $boardSid";
            $result = mysqli_query($conn, $sql);
        }

        if (!empty($file)) {
            $tmp_name = $_FILES["userfile"]["tmp_name"];
            $name = $_FILES["userfile"]["name"];
            $type = $_FILES["userfile"]["type"];
            $error = $_FILES["userfile"]["error"];
            $size = $_FILES["userfile"]["size"];
            $timestamp = time();
            $time = date('Y-m-d H:i:s', $timestamp);

            move_uploaded_file($tmp_name, "{$uploads_dir}/{$timestamp}");

            if ($error != 0) { ?>
                <script>
                    alert("파일 업로드에 오류가 발생했습니다.");
                </script>
<?php
            } else {
                // $sql = "INSERT INTO file(board_id, name, type, tmp, error, size) VALUES($board['id'],'".$name."','".$type."', '".$tmp_name."', $error, $size)";
                $sql = "INSERT INTO file(board_sid, file_name_org, file_name_down, file_type, file_size, file_reg_data) VALUES('" . $board['board_sid'] . "','" . $timestamp . "','" . $name . "','" . $type . "','" . $size . "','" . $time . "')";
                $result = mysqli_query($conn, $sql);
            }
        }

        $msg = "게시물이 수정되었습니다.";
        break;

    case "delete":
        $boardSid = $_GET['board_sid'];

        $sql = "UPDATE board SET del_yn = 1, delete_date = now() WHERE board_sid = $boardSid";
        $result = mysqli_query($conn, $sql);

        $msg = "게시물이 삭제되었습니다.";
        break;
}
?>
<script>
    alert("<?php echo $msg ?>");
    location.href = "../board/list.php";
</script>