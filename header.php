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
        <a class="item" href="/forum/index.php">首页</a>
        <a class="item" href="/forum/create_topic.php">创建主题</a>
        <a class="item" href="/forum/create_cat.php">创建分类</a>

        <div id="userbar">
            <?php
            $error = false;

            if ($error == false) {
                echo '<div id="content">some text</div>';
            } else {
                // bad looking
            }
            ?>
            你好。不是你？退出
        </div>
    </div>
    <div id="content">


