<?php
//echo "HI I am in config";
ob_start(); //Turns on output buffering
//session_start();

date_default_timezone_set("Asia/Calcutta");

try {
    $con = new PDO("mysql:dbname=vedant2;host=localhost", "root", "Mysqlarp@006r");
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
}
catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>