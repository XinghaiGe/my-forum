<?php
// reply.php
include 'header.php';
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] != "POST") {
    echo '该文件不可直接访问';
} else {
    $sql = "INSERT INTO posts(post_content, post_date, post_topic, post_by) VALUES (?, NOW(), ?, ?)";
    $stmt = mysqli_prepare($_SESSION['conn'], $sql);
    echo $_POST['post-content'];
    mysqli_stmt_bind_param($stmt, "sss", $_POST['post-content'], $_GET['id'], $_SESSION['user_id']);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_errno($stmt)) {
        echo '回复失败，请稍后重试' . mysqli_error($_SESSION['conn']);
    } else {
        echo '回复成功，点击<a href="topic.php?topic_id=' . htmlentities($_GET['id']) . '"> 链接</a>查看。';
    }
}

include 'footer.php';