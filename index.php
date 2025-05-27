<?php
//index.php
include 'connect.php';
include 'header.php';
echo '<p>';
echo 'index.php';
echo '</p>';

echo '<tr>';
echo '<td class="leftpart">';
echo '<h3><a href="category.php?id=">类别名</a></h3>类别描述';
echo '</td>';
echo '<td class="rightpart">';
echo '<a href="topic.php?id=">主题</a> at 10-10';
echo '</td>';
echo '</tr>';
include 'footer.php';