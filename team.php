<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>设计团队 - COMMU STUDIO</title>
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
                        <a class="nav-link active" href="team.php">设计团队</a>
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

    <!-- 设计团队区域 -->
    <section class="team-section" style="padding: 100px 0;">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-12">
                    <h2>设计团队</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="team-member">
                        <img src="https://trae-api-cn.mchost.guru/api/ide/v1/text_to_image?prompt=professional%20female%20designer%20portrait%20minimalist&image_size=square" alt="设计师1" class="img-fluid rounded-circle mb-3" style="width: 200px; height: 200px; object-fit: cover;">
                        <h3>张设计师</h3>
                        <p>创意总监</p>
                        <p>拥有 10 年以上的设计经验，专注于商业空间设计。</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="team-member">
                        <img src="https://trae-api-cn.mchost.guru/api/ide/v1/text_to_image?prompt=professional%20male%20designer%20portrait%20minimalist&image_size=square" alt="设计师2" class="img-fluid rounded-circle mb-3" style="width: 200px; height: 200px; object-fit: cover;">
                        <h3>李设计师</h3>
                        <p>设计总监</p>
                        <p>专注于建筑设计和室内设计，作品曾多次获得国际大奖。</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="team-member">
                        <img src="https://trae-api-cn.mchost.guru/api/ide/v1/text_to_image?prompt=professional%20female%20designer%20portrait%20minimalist%20glasses&image_size=square" alt="设计师3" class="img-fluid rounded-circle mb-3" style="width: 200px; height: 200px; object-fit: cover;">
                        <h3>王设计师</h3>
                        <p>资深设计师</p>
                        <p>专注于软装设计和色彩搭配，拥有丰富的项目经验。</p>
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