<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>联系我们 - COMMU STUDIO</title>
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
                        <a class="nav-link active" href="contact.php">联系我们</a>
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

    <!-- 联系我们区域 -->
    <section class="contact-section" style="padding: 100px 0;">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-12">
                    <h2>联系我们</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <form>
                        <div class="mb-3">
                            <label for="name" class="form-label">姓名</label>
                            <input type="text" class="form-control" id="name" placeholder="请输入您的姓名">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">邮箱</label>
                            <input type="email" class="form-control" id="email" placeholder="请输入您的邮箱">
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">留言</label>
                            <textarea class="form-control" id="message" rows="5" placeholder="请输入您的留言"></textarea>
                        </div>
                        <button type="submit" class="btn btn-dark">提交</button>
                    </form>
                </div>
                <div class="col-md-6">
                    <div class="contact-info">
                        <h3>联系方式</h3>
                        <p><strong>地址：</strong>北京市朝阳区设计大厦 1001 室</p>
                        <p><strong>电话：</strong>010-12345678</p>
                        <p><strong>邮箱：</strong>info@commustudio.com</p>
                        <p><strong>营业时间：</strong>周一至周五 9:00-18:00</p>
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