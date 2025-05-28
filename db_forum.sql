CREATE TABLE users (
    user_id INT(8) NOT NULL AUTO_INCREMENT,
    user_name VARCHAR(30) NOT NULL,
    user_pass VARCHAR(255) NOT NULL,
    user_email VARCHAR(255) NOT NULL,
    user_date DATETIME NOT NULL,
    user_level INT(8) NOT NULL,
    UNIQUE INDEX user_name_unique(user_name),
    PRIMARY KEY(user_id)
) ENGINE = INNODB;
CREATE TABLE categories (
    cat_id INT(8) NOT NULL AUTO_INCREMENT,
    cat_name VARCHAR(255) NOT NULL,
    cat_description VARCHAR(255) NOT NULL,
    UNIQUE INDEX cat_name_unique (cat_name),
    PRIMARY KEY (cat_id)
) ENGINE = INNODB;
CREATE TABLE topics (
    topic_id INT(8) NOT NULL AUTO_INCREMENT,
    topic_subject VARCHAR(255) NOT NULL,
    topic_date DATETIME NOT NULL,
    topic_cat INT(8) NOT NULL,
    topic_by INT(8) NOT NULL,
    PRIMARY KEY (topic_id)
) ENGINE = INNODB;
CREATE TABLE posts (
    post_id INT(8) NOT NULL AUTO_INCREMENT,
    post_content TEXT NOT NULL,
    post_date DATETIME NOT NULL,
    post_topic INT(8) NOT NULL,
    post_by INT(8) NOT NULL,
    PRIMARY KEY (post_id)
) ENGINE = INNODB;
ALTER TABLE topics
ADD FOREIGN KEY(topic_cat) REFERENCES categories(cat_id) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE topics
ADD FOREIGN KEY(topic_by) REFERENCES users(user_id) ON DELETE RESTRICT ON UPDATE CASCADE;
ALTER TABLE posts
ADD FOREIGN KEY(post_topic) REFERENCES topics(topic_id) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE posts
ADD FOREIGN KEY(post_by) REFERENCES users(user_id) ON DELETE RESTRICT ON UPDATE CASCADE;

-- 清空表数据 --
-- 首先禁用外键检查
SET FOREIGN_KEY_CHECKS = 0;

-- 按从属关系顺序清空表数据
TRUNCATE TABLE posts;
TRUNCATE TABLE topics;
TRUNCATE TABLE categories;
TRUNCATE TABLE users;

-- 重新启用外键检查
SET FOREIGN_KEY_CHECKS = 1;

-- 示例数据 --
INSERT INTO users (user_name, user_pass, user_email, user_date, user_level) VALUES
                                                                                ('张三', '$2y$10$EixZaYVK1fsbw1ZfbX3OXePaWxn96p36WQoeG6Lruj3vjPGga31lW', 'zhangsan@example.com', NOW(), 1),
                                                                                ('李四', '$2y$10$EixZaYVK1fsbw1ZfbX3OXePaWxn96p36WQoeG6Lruj3vjPGga31lW', 'lisi@example.com', NOW(), 0),
                                                                                ('王五', '$2y$10$EixZaYVK1fsbw1ZfbX3OXePaWxn96p36WQoeG6Lruj3vjPGga31lW', 'wangwu@example.com', NOW(), 0),
                                                                                ('管理员', '$2y$10$EixZaYVK1fsbw1ZfbX3OXePaWxn96p36WQoeG6Lruj3vjPGga31lW', 'admin@example.com', NOW(), 2);
INSERT INTO categories (cat_name, cat_description) VALUES
                                                       ('技术讨论', '关于编程、开发和技术的讨论区'),
                                                       ('生活杂谈', '日常生活、兴趣爱好等话题'),
                                                       ('学习交流', '学习经验、课程讨论等内容'),
                                                       ('意见建议', '对论坛的建议和反馈');
INSERT INTO topics (topic_subject, topic_date, topic_cat, topic_by) VALUES
                                                                        ('如何学习MySQL数据库?', NOW(), 3, 1),
                                                                        ('Python最新特性讨论', NOW(), 1, 2),
                                                                        ('周末有什么好去处?', NOW(), 2, 3),
                                                                        ('论坛界面改进建议', NOW(), 4, 4);
INSERT INTO posts (post_content, post_date, post_topic, post_by) VALUES
                                                                     ('我觉得学习MySQL应该从基础SQL语句开始，循序渐进。', NOW(), 1, 1),
                                                                     ('同意楼上的观点，实践也很重要，要多做练习。', NOW(), 1, 2),
                                                                     ('Python 3.9的新特性中模式匹配非常实用!', NOW(), 2, 3),
                                                                     ('我推荐去郊外爬山，亲近大自然。', NOW(), 3, 4),
                                                                     ('建议增加夜间模式，保护眼睛。', NOW(), 4, 1),
                                                                     ('数据库优化有哪些技巧?', NOW(), 1, 3);