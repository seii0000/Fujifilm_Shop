<?php
session_start();
require_once 'C:/xampp/htdocs/Fujifilm_Shop/admin/config/connect.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: /Fujifilm_Shop/admin/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$order_id = isset($_GET['order_id']) ? (int)$_GET['order_id'] : 0;

if ($order_id === 0) {
    echo "Invalid order ID.";
    exit();
}

$db = new Database();
$conn = $db->getConnection();

// Fetch order details
$query = "SELECT o.order_id, o.order_date, o.status, o.total_amount, u.email
          FROM orders o
          JOIN users u ON o.user_id = u.user_id
          WHERE o.order_id = ? AND o.user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ii", $order_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();
$order = $result->fetch_assoc();

if (!$order) {
    echo "Order not found.";
    exit();
}

// Fetch order items
$query = "SELECT oi.quantity, p.product_name, p.price
          FROM order_items oi
          JOIN products p ON oi.product_id = p.product_id
          WHERE oi.order_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $order_id);
$stmt->execute();
$result = $stmt->get_result();
$order_items = $result->fetch_all(MYSQLI_ASSOC);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Order Confirmation</title>
    <link rel="stylesheet" href="/Fujifilm_Shop/page/style.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <script script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div id="header-placeholder"></div>
    <main>
        <div class="container mt-5">
            <h1>Order Confirmation</h1>
            <div class="order-details">
                <h2>Order #<?= htmlspecialchars($order['order_id']) ?></h2>
                <p><strong>Order Date:</strong> <?= htmlspecialchars($order['order_date']) ?></p>
                <p><strong>Status:</strong> <?= htmlspecialchars($order['status']) ?></p>
                <p><strong>Total Amount:</strong> <?= number_format($order['total_amount'], 0, ',', '.') ?>₫</p>
                <p><strong>Email:</strong> <?= htmlspecialchars($order['email']) ?></p>
            </div>
            <div class="order-items">
                <h3>Order Items</h3>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($order_items as $item): ?>
                        <tr>
                            <td><?= htmlspecialchars($item['product_name']) ?></td>
                            <td><?= htmlspecialchars($item['quantity']) ?></td>
                            <td><?= number_format($item['price'], 0, ',', '.') ?>₫</td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <div id="footer-placeholder"></div>
    <script src="/Fujifilm_Shop/js/main.js"></script>
    <script src="/Fujifilm_Shop/js/loadHeaderFooter.js"></script>
</body>
</html>