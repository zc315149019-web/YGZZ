<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>内容管理 - COMMU STUDIO</title>
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
        .form-group {
            margin-bottom: 20px;
        }
        .btn-primary {
            background-color: #000;
            border-color: #000;
        }
        .btn-primary:hover {
            background-color: #333;
            border-color: #333;
        }
        .success-message {
            color: green;
            margin-top: 10px;
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
                    <h2>内容管理</h2>
                    <form method="post" style="display: inline;">
                        <button type="submit" class="logout-btn" name="logout">退出登录</button>
                    </form>
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
                
                require_once '../includes/config.php';
                
                // 处理表单提交
                if (isset($_POST['save_content'])) {
                    $page = $_POST['page'];
                    $section = $_POST['section'];
                    $content = $_POST['content'];
                    
                    // 检查是否已存在该内容
                    $stmt = $pdo->prepare("SELECT id FROM content WHERE page = ? AND section = ?");
                    $stmt->execute([$page, $section]);
                    $existing = $stmt->fetch();
                    
                    if ($existing) {
                        // 更新现有内容
                        $stmt = $pdo->prepare("UPDATE content SET content = ? WHERE id = ?");
                        $stmt->execute([$content, $existing['id']]);
                    } else {
                        // 插入新内容
                        $stmt = $pdo->prepare("INSERT INTO content (page, section, content) VALUES (?, ?, ?)");
                        $stmt->execute([$page, $section, $content]);
                    }
                    
                    $success = true;
                }
                
                // 获取现有内容
                function getContent($pdo, $page, $section) {
                    $stmt = $pdo->prepare("SELECT content FROM content WHERE page = ? AND section = ?");
                    $stmt->execute([$page, $section]);
                    $result = $stmt->fetch();
                    return $result ? $result['content'] : '';
                }
                ?>
                
                <?php if (isset($success) && $success): ?>
                    <div class="alert alert-success" role="alert">
                        内容保存成功！
                    </div>
                <?php endif; ?>
                
                <div class="card">
                    <div class="card-header">
                        编辑内容
                    </div>
                    <div class="card-body">
                        <form method="post">
                            <div class="form-group">
                                <label for="page">页面</label>
                                <select class="form-control" id="page" name="page" required>
                                    <option value="home">首页</option>
                                    <option value="about">关于我们</option>
                                    <option value="contact">联系我们</option>
                                    <option value="news">新闻资讯</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="section"> section</label>
                                <input type="text" class="form-control" id="section" name="section" placeholder="例如：hero_title" required>
                            </div>
                            <div class="form-group">
                                <label for="content">内容</label>
                                <textarea class="form-control" id="content" name="content" rows="10" required><?php echo getContent($pdo, $_POST['page'] ?? 'home', $_POST['section'] ?? ''); ?></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary" name="save_content">保存内容</button>
                        </form>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-header">
                        现有内容
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>页面</th>
                                    <th>Section</th>
                                    <th>内容</th>
                                    <th>更新时间</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $stmt = $pdo->query("SELECT * FROM content ORDER BY updated_at DESC");
                                while ($row = $stmt->fetch()) {
                                    echo '<tr>';
                                    echo '<td>' . $row['page'] . '</td>';
                                    echo '<td>' . $row['section'] . '</td>';
                                    echo '<td>' . substr($row['content'], 0, 100) . '...</td>';
                                    echo '<td>' . $row['updated_at'] . '</td>';
                                    echo '</tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>