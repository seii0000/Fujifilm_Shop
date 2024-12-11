<?php
header('Content-Type: application/json');
require_once '../../admin/config/connect.php';

try {
    $db = new Database();
    $conn = $db->getConnection();

    // Fetch new products
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
    ORDER BY p.created_at DESC
    LIMIT 10";

    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    $products = $result->fetch_all(MYSQLI_ASSOC);

    // Format price
    foreach ($products as &$product) {
        $product['price'] = number_format($product['price'], 0, ',', '.') . '₫';
        if ($product['compare_at_price']) {
            $product['compare_at_price'] = number_format($product['compare_at_price'], 0, ',', '.') . '₫';
        }
    }

    echo json_encode([
        'status' => 'success',
        'data' => $products
    ]);

} catch (Exception $e) {
    http_response_code(400);
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
    
}
?>