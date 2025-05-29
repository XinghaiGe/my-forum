<?php
include 'header.php';
include 'connect.php';
$sql = 'SELECT topic_id,topic_subject FROM topics WHERE topics.topic_id = ' . mysqli_real_escape_string($_SESSION['conn'], $_GET['topic_id']);

$result = mysqli_query($_SESSION['conn'], $sql);

// 主题查询失败
if (!$result) {
    echo '无法显示主题，请重试' . mysqli_error($_SESSION['conn']);
    include 'footer.php';
    exit;
}

// 主题为空
if (mysqli_num_rows($result) == 0) {
    echo '主题不存在';
    include 'footer.php';
    exit;
}

// 显示帖子所属主题
while ($row = mysqli_fetch_assoc($result)) {
    echo '<h2>帖子所属主题：' . $row['topic_subject'] . '</h2>';
}

$posts_sql = "SELECT 
    posts.post_topic,posts.post_content,posts.post_date,posts.post_by,users.user_id,users.user_name
FROM posts 
LEFT JOIN users ON posts.post_by = users.user_id 
WHERE posts.post_topic=" . mysqli_real_escape_string($_SESSION['conn'], $_GET['topic_id']);

$posts_result = mysqli_query($_SESSION['conn'], $posts_sql);
if (!$posts_result) {
    echo '无法显示主题下的帖子，请重试' . mysqli_error($_SESSION['conn']);
} else {
    echo '<table>
<tr>
<th>用户名/发表时间</th>
<th>帖子内容</th>
</tr>';
    while ($posts_row = mysqli_fetch_assoc($posts_result)) {
        echo '<tr>';
        echo '<td class="leftpart">';
        echo $posts_row['user_name'] . $posts_row['post_date'];
        echo '</td>';
        echo '<td class="rightpart">';
        echo $posts_row['post_content'];
        echo '</td>';
        echo '</tr>';
    }
}

// 确保是登录状态才可以回帖
if (!$_SESSION['signed_in']) {
    echo '<tr><td colspan=2><a href="signin.php">登录</a>以回复. 你也可以<a href="signup.php">注册</a>新账号.';
} else {
    echo '<tr><td colspan="2"><h2>回复：</h2><br />
					<form method="post" action="reply.php?id=' . mysqli_fetch_assoc(mysqli_query($_SESSION['conn'], $sql))['topic_id'] . '">
						<textarea name="post-content"></textarea>
						<input type="submit" value="回复" />
					</form></td></tr>';
}
echo '</table>';


include 'footer.php';