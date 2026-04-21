<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>关于我们 - COMMU STUDIO</title>
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
                        <a class="nav-link active" href="about.php">关于我们</a>
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

    <!-- 关于我们区域 -->
    <section class="about-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2>About Us</h2>
                        <span>关于我们</span>
                    </div>
                </div>
            </div>
            <div class="about-content">
                <div class="about-image">
                    <?php
                    require_once 'includes/config.php';
                    $stmt = $pdo->prepare("SELECT image_path FROM gallery WHERE category = ? ORDER BY created_at DESC LIMIT 1");
                    $stmt->execute(['art']);
                    $image = $stmt->fetch();
                    if ($image) {
                        echo '<img data-src="images/' . $image['image_path'] . '" src="data:image/svg+xml,%3Csvg xmlns=\"http://www.w3.org/2000/svg\" width=\"800\" height=\"450\" viewBox=\"0 0 800 450\"%3E%3Crect width=\"800\" height=\"450\" fill=\"%23f0f0f0\"/%3E%3C/svg%3E" alt="About Us" class="lazy">';
                    } else {
                        echo '<img data-src="https://trae-api-cn.mchost.guru/api/ide/v1/text_to_image?prompt=modern%20minimalist%20design%20studio%20interior&image_size=landscape_16_9" src="data:image/svg+xml,%3Csvg xmlns=\"http://www.w3.org/2000/svg\" width=\"800\" height=\"450\" viewBox=\"0 0 800 450\"%3E%3Crect width=\"800\" height=\"450\" fill=\"%23f0f0f0\"/%3E%3C/svg%3E" alt="About Us" class="lazy">';
                    }
                    ?>
                </div>
                <div class="about-text">
                    <h3>COMMU STUDIO</h3>
                    <?php
                    $stmt = $pdo->prepare("SELECT content FROM content WHERE page = ? AND section = ?");
                    $stmt->execute(['about', 'content']);
                    $aboutContent = $stmt->fetch();
                    if ($aboutContent) {
                        echo '<p>' . $aboutContent['content'] . '</p>';
                    } else {
                        echo '<p>As a Design Agency Full Of Vitality And Creativity, Qiamu Is Composed Of A Group Of Young, Professional And Elite Designers. We Are Not Blindly Following Trends, Nor Are We Obsessed With Self-Expression. Instead, We Are Project-Oriented, Based On The Essence Of Design, And At The Same Time Leading The New Aesthetic Trend With Our Unique Design Language. We Pursue Exquisite Design Quality, Breathe With Creativity, Deeply Combine Art And Life, And Help The Site To Become A Model In The Field.</p>';
                        echo '<p>Qiamu Focuses On Commercial Space Design, Challenges Design Conventions Through Space Function Interpretation And Material Research, And Creates Unique Commercial Brand Spaces For High-End Customers.</p>';
                        echo '<p>We Create Each Work From The Real Dimensions Of Vision And Experience, And Give Space Extraordinary Value With Deep Insight And Unique Expression. Our Expertise Covers Architectural Space, Interior Design, Soft Decoration Design And Material Research. Our Service Scope Covers Large-Scale Public Decoration, Boutique Retail, Hotel Space And High-End Private Residences, Providing A Full Range Of Services From Concept Design To High-End Solutions.</p>';
                    }
                    ?>
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