<?php
session_start();
header('Access-Control-Allow-Origin: *');

echo $_SESSION['name'];