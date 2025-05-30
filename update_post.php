<?php
// update_post.php
include 'header.php';
include 'connect.php';
global $conn;

$post_id = $_GET['post_id'];
if ($_SERVER['REQUEST_METHOD'] != "POST") {

    $sql = "SELECT * FROM posts LEFT JOIN users ON posts.post_by = users.user_id WHERE post_id='$post_id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    echo '用户名' .$row['user_name'];
    echo '发布时间' .$row['post_date'];

    echo '<form method="post" action="">
帖子内容：<textarea name="post_content" placeholder=' .$row['post_content']. '></textarea>
<input type="submit" value="更新帖子">
</form>';
}else{
    $post_content = $_POST['post_content'];
    $sql = "UPDATE posts SET post_content=? WHERE post_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('si', $post_content, $post_id);
    $result = $stmt->execute();

    if(!$result){
        echo '更新失败，请稍后重试';
    }else{
        $sql = "SELECT * FROM posts LEFT JOIN users ON posts.post_by = users.user_id WHERE post_id='$post_id'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        echo '更新成功， <a href=topic.php?topic_id=' .$row['post_topic']. '>点击查看</a>';
    }

}
//// 更新回帖到数据库
//$sql = "INSERT INTO posts(post_content, post_date, post_topic, post_by) VALUES (?, NOW(), ?, ?)";
//$stmt = mysqli_prepare($conn, $sql);
//mysqli_stmt_bind_param($stmt, "sss", $_POST['post-content'], $_GET['id'], $_SESSION['user_id']);
//mysqli_stmt_execute($stmt);
//
//if (mysqli_stmt_errno($stmt)) {
//    echo '回复失败，请稍后重试' . mysqli_error($conn);
//} else {
//    echo '回复成功，点击<a href="topic.php?topic_id=' . htmlentities($_GET['id']) . '"> 链接</a>查看。';
//}

include 'footer.php';