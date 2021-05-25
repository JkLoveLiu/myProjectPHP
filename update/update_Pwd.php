<?php
session_start();
header('Access-Control-Allow-Origin: *');

$dbHost = $_SESSION['dbHost'];
$dbUser = $_SESSION['dbUser'];
$dbPwd = $_SESSION['dbPwd'];
$dbName = $_SESSION['dbName'];
$tbManage = $_SESSION['tbManage'];
$tbClient = $_SESSION['tbClient'];

// 旧密码
$oldPwd = $_POST['oldPwd'];
// 新密码
$newPwd = $_POST['newPwd'];
// 传递的用户名
$username = $_SESSION['userName'];

// 连接数据库
$conn = mysqli_connect($dbHost, $dbUser, $dbPwd, $dbName);

// 判断原密码是否正确
$sql = "select * from $dbName.$tbManage where pwd='$oldPwd' and username='$username'";
if ($rst = mysqli_query($conn, $sql)) {
    if (mysqli_num_rows($rst) == 1) {
        $sql = "update $dbName.$tbManage set pwd='$newPwd' where username='$username'";
        // 判断修改是否成功
        if (mysqli_query($conn, $sql)) {
            // 修改成功
            unset($_SESSION['isLog']);
            unset($_SESSION['userName']);
            echo 7;
        }
    } else {
        // 原密码错误
        echo 8;
    }
}


// 关闭数据库连接
mysqli_close($conn);