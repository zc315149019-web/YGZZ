<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COMMU STUDIO</title>
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

    <!-- 横幅区域 -->
    <section class="hero-section">
        <div class="hero-content">
            <?php
            require_once 'includes/config.php';
            $stmt = $pdo->prepare("SELECT content FROM content WHERE page = ? AND section = ?");
            $stmt->execute(['home', 'hero_title']);
            $heroTitle = $stmt->fetch();
            echo '<h1>' . ($heroTitle ? $heroTitle['content'] : 'COMMU STUDIO') . '</h1>';
            ?>
        </div>
    </section>

    <!-- 商业空间展示 -->
    <section class="commercial-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Commercial Space</h2>
                    <div class="commercial-image">
                        <?php
                        $stmt = $pdo->prepare("SELECT image_path FROM gallery WHERE category = ? ORDER BY created_at DESC LIMIT 1");
                        $stmt->execute(['commercial']);
                        $image = $stmt->fetch();
                        if ($image) {
                            echo '<img data-src="images/' . $image['image_path'] . '" src="data:image/svg+xml,%3Csvg xmlns=\"http://www.w3.org/2000/svg\" width=\"800\" height=\"450\" viewBox=\"0 0 800 450\"%3E%3Crect width=\"800\" height=\"450\" fill=\"%23f0f0f0\"/%3E%3C/svg%3E" alt="Commercial Space" class="lazy">';
                        } else {
                            echo '<img data-src="https://trae-api-cn.mchost.guru/api/ide/v1/text_to_image?prompt=modern%20minimalist%20commercial%20space%20interior%20design%20with%20white%20walls%20and%20natural%20light&image_size=landscape_16_9" src="data:image/svg+xml,%3Csvg xmlns=\"http://www.w3.org/2000/svg\" width=\"800\" height=\"450\" viewBox=\"0 0 800 450\"%3E%3Crect width=\"800\" height=\"450\" fill=\"%23f0f0f0\"/%3E%3C/svg%3E" alt="Commercial Space" class="lazy">';
                        }
                        ?>
                    </div>
                    <div class="commercial-info">
                        <span>COMMERCIAL SPACE</span>
                        <a href="commercial.php" class="arrow-link">→</a>
                    </div>
                </div>
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