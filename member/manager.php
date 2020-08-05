<?php
    require_once '../DB.php';
    $conn = db_connect();   

    session_start();
    $user=$_SESSION['memberId'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>회원정보보기</title>
</head>
<body>
    <div class="nav">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" href="../list.php">게시물</a>
            </li>
            <?php
                if($user == "admin"){ ?>
                    <li class="nav-item">
                        <a class="nav-link active" href="manager.php">회원관리</a>
                    </li>
                <?php
                }
            ?>
            <li class="nav-item">
                <a class="nav-link" href="mem_modify.php">정보수정</a>
            </li>
        </ul>
    </div>
    <div class="members">
        <table class="table">
            <thead class="thead-light">
                <tr>
                <th scope="col">no</th>
                <th scope="col">id</th>
                <th scope="col">tel</th>
                <th scope="col">email</th>
                <th scope="col">reg_date</th>
                <th scope="col">level</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
                </tr>
                <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
                </tr>
                <tr>
                <th scope="row">3</th>
                <td>Larry</td>
                <td>the Bird</td>
                <td>@twitter</td>
                </tr>
            </tbody>
        </table>

    </div>
</body>
</html>