<?php
// reply.php
include 'header.php';
include 'connect.php';
global $conn;

// 拒绝直接访问
if ($_SERVER['REQUEST_METHOD'] != "POST") {
    echo '该文件不可直接访问';
    include 'footer.php';
    exit;
}

// 插入回帖到数据库
$sql = "INSERT INTO posts(post_content, post_date, post_topic, post_by) VALUES (?, NOW(), ?, ?)";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "sss", $_POST['post-content'], $_GET['id'], $_SESSION['user_id']);
mysqli_stmt_execute($stmt);

if (mysqli_stmt_errno($stmt)) {
    echo '回复失败，请稍后重试' . mysqli_error($conn);
} else {
    echo '回复成功，点击<a href="topic.php?topic_id=' . htmlentities($_GET['id']) . '"> 链接</a>查看。';
}

include 'footer.php';