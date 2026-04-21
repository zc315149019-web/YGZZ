<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>后台管理 - COMMU STUDIO</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }
        .sidebar {
            height: 100vh;
            background-color: #f8f9fa;
            border-right: 1px solid #e9ecef;
            padding-top: 20px;
        }
        .sidebar h3 {
            text-align: center;
            margin-bottom: 30px;
            font-weight: 300;
        }
        .sidebar ul {
            list-style: none;
            padding: 0;
        }
        .sidebar li {
            margin-bottom: 10px;
        }
        .sidebar a {
            display: block;
            padding: 10px 20px;
            color: #000;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .sidebar a:hover {
            background-color: #e9ecef;
            padding-left: 25px;
        }
        .content {
            padding: 20px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid #e9ecef;
        }
        .header h2 {
            font-weight: 300;
        }
        .logout-btn {
            background-color: #dc3545;
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
        }
        .logout-btn:hover {
            background-color: #c82333;
        }
        .card {
            margin-bottom: 20px;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #e9ecef;
            padding: 15px;
            font-weight: 500;
        }
        .card-body {
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- 侧边栏 -->
            <div class="col-md-3 sidebar">
                <h3>COMMU STUDIO</h3>
                <ul>
                    <li><a href="index.php">首页</a></li>
                    <li><a href="content.php">内容管理</a></li>
                    <li><a href="gallery.php">图片管理</a></li>
                    <li><a href="users.php">用户管理</a></li>
                </ul>
            </div>
            
            <!-- 内容区域 -->
            <div class="col-md-9 content">
                <div class="header">
                    <h2>后台管理</h2>
                    <form method="post" style="display: inline;">
                        <button type="submit" class="logout-btn" name="logout">退出登录</button>
                    </form>
                </div>
                
                <div class="card">
                    <div class="card-header">
                        欢迎使用后台管理系统
                    </div>
                    <div class="card-body">
                        <p>这里是 COMMU STUDIO 的后台管理系统，您可以在这里管理网站的内容和图片。</p>
                        <p>默认登录信息：</p>
                        <ul>
                            <li>用户名: admin</li>
                            <li>密码: admin123</li>
                        </ul>
                        <p>请根据需要修改默认密码，以确保系统安全。</p>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-header">
                        系统信息
                    </div>
                    <div class="card-body">
                        <p><strong>PHP 版本：</strong><?php echo phpversion(); ?></p>
                        <p><strong>MySQL 版本：</strong><?php echo mysqli_get_client_version(); ?></p>
                        <p><strong>服务器时间：</strong><?php echo date('Y-m-d H:i:s'); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit;
    }
    
    if (isset($_POST['logout'])) {
        session_destroy();
        header('Location: login.php');
        exit;
    }
    ?>
</body>
</html>