<?php
require_once 'C:/xampp/htdocs/Fujifilm_Shop/admin/config/connect.php';

$db = new Database();
$conn = $db->getConnection();

$product_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($product_id === 0) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid product ID']);
    exit();
}

// Fetch product details
$query = "SELECT product_id, product_name, description, price, compare_price, image_path FROM products WHERE product_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

if ($product) {
    echo json_encode(['status' => 'success', 'data' => $product]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Product not found']);
}
?>