<?php
session_start();
require_once 'C:/xampp/htdocs/Fujifilm_Shop/admin/config/connect.php';

// Check if user is logged in and is admin
if (!isset($_SESSION['user_id']) || $_SESSION['email'] !== '1@gmail.com') {
    header("Location: /Fujifilm_Shop/admin/login.php");
    exit();
}

$db = new Database();
$conn = $db->getConnection();

// Thống kê tổng quan
$user_count = $conn->query("SELECT COUNT(*) as count FROM users")->fetch_assoc()['count'];
$product_count = $conn->query("SELECT COUNT(*) as count FROM products")->fetch_assoc()['count'];
$order_count = $conn->query("SELECT COUNT(*) as count FROM orders")->fetch_assoc()['count'];
$total_revenue = $conn->query("SELECT SUM(total_amount) as total FROM orders")->fetch_assoc()['total'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Bảng Điều Khiển</title>
    <link rel="stylesheet" href="/Fujifilm_Shop/page/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .sidebar {
            transition: all 0.3s;
        }
        .sidebar.collapsed {
            margin-left: -250px;
        }
        .nav-item:hover {
            background-color: #00916d;
            text-decoration: none;
        }
        .nav-link:hover {
            color: white;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-2 d-md-block bg-light sidebar">
                <div class="position-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <div class="headerLogo">
                                <a href="/Fujifilm_Shop/admin"><img src="/Fujifilm_Shop/images/logo/logo.png" alt="Fujifilm XSpace Việt Nam" class="img-fluid" /></a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/Fujifilm_Shop/admin/assets/modules/users/index.php">
                                <i class="fas fa-users"></i> Quản Lý Người Dùng
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/Fujifilm_Shop/admin/assets/modules/products/index.php">
                                <i class="fas fa-box"></i> Quản Lý Sản Phẩm
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/Fujifilm_Shop/admin/assets/modules/orders/index.php">
                                <i class="fas fa-shopping-cart"></i> Quản Lý Đơn Hàng
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/Fujifilm_Shop/admin/assets/modules/news/index.php">
                                <i class="fas fa-newspaper"></i> Quản Lý Tin Tức
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 content">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Bảng Điều Khiển</h1>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="card text-white bg-primary mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Người Dùng</h5>
                                <p class="card-text display-4"><?php echo $user_count; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-success mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Sản Phẩm</h5>
                                <p class="card-text display-4"><?php echo $product_count; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-warning mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Tổng Số Đơn Hàng</h5>
                                <p class="card-text display-4"><?php echo $order_count; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-danger mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Tổng Doanh Thu</h5>
                                <p class="card-text display-4"><?php echo number_format($total_revenue, 0, ',', '.'); ?> đ</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Biểu đồ doanh thu -->
                <div class="card mt-4">
                    <div class="card-header">Biểu Đồ Doanh Thu</div>
                    <div class="card-body">
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        // Biểu đồ doanh thu
        const ctx = document.getElementById('revenueChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6'],
                datasets: [{
                    label: 'Doanh Thu',
                    data: [12000, 19000, 3000, 5000, 2000, 30000],
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

    </script>
</body>
</html>