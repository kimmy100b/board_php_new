<?php
# DB 연결 
require_once 'DB.php';
$conn = db_connect();

session_start();

$user=$_SESSION['memberId']; 
$admin = "admin";
?>