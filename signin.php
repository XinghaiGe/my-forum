<?php
//signin.php
include 'connect.php';
include 'header.php';
// 检查用户是否已登录，已登录则不显示表单
if (isset($_SESSION['signed_in']) && $_SESSION['signed_in']) {
    echo '您已登录，您可以<a href="signout.php>退出登录</a>';
} else {
    if ($_SERVER['REQUEST_METHOD'] != 'POST') {
        echo '<form method="POST" action="signin.php">
账号：<input type="text" name="user_name">
密码：<input type="password" name="user_pass">
<input type="submit" value="登录"/>
</form>';
    } else {

        $errors = array();

        // 数据合法性检查
        if (!isset($_POST['user_name'])) {
            $errors[] = '用户名不能为空';
        }

        if (!isset($_POST['user_pass'])) {
            $errors[] = '密码不能为空';
        }

        if (!empty($errors)) {
            echo '填写不正确';
            echo '<ul>';

            foreach ($errors as $key => $value) {
                echo '<li>' . $value . '</li>';
            }
            echo '</ul>';
        } else {

            $sql = "SELECT user_id, user_name, user_pass, user_level FROM users WHERE user_name = ? AND user_pass = ?";

            $stmt = mysqli_prepare($_SESSION['conn'], $sql);

            $user_name = $_POST['user_name'];
            $user_pass = sha1($_POST['user_pass']);
            mysqli_stmt_bind_param($stmt, "ss", $user_name, $user_pass);

            $result = mysqli_stmt_execute($stmt);

            if (!$result) {
                echo '登录失败，请重试';
            } else {
                $result = mysqli_stmt_get_result($stmt);

                // 用户名或密码错误
                if (mysqli_num_rows($result) == 0) {
                    echo '用户名或密码错误，请重试';

                } // 登录成功
                else {
                    $_SESSION['signed_in'] = true;

                    while ($row = mysqli_fetch_assoc($result)) {
                        $_SESSION['user_id'] = $row['user_id'];
                        $_SESSION['user_name'] = $row['user_name'];
                        $_SESSION['user_level'] = $row['user_level'];
                    }

                    echo '欢迎，' . $_SESSION['user_name'] . '。<a href="index.php">查看论坛概览</a>';
                }
            }
        }
    }
}
include 'footer.php';