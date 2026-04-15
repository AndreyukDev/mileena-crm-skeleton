-- 1. users
CREATE TABLE admin_users (
                             id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                             username VARCHAR(255) NOT NULL,
                             fio VARCHAR(255) NOT NULL DEFAULT '',
                             password VARCHAR(255) NOT NULL,
                             status ENUM('active', 'blocked') NOT NULL DEFAULT 'active',
                             role ENUM('administrator', 'member') NOT NULL DEFAULT 'member',
                             created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                             updated_at DATETIME DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
                             latest_at DATETIME DEFAULT NULL,
                             deleted_at DATETIME DEFAULT NULL,

                             INDEX idx_username (username),
                             INDEX idx_status (status),
                             INDEX idx_deleted_at (deleted_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;