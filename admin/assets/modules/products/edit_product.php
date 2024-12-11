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
$productManager = new ProductManager($conn);

// Fetch product data
$product_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$product = $productManager->getProductById($product_id);

if (!$product) {
    echo "Product not found.";
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_name = $_POST['product_name'];
    $product_handle = $_POST['product_handle'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category_id = $_POST['category_id'];
    $image_path = $product['image_path']; // Keep the existing image path

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
    }

    if ($productManager->updateProduct($product_id, $product_name, $product_handle, $description, $price, $category_id, $image_path)) {
        header("Location: index.php?success=1&action=edit");
        exit();
    } else {
        $error = "Cập nhật sản phẩm không thành công";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chỉnh Sửa Sản Phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Chỉnh Sửa Sản Phẩm</h1>
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="product_name" class="form-label">Tên Sản Phẩm</label>
            <input type="text" class="form-control" id="product_name" name="product_name" value="<?= htmlspecialchars($product['product_name']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="product_handle" class="form-label">Đường Dẫn Sản Phẩm</label>
            <input type="text" class="form-control" id="product_handle" name="product_handle" value="<?= htmlspecialchars($product['product_handle']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Mô Tả</label>
            <textarea class="form-control" id="description" name="description" required><?= htmlspecialchars($product['description']) ?></textarea>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Giá</label>
            <input type="number" step="0.01" class="form-control" id="price" name="price" value="<?= htmlspecialchars($product['price']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="category_id" class="form-label">ID Danh Mục</label>
            <input type="number" class="form-control" id="category_id" name="category_id" value="<?= htmlspecialchars($product['category_id']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Hình Ảnh</label>
            <input type="file" class="form-control" id="image" name="image">
            <img src="<?= htmlspecialchars($product['image_path']) ?>" alt="Product Image" width="100">
        </div>
        <button type="submit" class="btn btn-primary">Cập Nhật Sản Phẩm</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>