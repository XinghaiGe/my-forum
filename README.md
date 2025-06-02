# 论坛 [forum-from-scratch](https://code.tutsplus.com/how-to-create-a-phpmysql-powered-forum-from-scratch--net-10188t)

### 环境
+ PHP 8.4.7
+ MySQL 8.0

### 文件目录结构

| 文件名                  | 文件功能    |
|----------------------|---------|
| index.php            | 首页      |
| captcha.php          | 生成验证码   |
| db_forum.sql         | 数据库脚本   |
| connect.php          | 数据库连接配置 |
| FiraCode-Regular.ttf | 验证码字体文件 |
| category.php         | 展示分类    |
| create_cat.php       | 创建分类    |
| create_topic.php     | 创建主题    |
| header.php           | 全局页眉    |
| footer.php           | 全局页脚    |
| reply.php            | 回帖功能    |
| signin.php           | 登录功能    |
| signout.php          | 登出功能    |
| signup.php           | 注册功能    |
| topic.php            | 展示主题    |
| test.php             | 环境测试    |
| style.css            | 样式文件    |
| README.md            | 说明文件    |

### 作用

了解从前后端不分离到前后端分离的历史演变

体会php在小型项目快速交付的优势


### 任务

+ [x] 将数据库连接移出会话存储：虽然 PhpStorm 报错，实际可以直接使用 $conn 变量量。为防止报错，将其声明为全局变量
+ [x] 使用提前返回的方法，解决多重嵌套
+ [x] 使用占位符占位+参数绑定的方法，防范 SQL 注入（SET VALUES WHERE 语句）
+ [x] [加入图片验证码](https://www.php.cn/faq/607932.html)
+ [ ] 上传图片
+ [x] 帖子更新，根据以往的经验，可以复用帖子添加的大部分代码
+ [x] 帖子删除
+ [x] 阻止用户在发文章或评论时输入带 HTML 或 JavaScript 的内容，使用htmlspecialchars过滤

## 问题
+ 如何从明文密码存储迁移到加密
+ 如何从加密密码存储迁移到加密加盐存储密码

### 部署
+ 云数据库 sqlpub