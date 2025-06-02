<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3c//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-CN" lang="zh-CN">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="description" content="A short description."/>
    <title>基于 PHP-MySQL 的论坛</title>
    <link rel="stylesheet" href="style.css" type="text/css">
</head>

<body>
<h1>我的论坛</h1>
<div id="wrapper">
    <div id="menu">
        <a class="item" href="/my-forum/index.php">首页</a>
        <a class="item" href="/my-forum/create_topic.php">创建主题</a>
        <a class="item" href="/my-forum/create_cat.php">创建分类</a>


        <div id="userbar">
            <?php
            if ($_SESSION['signed_in']) {
                echo '你好 ' . $_SESSION['user_name'] . '。如果不是你，请<a href="sign_out.php">退出登录<a>';
            } else {
                echo '<a href="sign_in.php">登录</a>或<a href="sign_up.php">注册</a>';
            }
            ?>
        </div>
    </div>
    <div id="content">


