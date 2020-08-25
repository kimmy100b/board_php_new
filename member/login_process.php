<?php
    # 로그인 기능 구현
    header('Content-Type: text/html; charset=utf-8');
    // DB연동
    include_once "../DBconnect.php";
    $DBconnect = new DBconnect();
    session_start();

    //사용자 아이디
    $userId = $_POST["userId"];
    //사용자 비밀번호
    $userPasswd = $_POST["userPw"];
    //sha256으로 암호화한 비밀번호
    $pw_hash = hash("sha256",$userPasswd);

    $sql = "SELECT userId, userPasswd, userName FROM user WHERE userId='".$userId."'";
    $result = mysqli_query($conn, $sql);
    
    //아이디가 있다면 비밀번호 검사
    if(mysqli_num_rows($result)==1){
        $row = mysqli_fetch_assoc($result);

        if($row['userPasswd']==$pw_hash){
            $_SESSION["userId"]= $userId;
            if(isset($_SESSION['userId'])){
            ?>
             <script>
                alert("로그인되었습니다.");
                location.href="../board/list.php"
            </script>
            <?php } else{
                echo "세션 저장실패";
            }
        }
        else{ ?>
            <script>
                alert("아이디 혹은 비밀번호가 일치하지 않습니다.");
                history.back();
            </script>
        <?php
        }
    }  
?>