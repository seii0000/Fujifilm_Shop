<?php
header('Content-Type: application/json');
require_once '../../admin/config/connect.php';

try {
    $db = new Database();
    $conn = $db->getConnection();

    // Get product ID from URL parameter
    $productId = isset($_GET['id']) ? $_GET['id'] : null;

    if (!$productId) {
        throw new Exception('Product ID is required');
    }

    // Fetch product data
    $query = "SELECT 
        p.product_id,
        p.product_name as title,
        p.description,
        p.price,
        p.image_path as featured_image,
        p.compare_price as compare_at_price,
        c.category_name
    FROM products p
    LEFT JOIN categories c ON p.category_id = c.category_id
    WHERE p.product_id = ?";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

    if (!$product) {
        throw new Exception('Product not found');
    }

    // Format price
    $product['price'] = number_format($product['price'], 0, ',', '.') . '₫';
    if ($product['compare_at_price']) {
        $product['compare_at_price'] = number_format($product['compare_at_price'], 0, ',', '.') . '₫';
    }

    echo json_encode([
        'status' => 'success',
        'data' => $product
    ]);

} catch (Exception $e) {
    http_response_code(400);
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}
?>