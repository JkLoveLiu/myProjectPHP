<?php
session_start();
header('Access-Control-Allow-Origin: *');
// 权限不足
if ($_SESSION['power'] != 0){
    die('9');
}
$dbHost = $_SESSION['dbHost'];
$dbUser = $_SESSION['dbUser'];
$dbPwd = $_SESSION['dbPwd'];
$dbName = $_SESSION['dbName'];
$tbManage = $_SESSION['tbManage'];
$tbClient = $_SESSION['tbClient'];

$id = $_POST['id'];
$username = $_POST['username'];
$name = $_POST['name'];
$power = $_POST['power'];
$statue = $_POST['statue'];
if ($_POST['username'] !== $_SESSION['userName']) {
    $conn = mysqli_connect($dbHost, $dbUser, $dbPwd, $dbName);
    $sql = "update $dbName.$tbManage set username='$username',name='$name',power='$power',statue='$statue' where id='$id'";
    if (mysqli_query($conn, $sql)) {
        // 修改成功
        echo 2;
    }
} else {
    // 操作当前登录的账号
    echo 1;
}
