<?php
session_start();
require_once 'C:/xampp/htdocs/Fujifilm_Shop/admin/config/connect.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: /Fujifilm_Shop/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$admin_email = '1@gmail.com';

$db = new Database();
$conn = $db->getConnection();

// Fetch admin user ID
$query = "SELECT user_id FROM users WHERE email = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $admin_email);
$stmt->execute();
$result = $stmt->get_result();
$admin = $result->fetch_assoc();
$admin_id = $admin['user_id'];

// Handle message sending
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['message'])) {
    $message = $_POST['message'];
    $receiver_id = $admin_id;

    $query = "INSERT INTO messages (sender_id, receiver_id, message) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iis", $user_id, $receiver_id, $message);
    $stmt->execute();
}

// Fetch messages between user and admin
$query = "SELECT m.message, m.timestamp, u.username AS sender
          FROM messages m
          JOIN users u ON m.sender_id = u.user_id
          WHERE (m.sender_id = ? AND m.receiver_id = ?) OR (m.sender_id = ? AND m.receiver_id = ?)
          ORDER BY m.timestamp ASC";
$stmt = $conn->prepare($query);
$stmt->bind_param("iiii", $user_id, $admin_id, $admin_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();
$messages = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages</title>
    <link rel="stylesheet" href="/Fujifilm_Shop/page/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div id="header-placeholder"></div>
<main>
    <div class="container mt-5">
        <h1>Messages with Admin</h1>
        <div class="messages">
            <?php foreach ($messages as $msg): ?>
                <div class="message">
                    <strong><?= htmlspecialchars($msg['sender']) ?>:</strong>
                    <p><?= htmlspecialchars($msg['message']) ?></p>
                    <small><?= htmlspecialchars($msg['timestamp']) ?></small>
                </div>
            <?php endforeach; ?>
        </div>
        <form method="post" class="mt-4">
            <div class="mb-3">
                <label for="message" class="form-label">Your Message</label>
                <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Send Message</button>
        </form>
    </div>
</main>
<div id="footer-placeholder"></div>
<script src="/Fujifilm_Shop/js/loadHeaderFooter.js"></script>
<script src="/Fujifilm_Shop/js/main.js"></script>
</body>
</html>