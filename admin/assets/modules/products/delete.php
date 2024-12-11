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

if (isset($_GET['id'])) {
    $product_id = (int)$_GET['id'];
    
    if ($productManager->deleteProduct($product_id)) {
        header("Location: index.php?success=1&action=delete");
        exit();
    } else {
        // Handle error if unable to delete
        echo "Không thể xóa sản phẩm";
    }
} 

?>