<?php
// sign_up.php
include 'header.php';
include 'connect.php';
global $conn;

echo '<h3>注册</h3>';

// 未提交表单，显示登录表单
if ($_SERVER['REQUEST_METHOD'] != "POST") {
    echo '<form method="POST" action="sign_up.php">
账号：<input type="text" name="user_name"/>
密码：<input type="password" name="user_pass"/>
再次输入密码：<input type="password" name="user_pass_check"/>
电子邮箱：<input type="email" name="user_email"/>
<input type="submit" value="注册"/>
</form>';
    include 'footer.php';
    exit;
}

// 数据合法性检查
$errors = array();
if (isset($_POST['user_name'])) {
    if (!ctype_alnum($_POST['user_name'])) {
        $errors[] = '用户名只能包含字母和数字';
    }
    if (strlen($_POST['user_pass']) > 30) {
        $errors[] = '用户名不能超过30个字符';
    }
} else {
    $errors[] = '用户名不能为空';
}

if (isset($_POST['user_pass'])) {
    if ($_POST['user_pass'] != $_POST['user_pass_check']) {
        $errors[] = '两次输入的密码不一致';
    }
} else {
    $errors[] = '密码不能为空';
}

// 展示不合法信息
if (!empty($errors)) {
    echo '填写不正确';
    echo '<ul>';

    foreach ($errors as $key => $value) {
        echo '<li>' . $value . '</li>';
    }
    echo '</ul>';
    include 'footer.php';
    exit;
}

// 保存注册账号到数据库
$sql = "INSERT INTO users(user_name, user_pass, user_email, user_date, user_level) VALUES (?,?,?,NOW(),0)";

$stmt = mysqli_prepare($conn, $sql);

$user_name = $_POST['user_name'];
$user_pass = sha1($_POST['user_pass']);
$user_email = $_POST['user_email'];
mysqli_stmt_bind_param($stmt, "sss", $user_name, $user_pass, $user_email);

$result = mysqli_stmt_execute($stmt);

if (!$result) {
    echo '注册失败，请重试';
} else {
    echo '注册成功。你现在可以<a href="sign_in.php">登录</a>>发帖了！';
}


include 'footer.php';