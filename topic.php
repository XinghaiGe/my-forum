<?php
include  'header.php';
include 'connect.php';
$sql = 'SELECT topic_id,topic_subject FROM topics WHERE topics.topic_id = ' . mysqli_real_escape_string($_SESSION['conn'], $_GET['topic_id']);

$result = mysqli_query($_SESSION['conn'], $sql);

if(!$result) {
    echo '无法显示主题，请重试' . mysqli_error($_SESSION['conn']);
}else{
    if(mysqli_num_rows($result) == 0) {
        echo '主题不存在';
    }else{
        while($row=mysqli_fetch_assoc($result)) {
            echo '<h2>帖子所属主题：' . $row['topic_subject'] . '</h2>';
        }
        $sql = "SELECT 
    posts.post_topic,posts.post_content,posts.post_date,posts.post_by,users.user_id,users.user_name
FROM posts 
LEFT JOIN users ON posts.post_by = users.user_id 
WHERE posts.post_topic=" .mysqli_real_escape_string($_SESSION['conn'], $_GET['topic_id']);


        $result = mysqli_query($_SESSION['conn'], $sql);
        if(!$result) {
            echo '无法显示主题下的帖子，请重试' . mysqli_error($_SESSION['conn']);
        }else{
            $topic = mysqli_fetch_assoc($result)['post_topic'];
            echo '<table border="1">
<tr>
<th>用户名/发表时间</th>
<th>帖子内容</th>
</tr>';
            while($row=mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td class="leftpart">';
                echo $row['user_id'] . $row['post_date'];
                echo '</td>';
                echo '<td class="rightpart">';
                echo $row['post_content'];
                echo '</td>';
                echo '</tr>';
            }
        }
    }
}

include 'footer.php';