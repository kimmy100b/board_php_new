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
        $stmt = $dbh->prepare('DELETE FROM topic WHERE id = :id');
        $stmt->bindParam(':id', $id);

        $id = $_POST['id'];
        $stmt->execute();
        header('Location: list.php');
        break;

    case 'modify':
        $stmt = $dbh->prepare(
            'UPDATE topic SET title = :title, description = :description WHERE id = :id'
        );
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':id', $id);

        $title = $_POST['title'];
        $description = $_POST['description'];
        $id = $_POST['id'];
        $stmt->execute();
        header("Location: list.php?id={$_POST['id']}");
        break;
}
$resert = mysqli_query($conn, $sql);
?>
