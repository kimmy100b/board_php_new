<?php
# DB연결 소스코드

function db_connect()
{
    $db_user = 'i_test';
    $db_pass = 'i_test123#';
    $db_host = '61.85.36.115';
    $db_name = 'i_test';
    $db_type = 'mysql';
    $dsn = "$db_type:host=$db_host;dbname=$db_name;charset=utf8"; //dsn : Data Source Name

    // $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

    if (!$conn) {
        echo 'Error: Unable to connect to MySQL.' . PHP_EOL;
        echo 'Debugging errno: ' . mysqli_connect_errno() . PHP_EOL;
        echo 'Debugging error: ' . mysqli_connect_error() . PHP_EOL;
        exit();
    }

    // echo "데이터베이스에 접속하였습니다.";
    return $conn;
}
?>
