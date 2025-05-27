<?php
// create_cat.php
include 'header.php';
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] != "POST") {
    echo '<form method="post" action="">
    类别名称：<input type="text" name="cat_name"/>
    类别描述：<textarea name="cat_description"></textarea>
    <input type="submit" value="添加类别">
</form>';
} else {
    $cat_name = $_POST['cat_name'];
    $cat_description = $_POST['cat_description'];

    $sql = "INSERT INTO categories (cat_name, cat_description) VALUES (?,?)";

    $stmt = mysqli_prepare($_SESSION['conn'], $sql);
    mysqli_stmt_bind_param($stmt, "ss", $cat_name, $cat_description);

    $result = mysqli_stmt_execute($stmt);

    if (!$result) {
        echo 'Error: ' . mysqli_error($_SESSION['conn']);
    } else {
        echo '添加类别成功';
    }

}

include 'footer.php';
