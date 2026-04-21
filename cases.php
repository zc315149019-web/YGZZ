<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>案例展示 - COMMU STUDIO</title>
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
                        <a class="nav-link active" href="cases.php">案例展示</a>
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

    <!-- 案例展示区域 -->
    <section class="cases-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2>Case Show</h2>
                        <span>案例展示</span>
                    </div>
                </div>
            </div>
            <div class="cases-grid">
                <?php
                require_once 'includes/config.php';
                $categories = ['commercial', 'home', 'art', 'architecture'];
                $categoryNames = [
                    'commercial' => 'COMMERCIAL SPACE',
                    'home' => 'HOME IMPROVEMENT',
                    'art' => 'ART SPACE',
                    'architecture' => 'ARCHITECTURAL DESIGN'
                ];
                $categoryTitles = [
                    'commercial' => '商业空间',
                    'home' => '家装空间',
                    'art' => '艺术',
                    'architecture' => '建筑设计'
                ];
                
                foreach ($categories as $category) {
                    $stmt = $pdo->prepare("SELECT image_path, title FROM gallery WHERE category = ? ORDER BY created_at DESC LIMIT 1");
                    $stmt->execute([$category]);
                    $image = $stmt->fetch();
                    
                    if ($image) {
                        echo '<div class="case-item">';
                        echo '<img data-src="images/' . $image['image_path'] . '" src="data:image/svg+xml,%3Csvg xmlns=\"http://www.w3.org/2000/svg\" width=\"400\" height=\"300\" viewBox=\"0 0 400 300\"%3E%3Crect width=\"400\" height=\"300\" fill=\"%23f0f0f0\"/%3E%3C/svg%3E" alt="' . $categoryNames[$category] . '" class="lazy">';
                        echo '<div class="case-overlay">';
                        echo '<h3>' . $categoryNames[$category] . '</h3>';
                        echo '<p>' . $categoryTitles[$category] . '</p>';
                        echo '</div>';
                        echo '</div>';
                    } else {
                        // 使用默认图片
                        $prompt = '';
                        switch ($category) {
                            case 'commercial':
                                $prompt = 'modern%20minimalist%20commercial%20space%20with%20white%20walls%20and%20natural%20light';
                                break;
                            case 'home':
                                $prompt = 'modern%20minimalist%20home%20interior%20design';
                                break;
                            case 'art':
                                $prompt = 'modern%20minimalist%20art%20gallery%20space';
                                break;
                            case 'architecture':
                                $prompt = 'modern%20minimalist%20architectural%20design%20interior';
                                break;
                        }
                        echo '<div class="case-item">';
                        echo '<img data-src="https://trae-api-cn.mchost.guru/api/ide/v1/text_to_image?prompt=' . $prompt . '&image_size=landscape_4_3" src="data:image/svg+xml,%3Csvg xmlns=\"http://www.w3.org/2000/svg\" width=\"400\" height=\"300\" viewBox=\"0 0 400 300\"%3E%3Crect width=\"400\" height=\"300\" fill=\"%23f0f0f0\"/%3E%3C/svg%3E" alt="' . $categoryNames[$category] . '" class="lazy">';
                        echo '<div class="case-overlay">';
                        echo '<h3>' . $categoryNames[$category] . '</h3>';
                        echo '<p>' . $categoryTitles[$category] . '</p>';
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