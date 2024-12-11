<?php
session_start();
require_once 'C:/xampp/htdocs/Fujifilm_Shop/admin/config/connect.php';

// Check if user is logged in and is admin
if (!isset($_SESSION['user_id']) || $_SESSION['email'] !== '1@gmail.com') {
    header("Location: /Fujifilm_Shop/admin/login.php");
    exit();
}

$order_id = isset($_GET['order_id']) ? (int)$_GET['order_id'] : 0;

if ($order_id === 0) {
    echo "Invalid order ID.";
    exit();
}

$db = new Database();
$conn = $db->getConnection();

// Fetch order items
$query = "SELECT oi.product_id, oi.quantity, p.product_name, p.stock
          FROM order_items oi
          JOIN products p ON oi.product_id = p.product_id
          WHERE oi.order_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $order_id);
$stmt->execute();
$result = $stmt->get_result();
$order_items = $result->fetch_all(MYSQLI_ASSOC);

// Check stock availability
$errors = [];
foreach ($order_items as $item) {
    if ($item['stock'] < $item['quantity']) {
        $errors[] = "Not enough stock for product: " . htmlspecialchars($item['product_name']);
    }
}

if (!empty($errors)) {
    echo "<h1>Order Confirmation Failed</h1>";
    echo "<ul>";
    foreach ($errors as $error) {
        echo "<li>$error</li>";
    }
    echo "</ul>";
    echo "<a href='index.php'>Back to Orders</a>";
    exit();
}

// Update order status to 'confirmed'
$query = "UPDATE orders SET status = 'confirmed' WHERE order_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $order_id);
$stmt->execute();

// Update product stock
foreach ($order_items as $item) {
    $query = "UPDATE products SET stock = stock - ? WHERE product_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $item['quantity'], $item['product_id']);
    $stmt->execute();
}

header("Location: index.php");
exit();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Confirm Order</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Confirm Order</h1>
    <form method="post" id="confirm-order-form">
        <input type="hidden" name="confirm_order" value="1">
        <button type="submit" class="btn btn-success" id="confirm-order-button">Confirm Order</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById('confirm-order-form').addEventListener('submit', function() {
        document.getElementById('confirm-order-button').disabled = true;
    });
</script>
</body>
</html>