<?php
#관리자만 볼 수 있는 회원 목록
    header('Content-Type: text/html; charset=utf-8');
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
                <th scope="col">name</th>
                <th scope="col">tel</th>
                <th scope="col">email</th>
                <th scope="col">reg_date</th>
                <th scope="col">level</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sql = "SELECT id, name, tel, email, reg_date, level FROM member ORDER BY reg_date desc";
                    $result = mysqli_query($conn, $sql);
                    $mem_cnt = mysqli_num_rows($result);
                    $no = $mem_cnt;

                    if($mem_cnt<1){ ?>
                        <td colspan="7">
                            <p class="no-member">회원가입한 멤버가 없습니다.</p>
                        </td>
                    <?php
                    } else{
                         while($member = mysqli_fetch_assoc($result)){?>
                             <tr>
                                <th><?php echo $no;?></th>
                                <td><?php echo $member['id'];?></td>
                                <td><?php echo $member['name'];?></td>
                                <td><?php echo $member['tel'];?></td>
                                <td><?php echo $member['email'];?></td>
                                <td><?php echo $member['reg_date'];?></td>
                                <td>
                                    <?php if($member['level']==0){
                                        echo "관리자";
                                    }else if($member['level']==1){
                                        echo "일반회원";
                                    }?>
                                </td>
                            </tr>
                        <?php
                            $no--;
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>