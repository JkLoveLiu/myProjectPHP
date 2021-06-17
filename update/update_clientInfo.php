<?php
session_start();
header('Access-Control-Allow-Origin: *');
// 权限不足
if ($_SESSION['power'] === 2){
    die('9');
}
$dbHost = $_SESSION['dbHost'];
$dbUser = $_SESSION['dbUser'];
$dbPwd = $_SESSION['dbPwd'];
$dbName = $_SESSION['dbName'];
$tbManage = $_SESSION['tbManage'];
$tbClient = $_SESSION['tbClient'];

$conn = mysqli_connect($dbHost, $dbUser, $dbPwd, $dbName);

$id = $_POST['id'];
$name = $_POST['name'];
$formType = $_POST['formType'];
$statue = $_POST['statue'];
$manager = $_POST['manager'];
$require = $_POST['require'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$callName = $_POST['callName'];
$complete = $_POST['complete'];
$industry = $_POST['industry'];
$date = date('Y-m-d H:i:s');

if ($callName === 'null'){
    $callName = '';
}

$sql = "update $dbName.$tbClient set name='$name',type='$formType',statue='$statue',manager='$manager',
                                    `require`='$require', phone='$phone',endedittime='$date',complete='$complete',
                                    address='$address',`call`='$callName',industry='$industry' where id='$id'";
$res = mysqli_query($conn, $sql);
if ($res) {
    // 修改成功
    echo 2;
}



