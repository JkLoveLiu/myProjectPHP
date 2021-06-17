<?php
session_start();
header('Access-Control-Allow-Origin: *');

$dbHost = $_SESSION['dbHost'];
$dbUser = $_SESSION['dbUser'];
$dbPwd = $_SESSION['dbPwd'];
$dbName = $_SESSION['dbName'];
$tbManage = $_SESSION['tbManage'];
$tbClient = $_SESSION['tbClient'];

// 查询客户数据
$conn = mysqli_connect($dbHost, $dbUser, $dbPwd, $dbName);
$sql = "select * from $dbName.$tbClient order by id";
$rst=mysqli_query($conn,$sql);
$res = array();
while($row = mysqli_fetch_assoc($rst)) {
    $res[]=$row;
}

$returnJson = json_encode($res);
echo $returnJson;

// 关闭数据库连接
mysqli_close($conn);