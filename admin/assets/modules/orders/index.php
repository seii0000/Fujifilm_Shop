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

// Fetch orders
$query = "SELECT o.order_id, o.order_date, o.status, o.total_amount, u.email
          FROM orders o
          JOIN users u ON o.user_id = u.user_id
          ORDER BY o.order_date DESC";
$result = $conn->query($query);
$orders = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Order Management</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Total Amount</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): ?>
            <tr>
                <td><?= htmlspecialchars($order['order_id']) ?></td>
                <td><?= htmlspecialchars($order['order_date']) ?></td>
                <td><?= htmlspecialchars($order['status']) ?></td>
                <td><?= number_format($order['total_amount'], 0, ',', '.') ?>₫</td>
                <td><?= htmlspecialchars($order['email']) ?></td>
                <td>
                    <a href="view_order.php?order_id=<?= $order['order_id'] ?>" class="btn btn-info btn-sm">View</a>
                    <a href="confirm_order.php?order_id=<?= $order['order_id'] ?>" class="btn btn-success btn-sm">Confirm</a>
                    <a href="ship_order.php?order_id=<?= $order['order_id'] ?>" class="btn btn-warning btn-sm">Ship</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>