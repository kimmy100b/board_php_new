<?php
# DB연결 소스코드
class DB
{
    var $conn;
    var $user = 'i_test';
    var $passwd = 'i_test123#';
    var $host = '61.85.36.115';
    var $name = 'i_test';
    var $type = 'mysql';

    //기본 생성자를 이용해서 DB를 불러와준다
    function DB(){
        $this->loadDB();
    }

    function loadDB()
    {
        $conn = mysqli_connect($host, $user, $passwd, $name);
    
        if (!$conn) {
            echo 'Error: Unable to connect to MySQL.' . PHP_EOL;
            echo 'Debugging errno: ' . mysqli_connect_errno() . PHP_EOL;
            echo 'Debugging error: ' . mysqli_connect_error() . PHP_EOL;
            exit();
        }
    }
}

?>
