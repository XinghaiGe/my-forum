<?php
include  'header.php';
include 'connect.php';
$sql = 'SELECT cat_id,cat_name,cat_description FROM categories WHERE cat_id = ' . mysqli_real_escape_string($_SESSION['conn'], $_GET['cat_id']);

$result = mysqli_query($_SESSION['conn'], $sql);

if(!$result) {
    echo '无法显示分类，请重试' . mysqli_error($_SESSION['conn']);
}else{
    if(mysqli_num_rows($result) == 0) {
        echo '分类不存在';
    }else{
        while($row=mysqli_fetch_assoc($result)) {
            echo '<h2>主题所属分类：' . $row['cat_name'] . '</h2>';
        }
        $sql = "SELECT topic_id,topic_subject,topic_date,topic_cat FROM topics WHERE topic_cat = " . mysqli_real_escape_string($_SESSION['conn'], $_GET['cat_id']);
        $result = mysqli_query($_SESSION['conn'], $sql);
        if(!$result) {
            echo '无法显示主题，请重试' . mysqli_error($_SESSION['conn']);
        }else{
            echo '<table border="1"><tr><th>主题</th><th>创建时间</th></tr>';
            while($row=mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td class="leftpart">';
                echo '<h3><a href="topic.php?id=' . $row['topic_id'] . '">'. $row['topic_subject'] . '</a></h3>' ;
                echo '</td>';
                echo '<td class="rightpart">';
                echo date('d-m-Y', strtotime($row['topic_date']));
                echo '</td>';
                echo '</tr>';
            }
        }
    }
}

include 'footer.php';