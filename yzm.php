<?php

session_start();
header("Content-type:image/png");
$wid = 100;
$hei = 25;

// 创建画布
$img = imagecreatetruecolor($wid, $hei);
$white = imagecolorallocate($img, 255, 255, 255);
imagefill($img, 0, 0, $white);

// 随机生成彩色的点
for ($i = 0; $i < 100; $i++) {
    $x = rand(0, $wid);
    $y = rand(0, $hei);
    $randColor = imagecolorallocate($img, rand(0, 255), rand(0, 255), rand(0, 255));
    imagesetpixel($img, $x, $y, $randColor);
}
// 随机生成两个线段
for ($i = 0; $i < 2; $i++) {
    $x1 = rand(0, $wid);
    $y1 = rand(0, $hei);
    $x2 = rand(0, $wid);
    $y2 = rand(0, $hei);
    $randColor = imagecolorallocate($img, rand(0, 255), rand(0, 255), rand(0, 255));
    imageline($img, $x1, $y1, $x2, $y2, $randColor);
}
// 创建字体
$fontfile = realpath("SIMLI.TTF");
// 验证码保存文件
$yzmStr = "";
// 输出文字
$randStr = array_merge(range(0, 9));
for ($i = 0; $i < 4; $i++) {
    $fontColor = imagecolorallocate($img, rand(0, 255), rand(0, 255), rand(0, 255));
    $idx = rand(0,count($randStr)-1);
    imagettftext($img, 20, rand(-45, 45), ($i * 20 + 10), 20, $fontColor, $fontfile, $randStr[$idx]);
    $yzmStr .= $randStr[$idx];
}
$_SESSION['yzmStr'] = $yzmStr;


imagepng($img);
imagedestroy($img);
// 创建  画图  输出内容  上传前台  销毁