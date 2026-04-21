<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商业空间 - COMMU STUDIO</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- 导航栏 -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">首页</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="news.php">新闻资讯</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cases.php">案例展示</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="team.php">设计团队</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">关于我们</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">联系我们</a>
                    </li>
                </ul>
            </div>
            <div class="navbar-right">
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="搜索" aria-label="搜索">
                </form>
            </div>
        </div>
    </nav>

    <!-- 商业空间展示区域 -->
    <section class="commercial-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-12">
                    <h2>Commercial Space</h2>
                </div>
            </div>
            <div class="row">
                <?php
                require_once 'includes/config.php';
                $stmt = $pdo->prepare("SELECT image_path, title, description FROM gallery WHERE category = ? ORDER BY created_at DESC");
                $stmt->execute(['commercial']);
                $images = $stmt->fetchAll();
                
                if (count($images) > 0) {
                    foreach ($images as $image) {
                        echo '<div class="col-md-4 mb-4">';
                        echo '<div class="case-item">';
                        echo '<img data-src="images/' . $image['image_path'] . '" src="data:image/svg+xml,%3Csvg xmlns=\"http://www.w3.org/2000/svg\" width=\"400\" height=\"300\" viewBox=\"0 0 400 300\"%3E%3Crect width=\"400\" height=\"300\" fill=\"%23f0f0f0\"/%3E%3C/svg%3E" alt="' . $image['title'] . '" class="lazy">';
                        echo '<div class="case-overlay">';
                        echo '<h3>' . $image['title'] . '</h3>';
                        echo '<p>' . ($image['description'] ? $image['description'] : 'BUSINESS DESIGN') . '</p>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    // 使用默认图片
                    $defaultImages = [
                        ['title' => 'NEWAN', 'description' => 'ARCHITECTURAL DESIGN', 'prompt' => 'modern%20minimalist%20commercial%20space%20with%20geometric%20shapes'],
                        ['title' => 'IRO', 'description' => 'BUSINESS DESIGN', 'prompt' => 'modern%20minimalist%20commercial%20space%20with%20blue%20accent'],
                        ['title' => 'ONLY YOU', 'description' => 'BUSINESS DESIGN', 'prompt' => 'modern%20minimalist%20commercial%20space%20with%20white%20chair'],
                        ['title' => 'YANXI', 'description' => 'BUSINESS DESIGN', 'prompt' => 'modern%20minimalist%20commercial%20space%20with%20natural%20light'],
                        ['title' => 'ANKAYA', 'description' => 'BUSINESS DESIGN', 'prompt' => 'modern%20minimalist%20commercial%20space%20with%20geometric%20shadows']
                    ];
                    
                    foreach ($defaultImages as $image) {
                        echo '<div class="col-md-4 mb-4">';
                        echo '<div class="case-item">';
                        echo '<img data-src="https://trae-api-cn.mchost.guru/api/ide/v1/text_to_image?prompt=' . $image['prompt'] . '&image_size=landscape_4_3" src="data:image/svg+xml,%3Csvg xmlns=\"http://www.w3.org/2000/svg\" width=\"400\" height=\"300\" viewBox=\"0 0 400 300\"%3E%3Crect width=\"400\" height=\"300\" fill=\"%23f0f0f0\"/%3E%3C/svg%3E" alt="' . $image['title'] . '" class="lazy">';
                        echo '<div class="case-overlay">';
                        echo '<h3>' . $image['title'] . '</h3>';
                        echo '<p>' . $image['description'] . '</p>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                }
                ?>
            </div>
        </div>
    </section>

    <!-- 页脚 -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <p>&copy; 2026 COMMU STUDIO. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>