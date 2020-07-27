<?php
# 게시물 등록
header('Content-Type: text/html; charset=utf-8');

require_once 'DB.php';
$conn = db_connect();

switch ($_GET['mode']) {
    case 'insert':
        $stmt = $conn->prepare('INSERT INTO board(title, content, reg_date) VALUES(?, ?, now())');
        $stmt->bind_param('ss', $title, $content);

        $title = $_POST['title'];
        $content = $_POST['content'];
        $stmt->execute();
        header('Location: list.php');
        break;

    case 'delete':
        $stmt = $dbh->prepare('DELETE FROM board WHERE id = ?');
        $stmt->bindParam('i', $id);

        $id = $_POST['id'];
        $stmt->execute();
        header('Location: list.php');
        break;

    case 'modify':
        $stmt = $conn->prepare('UPDATE board SET title=?, content=? WHERE id=?');
        $stmt->bind_param('ssi', $title, $content, $id);
        $title = $_POST['title'];
        $content = $_POST['content'];
        $id = $_POST['id'];
        $stmt->execute();
        header("Location: list.php?id={$_POST['id']}");
        break;
}
$resert = mysqli_query($conn, $sql);
?>
