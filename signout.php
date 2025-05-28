<?php
include 'header.php';
include 'connect.php';
echo '<h2>退出登录</h2>';

if($_SESSION['signed_in'])
{
    //unset all variables
    $_SESSION['signed_in'] = NULL;
    $_SESSION['user_name'] = NULL;
    $_SESSION['user_id']   = NULL;

    echo '退出登录成功';
}
else
{
    echo '当前未登录，<a href="signin.php">登录o</a>?';
}

include 'footer.php';