<?php
session_start();
header('Access-Control-Allow-Origin: *');

$dbHost = $_SESSION['dbHost'];
$dbUser = $_SESSION['dbUser'];
$dbPwd = $_SESSION['dbPwd'];
$dbName = $_SESSION['dbName'];
$tbManage = $_SESSION['tbManage'];
$tbClient = $_SESSION['tbClient'];

// 客户报表
$conn = mysqli_connect($dbHost, $dbUser, $dbPwd, $dbName);

$type = $_GET['name'];
$dataArray = array();
$iMax = 0;
switch ($type) {
    case 'type':
    case 'complete':
        $iMax = 2;
        break;
    case 'statue':
        $iMax = 6;
        break;
    case 'address':
    case 'industry':
        $iMax = 8;
        break;
}

for ($i = 0; $i < $iMax; $i++) {
    $sql = "select * from $dbName.$tbClient where $type='$i'";
    $dataArray[] = mysqli_num_rows(mysqli_query($conn, $sql));
}

echo json_encode($dataArray);
