<?php
header('Content-Type: text/html; charset=utf-8');
// DB연동
include_once "../DBconnect.php";
$DB = new DBconnect();
session_start();
//사용자
$user = $_SESSION['user_id'];

$sql = "SELECT level FROM user WHERE user_id = $user";
$stmh = mysqli_query($conn, $sql);
$result = mysqli_fetch_array($stmh);
echo $sql;
echo $result['level'];
?>
<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/2a001071af.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/index.css">
</head>

<body>
    <nav>
        <ul>
            <li><a href="#">About</a></li>
            <li><a href="../board/list.php">게시판</a></li>
            <?php if(isset($user)){ ?>
            <li><a href="../member/mypage.php">마이페이지</a></li>
                <!-- TODO : 관리자만 사용할 수 있는 권한으로 바꾸기 -->
                <?php if($result['level'] == 1){ ?>
                <li class="nav-item">
                    <a class="nav-link" href="#"">회원관리</a>
                </li>
                <?php
                }
            }?>
        </ul>
        <div class="login">
            <?php 
            if(isset($_SESSION['user_id'])){ ?>
            <p class="login__msg"><?php echo $_SESSION['user_id'];?>님 안녕하세요  </p> 
            <a href="../member/logout.php">로그아웃</a>

            <?php
            }else{
                ?>
            <a href="../member/login.php">로그인</a>
            <a href="../member/join.php">회원가입</a>
            <?php
            }
            ?>
        </div>
        <div class="button">
            <a class="btn-open" href="#"></a>
        </div>
    </nav>
        <div class="overlay">
            <div class="wrap">
                <ul class="wrap-nav">
                    <li><a href="#">About</a>
                    <ul>
                        <li><a href="#">About Company</a></li>
                        <li><a href="#">Designers</a></li>
                        <li><a href="#">Developers</a></li>
                        <li><a href="#">Pets</a></li>
                    </ul>
                    </li>
                    <li><a href="#">Services</a>
                    <ul>
                        <li><a href="https://www.google.hr/">Web Design</a></li>
                        <li><a href="#">Development</a></li>
                        <li><a href="#">Apps</a></li>
                        <li><a href="#">Graphic design</a></li>
                        <li><a href="#">Branding</a></li>
                    </ul>
                    </li>
                    <li><a href="#">Work</a>
                    <ul>
                        <li><a href="#">Web</a></li>
                        <li><a href="#">Graphic</a></li>
                        <li><a href="#">Apps</a></li>
                    </ul>
                    </li>
                </ul>
                <div class="social">
                    <a href="http://mario-loncarek.from.hr/">
                    <div class="social-icon">
                        <i class="fa fa-facebook"></i>
                    </div>
                    </a>
                    <a href="#">
                    <div class="social-icon">
                        <i class="fa fa-twitter"></i>
                    </div>
                    </a>
                    <a href="#">
                    <div class="social-icon">
                        <i class="fa fa-codepen"></i>
                    </div>
                    </a>
                    <a href="#">
                    <div class="social-icon">
                        <i class="fa fa-behance"></i>
                    </div>
                    </a>
                    <a href="#">
                    <div class="social-icon">
                        <i class="fa fa-dribbble"></i>
                    </div>
                    </a>
                    <p>
                        From: Zagreb, Croatia<br>
                         Site: <a href="http://mario-loncarek.from.hr/">mario-loncarek.from.hr</a>
                    </p>
                </div>
            </div>
        </div>
</body>
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="../js/index.js"></script>
</html>