<?php
# DB연결 소스코드
$db_user = 'root';
$db_pass = 'mysql';
$db_host = 'localhost';
$db_name = 'php';
$db_type = 'mysql';

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

mysqli_query($conn, "set session character_set_connection=utf8;");
mysqli_query($conn, "set session character_set_results=utf8;");
mysqli_query($conn, "set session character_set_client=utf8;");

if (!$conn) {
    echo 'Error: DB연결에 실패했습니다.' . PHP_EOL;
    echo 'Debugging errno: ' . mysqli_connect_errno() . PHP_EOL;
    exit();
}
