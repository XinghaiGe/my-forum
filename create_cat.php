<?php
// create_cat.php
include 'header.php';
include 'connect.php';
global $conn;

if ($_SERVER['REQUEST_METHOD'] != "POST") {
    echo '<form method="post" action="">
类别名称：<input type="text" name="cat_name"/>
类别描述：<textarea name="cat_description"></textarea>
<input type="submit" value="添加类别">
</form>';
} else {
    $cat_name = htmlspecialchars($_POST['cat_name'], ENT_QUOTES, 'UTF-8');
    $cat_description = htmlspecialchars($_POST['cat_description'], ENT_QUOTES, 'UTF-8');

    $sql = "INSERT INTO categories (cat_name, cat_description) VALUES (?,?)";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $cat_name, $cat_description);

    $result = mysqli_stmt_execute($stmt);

    if (!$result) {
        echo 'Error: ' . mysqli_error($conn);
    } else {
        echo '添加类别成功';
    }

}

include 'footer.php';
