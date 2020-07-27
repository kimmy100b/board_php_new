<?php
# 해당 게시판 내용 보기

require_once 'DB.php';
$conn = db_connect();
$result = $conn->query('SELECT * FROM board WHERE id=$id');
$id = $_GET['id'];

//$stmt->execute();
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
    <?php if (empty($result)) {
        echo '이상해';
    } ?>
    <?php if (!empty($result)) { ?>
    <h2><?= htmlspecialchars($result['title']) ?></h2>
    <div class="content">
        <?= htmlspecialchars($result['content']) ?>
    </div>
    <div>
        <a href="modify.php?id=<?= $result['id'] ?>">수정</a>
        <form method="POST" action="process.php?mode=delete">
            <input type="hidden" name="id" value="<?= $result['id'] ?>" />
            <input type="submit" value="삭제" />
        </form>
    </div>
    <?php } ?>
    </article>
</body>
</html>