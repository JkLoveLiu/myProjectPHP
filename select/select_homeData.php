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

$dayStart = date('Y-m-d');
$conn = mysqli_connect($dbHost, $dbUser, $dbPwd, $dbName);
$dataArray = array();
$sql = "select * from $dbName.$tbClient";
$dataArray['allClient'] = mysqli_num_rows(mysqli_query($conn, $sql));
$sql = "select * from $dbName.$tbClient where date(datetime)='$dayStart'";
$dataArray['newInsert'] = mysqli_num_rows(mysqli_query($conn, $sql));
$sql = "select * from $dbName.$tbClient where date(endedittime)='$dayStart' and complete='0'";
$dataArray['newComplete'] = mysqli_num_rows(mysqli_query($conn, $sql));


echo json_encode($dataArray);