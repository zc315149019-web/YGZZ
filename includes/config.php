<?php
// 数据库配置
$host = 'localhost';
$dbname = 'commu_studio';
$username = 'root';
$password = '';

// 尝试连接数据库
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("数据库连接失败: " . $e->getMessage());
}

// 检查数据库表是否存在，不存在则创建
function createTables($pdo) {
    // 创建内容表
    $contentTable = "
    CREATE TABLE IF NOT EXISTS content (
        id INT AUTO_INCREMENT PRIMARY KEY,
        page VARCHAR(50) NOT NULL,
        section VARCHAR(50) NOT NULL,
        content TEXT NOT NULL,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
    ";
    
    // 创建图片表
    $galleryTable = "
    CREATE TABLE IF NOT EXISTS gallery (
        id INT AUTO_INCREMENT PRIMARY KEY,
        category VARCHAR(50) NOT NULL,
        image_path VARCHAR(255) NOT NULL,
        title VARCHAR(100) NOT NULL,
        description VARCHAR(255),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
    ";
    
    // 创建用户表
    $userTable = "
    CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
    ";
    
    try {
        $pdo->exec($contentTable);
        $pdo->exec($galleryTable);
        $pdo->exec($userTable);
        
        // 检查是否有默认管理员用户
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM users");
        $stmt->execute();
        $count = $stmt->fetchColumn();
        
        if ($count == 0) {
            // 创建默认管理员用户，密码为 admin123
            $hashedPassword = password_hash('admin123', PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $stmt->execute(['admin', $hashedPassword]);
        }
    } catch(PDOException $e) {
        die("创建表失败: " . $e->getMessage());
    }
}

// 调用函数创建表
createTables($pdo);
?>