<?php
include 'header.php';
include 'connect.php';

global $conn;

$post_id = $_GET['post_id'];

$sql = "SELECT post_topic FROM posts WHERE post_id='$post_id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$post_topic = $row['post_topic'];

$sql = "DELETE FROM posts WHERE post_id = ?";
$stmt = mysqli_prepare($conn, $sql);
$stmt->bind_param('i', $post_id);
$result = $stmt->execute();

if(!$result) {
    echo '删除失败';
}else{
    echo '删除成功，<a href=topic.php?topic_id=' .$post_topic. '>点击查看</a>';
}

include 'footer.php';