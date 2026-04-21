<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>图片管理 - COMMU STUDIO</title>
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
        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        .btn-danger:hover {
            background-color: #c82333;
            border-color: #c82333;
        }
        .success-message {
            color: green;
            margin-top: 10px;
        }
        .error-message {
            color: red;
            margin-top: 10px;
        }
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        .gallery-item {
            border: 1px solid #e9ecef;
            border-radius: 8px;
            overflow: hidden;
        }
        .gallery-item img {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }
        .gallery-item .info {
            padding: 10px;
        }
        .gallery-item h4 {
            font-size: 14px;
            margin: 0 0 5px 0;
        }
        .gallery-item p {
            font-size: 12px;
            color: #666;
            margin: 0;
        }
        .gallery-item .actions {
            padding: 10px;
            border-top: 1px solid #e9ecef;
            display: flex;
            gap: 10px;
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
                    <h2>图片管理</h2>
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
                
                // 确保上传目录存在
                $uploadDir = '../images/';
                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                
                // 处理图片上传
                if (isset($_POST['upload_image'])) {
                    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
                        $fileExtension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
                        
                        if (in_array($fileExtension, $allowedTypes)) {
                            $fileName = uniqid() . '.' . $fileExtension;
                            $filePath = $uploadDir . $fileName;
                            
                            if (move_uploaded_file($_FILES['image']['tmp_name'], $filePath)) {
                                $category = $_POST['category'];
                                $title = $_POST['title'];
                                $description = $_POST['description'];
                                
                                $stmt = $pdo->prepare("INSERT INTO gallery (category, image_path, title, description) VALUES (?, ?, ?, ?)");
                                $stmt->execute([$category, $fileName, $title, $description]);
                                
                                $success = true;
                            } else {
                                $error = '图片上传失败';
                            }
                        } else {
                            $error = '只允许上传 JPG、JPEG、PNG 和 GIF 格式的图片';
                        }
                    } else {
                        $error = '请选择要上传的图片';
                    }
                }
                
                // 处理图片删除
                if (isset($_GET['delete'])) {
                    $id = $_GET['delete'];
                    
                    // 获取图片路径
                    $stmt = $pdo->prepare("SELECT image_path FROM gallery WHERE id = ?");
                    $stmt->execute([$id]);
                    $image = $stmt->fetch();
                    
                    if ($image) {
                        $imagePath = $uploadDir . $image['image_path'];
                        if (file_exists($imagePath)) {
                            unlink($imagePath);
                        }
                        
                        // 从数据库中删除
                        $stmt = $pdo->prepare("DELETE FROM gallery WHERE id = ?");
                        $stmt->execute([$id]);
                        
                        $success = true;
                    }
                }
                ?>
                
                <?php if (isset($success) && $success): ?>
                    <div class="alert alert-success" role="alert">
                        操作成功！
                    </div>
                <?php endif; ?>
                
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>
                
                <div class="card">
                    <div class="card-header">
                        上传图片
                    </div>
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="category">分类</label>
                                <select class="form-control" id="category" name="category" required>
                                    <option value="commercial">商业空间</option>
                                    <option value="home">家装空间</option>
                                    <option value="art">艺术</option>
                                    <option value="architecture">建筑设计</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="image">图片</label>
                                <input type="file" class="form-control" id="image" name="image" required>
                            </div>
                            <div class="form-group">
                                <label for="title">标题</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>
                            <div class="form-group">
                                <label for="description">描述</label>
                                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary" name="upload_image">上传图片</button>
                        </form>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-header">
                        图片列表
                    </div>
                    <div class="card-body">
                        <div class="gallery-grid">
                            <?php
                            $stmt = $pdo->query("SELECT * FROM gallery ORDER BY created_at DESC");
                            while ($row = $stmt->fetch()) {
                                echo '<div class="gallery-item">';
                                echo '<img src="../images/' . $row['image_path'] . '" alt="' . $row['title'] . '">';
                                echo '<div class="info">';
                                echo '<h4>' . $row['title'] . '</h4>';
                                echo '<p>' . $row['category'] . '</p>';
                                echo '</div>';
                                echo '<div class="actions">';
                                echo '<a href="gallery.php?delete=' . $row['id'] . '" class="btn btn-danger btn-sm" onclick="return confirm(\'确定要删除这张图片吗？\')">删除</a>';
                                echo '</div>';
                                echo '</div>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>