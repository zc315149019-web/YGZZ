<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>用户管理 - COMMU STUDIO</title>
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
                    <h2>用户管理</h2>
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
                
                // 处理添加用户
                if (isset($_POST['add_user'])) {
                    $username = $_POST['username'];
                    $password = $_POST['password'];
                    
                    // 检查用户名是否已存在
                    $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
                    $stmt->execute([$username]);
                    if ($stmt->fetch()) {
                        $error = '用户名已存在';
                    } else {
                        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                        $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
                        $stmt->execute([$username, $hashedPassword]);
                        $success = true;
                    }
                }
                
                // 处理删除用户
                if (isset($_GET['delete'])) {
                    $id = $_GET['delete'];
                    
                    // 不能删除当前登录的用户
                    if ($id == $_SESSION['user_id']) {
                        $error = '不能删除当前登录的用户';
                    } else {
                        $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
                        $stmt->execute([$id]);
                        $success = true;
                    }
                }
                
                // 处理修改密码
                if (isset($_POST['change_password'])) {
                    $user_id = $_POST['user_id'];
                    $new_password = $_POST['new_password'];
                    
                    $hashedPassword = password_hash($new_password, PASSWORD_DEFAULT);
                    $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
                    $stmt->execute([$hashedPassword, $user_id]);
                    $success = true;
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
                        添加用户
                    </div>
                    <div class="card-body">
                        <form method="post">
                            <div class="form-group">
                                <label for="username">用户名</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="form-group">
                                <label for="password">密码</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary" name="add_user">添加用户</button>
                        </form>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-header">
                        用户列表
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>用户名</th>
                                    <th>创建时间</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $stmt = $pdo->query("SELECT * FROM users ORDER BY created_at DESC");
                                while ($row = $stmt->fetch()) {
                                    echo '<tr>';
                                    echo '<td>' . $row['id'] . '</td>';
                                    echo '<td>' . $row['username'] . '</td>';
                                    echo '<td>' . $row['created_at'] . '</td>';
                                    echo '<td>';
                                    echo '<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#changePasswordModal" data-user-id="' . $row['id'] . '" data-username="' . $row['username'] . '">修改密码</button>';
                                    if ($row['id'] != $_SESSION['user_id']) {
                                        echo '<a href="users.php?delete=' . $row['id'] . '" class="btn btn-danger btn-sm ml-2" onclick="return confirm(\'确定要删除这个用户吗？\')">删除</a>';
                                    }
                                    echo '</td>';
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
    
    <!-- 修改密码模态框 -->
    <div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changePasswordModalLabel">修改密码</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post">
                        <input type="hidden" id="user_id" name="user_id">
                        <div class="form-group">
                            <label for="username_display">用户名</label>
                            <input type="text" class="form-control" id="username_display" disabled>
                        </div>
                        <div class="form-group">
                            <label for="new_password">新密码</label>
                            <input type="password" class="form-control" id="new_password" name="new_password" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="change_password">修改密码</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // 处理修改密码模态框
        $('#changePasswordModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var userId = button.data('user-id');
            var username = button.data('username');
            
            var modal = $(this);
            modal.find('#user_id').val(userId);
            modal.find('#username_display').val(username);
        });
    </script>
</body>
</html>