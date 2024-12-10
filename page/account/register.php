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
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
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
        header("Location: index.php");
        exit();
    } else {
        $error = "Đăng ký không thành công";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>adiShop</title>
    <link rel="stylesheet" href="/Fujifilm_Shop/page/style.css"/>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet"> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .toast-container {
        position: fixed;
        top: 20px;
        right: 20px;
        }
    </style>
</head>

<body>
  <div id="header-placeholder"></div>
  <main>
    <div class="my-account-wrap">
        <div class="container">
            <div class="row">
                <div class="col-md-4 offset-md-4 col-sm-6 offset-dm-3 col-12">
                    <div id="auth-form" class="login-layout">
                        <div class="auth-heading">
                            <img src="/Fujifilm_Shop/images/logo/logo.png" alt="" srcset="">
                            <h1 class="mt-5"><span class="login-form-heading">ĐĂNG KÝ</span></h1>
                            <?php if (isset($error)): ?>
                                <div class="alert alert-danger"><?= $error ?></div>
                            <?php endif; ?>
                            <div class="auth-form-body">
                                <div class="login-form-body">
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
                                    <div class="form-group">
                                        <label>Giới tính</label>
                                        <div class="row">
                                            <div class="col-6">
                                                <input class="bg-color-black" type="radio" id="register-gender-0" value="0" name="customer[gender]" checked=""> 
                                                <label for="register-gender-0">Nữ</label>
                                            </div>
                                            <div class="col-6">
                                                <input type="radio" id="register-gender-1" value="1" name="customer[gender]"> 
                                                <label for="register-gender-1">Nam</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="image" class="form-label">Ảnh Đại Diện</label>
                                        <input type="file" class="form-control" id="image" name="image">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Đăng Ký</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </main>
  <div id="footer-placeholder"></div>
  <script src="/Fujifilm_Shop/js/loadHeaderFooter.js"></script>
  <script src="/Fujifilm_Shop/js/main.js"></script>
  <script src="/Fujifilm_Shop/js/loadHeaderFooter.js"></script>
</body>

</html>
