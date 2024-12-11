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

// Fetch order details
$query = "SELECT order_id, status FROM orders WHERE order_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $order_id);
$stmt->execute();
$result = $stmt->get_result();
$order = $result->fetch_assoc();

if (!$order) {
    echo "Order not found.";
    exit();
}

if ($order['status'] !== 'confirmed') {
    echo "Order cannot be shipped. It is not confirmed.";
    exit();
}

// Update order status to 'shipped'
$query = "UPDATE orders SET status = 'shipped' WHERE order_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $order_id);
$stmt->execute();

header("Location: index.php");
exit();
?>