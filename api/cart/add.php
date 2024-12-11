<?php
header('Content-Type: application/json');
require_once '../../admin/config/connect.php';

session_start();

try {
    if (!isset($_SESSION['user_id'])) {
        throw new Exception('User not logged in');
    }

    $db = new Database();
    $conn = $db->getConnection();

    $data = json_decode(file_get_contents('php://input'), true);
    if (!isset($data['product_id']) || !isset($data['quantity'])) {
        throw new Exception('Product ID and quantity are required');
    }

    $productId = $data['product_id'];
    $quantity = $data['quantity'];
    $userId = $_SESSION['user_id'];

    // Check if cart exists for user
    $query = "SELECT cart_id FROM cart WHERE user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $cart = $result->fetch_assoc();

    if (!$cart) {
        // Create new cart
        $query = "INSERT INTO cart (user_id) VALUES (?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $cartId = $stmt->insert_id;
    } else {
        $cartId = $cart['cart_id'];
    }

    // Add product to cart
    $query = "INSERT INTO cart_items (cart_id, product_id, quantity) VALUES (?, ?, ?)
              ON DUPLICATE KEY UPDATE quantity = quantity + VALUES(quantity)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iii", $cartId, $productId, $quantity);
    $stmt->execute();

    echo json_encode([
        'status' => 'success',
        'message' => 'Product added to cart successfully'
    ]);

} catch (Exception $e) {
    http_response_code(400);
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}
?>