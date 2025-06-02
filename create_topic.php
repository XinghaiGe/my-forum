<?php
// create_topic.php
include 'header.php';
include 'connect.php';
global $conn;

echo '<h2>创建主题</h2>';

// 未登录
if (!$_SESSION['signed_in']) {
    echo '请<a href="/my-forum/sign_in.php">登录</a>后创建话题';
    include 'footer.php';
    exit;
}

// 未提交，展示表单
if ($_SERVER['REQUEST_METHOD'] != "POST") {
    $sql = "SELECT cat_id,cat_name,cat_description FROM categories";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        echo '错误：数据库查询失败';
    } else {
        if (mysqli_num_rows($result) == 0) {
            if ($_SESSION['user_level'] == 1) {
                echo '你还没有创建分类';
            } else {
                echo '在你创建主题前，你必须等待管理员创建一些类别';
            }
        } else {
            echo '<form method="post" action="">
主题名称：<input type="text" name="topic_subject"/>
所属类别：<select name="topic_cat">';
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<option value="' . $row['cat_id'] . '">' . $row['cat_name'] . '</option>';
            }
            echo '</select>';
            echo '主题信息：<textarea name="post_content"></textarea>
<input type="submit" value="添加主题">
</form>';
        }
    }
    include 'footer.php';
    exit;
}

// 已登录，提交表单
mysqli_begin_transaction($conn);
$query = "BEGIN WORK;";
$result = mysqli_query($conn, $query);
if (!$result) {
    echo '创建主题失败，请稍后重试';
    include 'footer.php';
    exit;
}

$topic_subject = mysqli_real_escape_string($conn, $_POST['topic_subject']);
$topic_cat = mysqli_real_escape_string($conn, $_POST['topic_cat']);
$topic_by = $_SESSION['user_id'];

$sql = "INSERT INTO topics(topic_subject,topic_date,topic_cat,topic_by)
VALUES('$topic_subject',NOW(),'$topic_cat','$topic_by')";

$result = mysqli_query($conn, $sql);

if (!$result) {
    echo '数据插入失败，请稍后重试。' . mysqli_error($conn);
    $sql = "ROLLBACK;";
    $result = mysqli_query($conn, $sql);
} else {
    $topicid = mysqli_insert_id($conn);
    $post_content = mysqli_real_escape_string($conn, $_POST['post_content']);
    $post_topic = $topicid;
    $post_by = $_SESSION['user_id'];

    $sql = "INSERT INTO posts(post_content, post_date, post_topic, post_by) 
VALUES ('$post_content', NOW(), '$post_topic', '$post_by' )";

    $result = mysqli_query($conn, $sql);

    if (!$result) {
        echo '帖子失败，请稍后重试' . mysqli_error($conn);
        $sql = "ROLLBACK;";
        $result = mysqli_query($conn, $sql);
    } else {
        $sql = "COMMIT;";
        $result = mysqli_query($conn, $sql);
        //after a lot of work, the query succeeded!
        echo '创建 <a href="topic.php?id=' . $topicid . '">新主题</a>.成功';
    }
}


include 'footer.php';
