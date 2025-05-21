<?php
// connect.php

// 配置数据库连接参数
$server = 'localhost:3306';
$username = 'root';
$password = '123.com';
$database = 'db_forum';
$conn = mysqli_connect($server, $username, $password, $database);

// 检查连接
if (!$conn) {
    exit('Error: 无法连接到 MySQL.');
}

// 选择数据库
if (!mysqli_select_db($conn, $database)) {
    exit('Error: 无法选择数据库.');
}

$_SESSION['conn'] = $conn;