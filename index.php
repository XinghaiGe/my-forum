<?php
//index.php
include 'header.php';
include 'connect.php';
global $conn;

$sql = "SELECT 
cat_id, 
cat_name, 
cat_description 
FROM 
categories";

$result = mysqli_query($conn, $sql);

// 查询失败
if (!$result) {
    echo '无法显示类别，请重试';
    include 'footer.php';
    exit;
}

// 查询为空
if (mysqli_num_rows($result) == 0) {
    echo '没有分类数据';
    include 'footer.php';
    exit;
}

// 查询成功，展示分类列表
while ($row = mysqli_fetch_assoc($result)) {
    echo '<tr>';
    echo '<td class="leftpart">';
    echo '<h3><a href="category.php?cat_id=' . $row['cat_id'] . '">' . $row['cat_name'] . '</a></h3>' . $row['cat_description'];
    echo '</td>';
    echo '<td class="rightpart">';
    echo '<a href="topic.php?topic_id="Topic subject</a> at 10-10';
    echo '</td>';
    echo '</tr>';
}

include 'footer.php';