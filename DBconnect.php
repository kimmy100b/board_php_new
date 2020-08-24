<?php
# DB연결 소스코드
class DBconnect
{
    var $conn;
    var $user = 'i_test';
    var $passwd = 'i_test123#';
    var $host = '61.85.36.115';
    var $name = 'i_test';
    var $type = 'mysql';

    //기본 생성자를 이용해서 DB를 불러와준다
    function DBconnect(){
        $this->loadDB();
    }

    function loadDB()
    {
        $db_user = 'i_test';
        $db_pass = 'i_test123#';
        $db_host = '61.85.36.115';
        $db_name = 'i_test';
        $db_type = 'mysql';
        $dsn = "$db_type:host=$db_host;dbname=$db_name;charset=utf8"; //dsn : Data Source Name
    
        // $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
        global $conn;
        $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
        mysqli_query($conn, "set session character_set_connection=utf8;");
        mysqli_query($conn, "set session character_set_results=utf8;");
        mysqli_query($conn, "set session character_set_client=utf8;");

        if (!$conn) {
            echo 'Error: Unable to connect to MySQL.' . PHP_EOL;
            echo 'Debugging errno: ' . mysqli_connect_errno() . PHP_EOL;
            echo 'Debugging error: ' . mysqli_connect_error() . PHP_EOL;
            exit();
        }
    
        // echo "데이터베이스에 접속하였습니다.";
        return $conn;
    }
}

?>
