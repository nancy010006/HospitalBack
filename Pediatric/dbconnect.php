<?php
$host = 'localhost';
$user = 'u337031698_root';
$pass = 'a0955404259';
$db = 'u337031698_basic';
$table=['status' => 500,'message' =>'伺服器錯誤'];
$conn = mysqli_connect($host, $user, $pass, $db) or die(json_encode($table, JSON_UNESCAPED_UNICODE,JSON_FORCE_OBJECT)); //跟MyMSQL連線並登入
mysqli_query($conn,"SET NAMES utf8"); //選擇編碼
?>
