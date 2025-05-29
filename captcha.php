<?php
session_start();

// 声明图片尺寸
$image_width = 100;
$image_height = 40;

// 创建图片资源
$image = imagecreatetruecolor($image_width, $image_height);
// 生成背景颜色
$bg_color = imagecolorallocate($image, mt_rand(200, 255), mt_rand(200, 255), mt_rand(200, 255));
imagefill($image, 0, 0, $bg_color);

// 生成验证码字符串
$chars = 'ABCDEFGHJKLMNPQRSTUVWXYZabcdefghjkmnpqrstuvwxyz23456789';
$code = '';
for ($i = 0; $i < 4; $i++) {
    $code .= $chars[mt_rand(0, strlen($chars) - 1)];
}

// 将验证码字符串保存到session中，用于验证
$_SESSION['captcha'] = $code;

// 绘制验证码文字
$font_file = 'FiraCode-Regular.ttf';  // 替换为你自己的字体文件路径
$text_color = imagecolorallocate($image, 0, 0, 0);  // 文字颜色为黑色
imagettftext($image, 20, 0, 10, 30, $text_color, $font_file, $code);

// 输出图片
header('Content-Type: image/png');
imagepng($image);
imagedestroy($image);
?>