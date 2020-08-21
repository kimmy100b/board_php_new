<?php
header('Content-Type: text/html; charset=utf-8');
// DB연동
include_once "../DB.php";
$DB = new DB();
?>
<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/2a001071af.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/index.css">
    <title>Document</title>
</head>

<body>
    <nav>
        <ul>
            <li><a href="#">About</a></li>
            <li><a href="list.php">게시판</a></li>
            <?php if(isset($_SESSION['memberId'])){ ?>
            <li><a href="#">마이페이지</a></li>
                <!-- TODO : 관리자만 사용할 수 있는 권한으로 바꾸기 -->
                <?php if($user == $admin){ ?>
                <li class="nav-item">
                    <a class="nav-link" href="#"">회원관리</a>
                </li>
                <?php
                }
            }?>
        </ul>
        <div class="login">
            <?php 
            if(isset($_SESSION['userId'])){ ?>
            <p class="login__msg"><?php echo $_SESSION['userId'];?>님 안녕하세요  </p> <button class="btn btn-outline-secondary logout__btn" onclick="location.href='login/logout.php'">로그아웃</button>

            <?php
            }else{
                ?>
            <a href="login/login_form.php">로그인</a>
            <a href="signup/signup_form.php">회원가입</a>
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