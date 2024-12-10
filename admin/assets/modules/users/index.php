<?php
require_once 'C:/xampp/htdocs/Fujifilm_Shop/admin/config/connect.php';

$db = new Database();
$conn = $db->getConnection();
$userManager = new UserManager($conn);

// Phân trang
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 10;
$offset = ($page - 1) * $limit;
$total_users = $userManager->countUsers();
$total_pages = ceil($total_users / $limit);

$users = $userManager->getAllUsers($limit, $offset);

// Kiểm tra trạng thái thao tác
$success = isset($_GET['success']) ? $_GET['success'] : null;
$action = isset($_GET['action']) ? $_GET['action'] : null;
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản Lý Người Dùng</title>
    <link rel="stylesheet" href="/Fujifilm_Shop/page/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
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
        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1050;
        }
    </style>
</head>
<body>
    <!-- Toast Notification Container -->
    <div class="toast-container position-fixed top-0 end-0 p-3">
        <?php if ($success && $action): ?>
        <div class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true" id="successToast">
            <div class="d-flex">
                <div class="toast-body">
                    <?php 
                    switch($action) {
                        case 'add':
                            echo "Thêm người dùng thành công!";
                            break;
                        case 'edit':
                            echo "Cập nhật người dùng thành công!";
                            break;
                        case 'delete':
                            echo "Xóa người dùng thành công!";
                            break;
                        default:
                            echo "Thao tác thành công!";
                    }
                    ?>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-md-block bg-light sidebar">
                <div class="position-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <div class="headerLogo">
                                <a href="/Fujifilm_Shop/admin/"><img src="/Fujifilm_Shop/images/logo/logo.png" alt="Fujifilm XSpace Việt Nam" class="img-fluid" /></a>
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

            <main class="col-md-10 ms-sm-auto px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Quản Lý Người Dùng</h1>
                    <a href="add_user.php" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Thêm Người Dùng Mới
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên Đăng Nhập</th>
                            <th>Email</th>
                            <th>Họ Tên</th>
                            <th>Số Điện Thoại</th>
                            <th>Ảnh Đại Diện</th>
                            <th>Ngày Tạo</th>
                            <th>Thao Tác</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?= $user['user_id'] ?></td>
                                <td><?= htmlspecialchars($user['username']) ?></td>
                                <td><?= htmlspecialchars($user['email']) ?></td>
                                <td><?= htmlspecialchars($user['full_name'] ?? 'N/A') ?></td>
                                <td><?= htmlspecialchars($user['phone_number'] ?? 'N/A') ?></td>
                                <td><img src="<?php echo htmlspecialchars($user['image_path']); ?>" alt="User Image" width="50"></td>
                                <td><?= $user['created_at'] ?></td>
                                <td>
                                    <a href="edit_user.php?id=<?= $user['user_id'] ?>" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="delete.php?id=<?= $user['user_id'] ?>" class="btn btn-danger btn-sm delete-user" onclick="return confirm('Bạn có chắc chắn muốn xóa người dùng này?')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <!-- Phân trang -->
                    <nav>
                        <ul class="pagination">
                            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                                    <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                                </li>
                            <?php endfor; ?>
                        </ul>
                    </nav>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            <?php if ($success && $action): ?>
            var successToast = new bootstrap.Toast(document.getElementById('successToast'));
            successToast.show();
            <?php endif; ?>
        });
    </script>
</body>
</html>
