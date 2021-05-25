<?php
// 日期报表
session_start();
header('Access-Control-Allow-Origin: *');

$dbHost = $_SESSION['dbHost'];
$dbUser = $_SESSION['dbUser'];
$dbPwd = $_SESSION['dbPwd'];
$dbName = $_SESSION['dbName'];
$tbManage = $_SESSION['tbManage'];
$tbClient = $_SESSION['tbClient'];



$conn = mysqli_connect($dbHost, $dbUser, $dbPwd, $dbName);

$type = $_GET['name'];
$iMax = 0;
$dataArray = array();

switch ($type) {
    case 'day':
        if (strlen($_GET['date']) === 0) {
            $dayStart = date('Y-m-d');
        } else {
            $dayStart = $_GET['date'];
        }
        // 查询今天新增的客户
        $sql = "select * from $dbName.$tbClient where date(datetime)='$dayStart'";
        $newInsert = mysqli_num_rows(mysqli_query($conn, $sql));
        // 查询今天完成的客户
        $sql = "select * from $dbName.$tbClient where complete='0' and date(endedittime)='$dayStart'";
        $newComplete = mysqli_num_rows(mysqli_query($conn, $sql));
        $dataArray = array('newInsert' => $newInsert, 'newComplete' => $newComplete);
        break;
    case 'month':
        // 月报表
        if (strlen($_GET['date']) === 0) {
            $days = strtotime(date('Y-m'));
            $ym = date('Y-m');
        } else {
            $days = strtotime($_GET['date']);
            $ym = $_GET['date'];
        }
        $iMax = date('t', $days);
        // 新增客户
        $newInsert = array();
        for ($i = 1; $i <= $iMax; $i++) {
            $dayStart = date($ym . '-' . $i);
            $sql = "select * from $dbName.$tbClient where date(datetime)='$dayStart'";
            $newInsert[] = mysqli_num_rows(mysqli_query($conn, $sql));
        }
        // 新增完成客户
        $newComplete = array();
        for ($i = 1; $i <= $iMax; $i++) {
            $dayStart = date($ym . '-' . $i);
            $sql = "select * from $dbName.$tbClient where date(endedittime)='$dayStart' and complete='0'";
            $newComplete[] = mysqli_num_rows(mysqli_query($conn, $sql));
        }
        $dataArray = array('newInsert' => $newInsert, 'newComplete' => $newComplete);
        break;
    case 'season':
        if (strlen($_GET['date']) === 0) {
            $date = date('Y');
        } else {
            $date = $_GET['date'];
        }
        // 新增客户
        $newInsert = array();
        // 第一季度
        $dayStart = $date . '-01-01 00:00:00';
        $endStart = $date . '-03-31 23:59:59';
        $sql = "select * from $dbName.$tbClient where datetime between '$dayStart' and '$endStart'";
        $newInsert[0] = mysqli_num_rows(mysqli_query($conn, $sql));
        // 第二季度
        $dayStart = $date . '-04-01 00:00:00';
        $endStart = $date . '-06-30 23:59:59';
        $sql = "select * from $dbName.$tbClient where datetime between '$dayStart' and '$endStart'";
        $newInsert[1] = mysqli_num_rows(mysqli_query($conn, $sql));
        // 第三季度
        $dayStart = $date . '-07-01 00:00:00';
        $endStart = $date . '-09-30 23:59:59';
        $sql = "select * from $dbName.$tbClient where datetime between '$dayStart' and '$endStart'";
        $newInsert[2] = mysqli_num_rows(mysqli_query($conn, $sql));
        // 第四季度
        $dayStart = $date . '-10-01 00:00:00';
        $endStart = $date . '-12-31 23:59:59';
        $sql = "select * from $dbName.$tbClient where datetime between '$dayStart' and '$endStart'";
        $newInsert[3] = mysqli_num_rows(mysqli_query($conn, $sql));
        // 新增完成客户
        $newComplete = array();
        // 第一季度
        $dayStart = $date . '-01-01 00:00:00';
        $endStart = $date . '-03-31 23:59:59';
        $sql = "select * from $dbName.$tbClient where complete='0' and endedittime between '$dayStart' and '$endStart'";
        $newComplete[0] = mysqli_num_rows(mysqli_query($conn, $sql));
        // 第二季度
        $dayStart = $date . '-04-01 00:00:00';
        $endStart = $date . '-06-30 23:59:59';
        $sql = "select * from $dbName.$tbClient where complete='0' and endedittime between '$dayStart' and '$endStart'";
        $newComplete[1] = mysqli_num_rows(mysqli_query($conn, $sql));
        // 第三季度
        $dayStart = $date . '-07-01 00:00:00';
        $endStart = $date . '-09-30 23:59:59';
        $sql = "select * from $dbName.$tbClient where complete='0' and endedittime between '$dayStart' and '$endStart'";
        $newComplete[2] = mysqli_num_rows(mysqli_query($conn, $sql));
        // 第四季度
        $dayStart = $date . '-10-01 00:00:00';
        $endStart = $date . '-12-31 23:59:59';
        $sql = "select * from $dbName.$tbClient where complete='0' and endedittime between '$dayStart' and '$endStart'";
        $newComplete[3] = mysqli_num_rows(mysqli_query($conn, $sql));
        $dataArray = array('newInsert' => $newInsert, 'newComplete' => $newComplete);
        break;
    case 'year':
        if (strlen($_GET['date']) === 0) {
            $date = date('Y');
        } else {
            $date = $_GET['date'];
        }
        // 新增客户
        $newInsert = array();
        for ($i = 0; $i < 12; $i++) {
            $m = '';
            if ($i < 9) {
                $m = '0' . ($i + 1);
            } else {
                $m = $i;
            }
            $dayStart = date($date . '-' . $m);
            $sql = "select * from $dbName.$tbClient where date_format(datetime,'%Y-%m')='$dayStart'";
            $newInsert[] = mysqli_num_rows(mysqli_query($conn, $sql));
        }
        // 新增完成客户
        $newComplete = array();
        for ($i = 0; $i < 12; $i++) {
            $m = '';
            if ($i < 9) {
                $m = '0' . ($i + 1);
            } else {
                $m = $i;
            }
            $dayStart = date($date . '-' . $m);
            $sql = "select * from $dbName.$tbClient where date_format(endedittime,'%Y-%m')='$dayStart' and complete='0'";
            $newComplete[] = mysqli_num_rows(mysqli_query($conn, $sql));
        }
        $dataArray = array('newInsert' => $newInsert, 'newComplete' => $newComplete);
        break;
}

mysqli_close($conn);
echo json_encode($dataArray);

