<?php
session_start();
header('Access-Control-Allow-Origin: *');
// 查询用户数据

$dbHost = $_SESSION['dbHost'];
$dbUser = $_SESSION['dbUser'];
$dbPwd = $_SESSION['dbPwd'];
$dbName = $_SESSION['dbName'];
$tbManage = $_SESSION['tbManage'];
$tbClient = $_SESSION['tbClient'];


$conn = mysqli_connect($dbHost, $dbUser, $dbPwd, $dbName);
$sql = "select * from $dbName.$tbManage";
$rst=mysqli_query($conn,$sql);
$res = array();
while($row = mysqli_fetch_assoc($rst)) {
    $res[]=$row;
}

$returnJson = json_encode($res);
echo $returnJson;

// 关闭数据库连接
mysqli_close($conn);


