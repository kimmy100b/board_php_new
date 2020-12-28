<?php
if (isset($_SESSION['user_id'])) {
    $user = $_SESSION['user_id'];
    $sql = "SELECT admin FROM user WHERE user_id = '" . $user . "'";
    $stmh = mysqli_query($conn, $sql);
    $result = mysqli_fetch_array($stmh);
}
