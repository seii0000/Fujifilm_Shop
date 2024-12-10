<?php
require_once 'C:/xampp/htdocs/Fujifilm_Shop/admin/config/connect.php';

$db = new Database();
$conn = $db->getConnection();
$userManager = new UserManager($conn);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $full_name = $_POST['full_name'];
    $address = $_POST['address'];
    $phone_number = $_POST['phone_number'];
    $image_path = '';

    // Handle the image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $upload_dir = 'C:/xampp/htdocs/Fujifilm_Shop/images/uploads/';
        $image_path = $upload_dir . basename($_FILES['image']['name']);
        if (!move_uploaded_file($_FILES['image']['tmp_name'], $image_path)) {
            echo "Failed to upload image.";
            exit();
        }
        // Store relative path to the image in the database
        $image_path = '/Fujifilm_Shop/images/uploads/' . basename($_FILES['image']['name']);
    } else {
        echo "Image upload error: " . $_FILES['image']['error'];
        exit();
    }

    if ($userManager->createUser($username, $email, $password, $full_name, $address, $phone_number, $image_path)) {
        header("Location: index.php?success=1&action=add");
        exit();
    } else {
        $error = "Thêm người dùng không thành công";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm Người Dùng Mới</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2>Thêm Người Dùng Mới</h2>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>
        <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="username" class="form-label">Tên Đăng Nhập</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mật Khẩu</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <label for="full_name" class="form-label">Họ Tên</label>
                <input type="text" class="form-control" id="full_name" name="full_name">
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Địa Chỉ</label>
                <input type="text" class="form-control" id="address" name="address">
            </div>
            <div class="mb-3">
                <label for="phone_number" class="form-label">Số Điện Thoại</label>
                <input type="text" class="form-control" id="phone_number" name="phone_number">
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Ảnh Đại Diện</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>
            <button type="submit" class="btn btn-primary">Thêm Người Dùng</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>