<?php
    header('Content-Type: text/html; charset=utf-8');
    require_once '../DB.php';
    $conn = db_connect();
    $memid = $_GET['memid'];
    $sql = "select id from member where id = '".$memid."'";
    $stmt = mysqli_query($conn, $sql);
    $member = mysqli_fetch_array($stmt);
    
    if($member==0){
        
?>
<div><?php echo $memid;?>는 사용가능한 아이디입니다.</div>

<?php
    } else{
?>

<div><?php echo $memid;?>는 중복된 아이디입니다.</div>
<?php
    }
?>
<button value="닫기" onclick="window.close()">닫기</button>