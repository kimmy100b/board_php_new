<?php
# 해당 게시판 내용 보기

require_once 'DB.php';
$conn = db_connect();
$id = $_GET['id'];
$sql = "SELECT title, content, reg_date FROM board WHERE id=$id";
//$board = $conn->query($sql);
$result = mysqli_query($conn, $sql);
$board = mysqli_fetch_array($result);

//$board = mysqli_fetch_row($stmt);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <article>
    <?php if (!empty($board)) { ?>
    <h2><?= $board['title'] ?>
    </h2>
    <div class="content">
        <?= $board['content'] ?>
    </div>
    <div>
        <a href="modify.php?id=<?= $board['id'] ?>">수정</a>
        <form method="POST" action="process.php?mode=delete">
            <input type="hidden" name="id" value="<?= $board['id'] ?>" />
            <input type="submit" value="삭제" />
        </form>
    </div>
    <?php } ?>
    </article>
</body>
</html>