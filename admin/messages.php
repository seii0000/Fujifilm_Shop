<?php
session_start();
require_once 'C:/xampp/htdocs/Fujifilm_Shop/admin/config/connect.php';

// Check if user is logged in and is admin
if (!isset($_SESSION['user_id']) || $_SESSION['email'] !== '1@gmail.com') {
    header("Location: /Fujifilm_Shop/admin/login.php");
    exit();
}

$admin_id = $_SESSION['user_id'];

$db = new Database();
$conn = $db->getConnection();

// Handle message sending
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['message']) && isset($_POST['receiver_id'])) {
    $message = $_POST['message'];
    $receiver_id = $_POST['receiver_id'];

    $query = "INSERT INTO messages (sender_id, receiver_id, message) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iis", $admin_id, $receiver_id, $message);
    $stmt->execute();
}

// Fetch messages between admin and users
$query = "SELECT m.message, m.timestamp, u.username AS sender, u2.username AS receiver, u2.user_id AS receiver_id
          FROM messages m
          JOIN users u ON m.sender_id = u.user_id
          JOIN users u2 ON m.receiver_id = u2.user_id
          WHERE m.receiver_id = ? OR m.sender_id = ?
          ORDER BY m.timestamp ASC";
$stmt = $conn->prepare($query);
$stmt->bind_param("ii", $admin_id, $admin_id);
$stmt->execute();
$result = $stmt->get_result();
$messages = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Messages</title>
    <link rel="stylesheet" href="/Fujifilm_Shop/page/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div id="header-placeholder"></div>
<main>
    <div class="container mt-5">
        <h1>Messages</h1>
        <div class="messages">
            <?php foreach ($messages as $msg): ?>
                <div class="message">
                    <strong><?= htmlspecialchars($msg['sender']) ?> to <?= htmlspecialchars($msg['receiver']) ?>:</strong>
                    <p><?= htmlspecialchars($msg['message']) ?></p>
                    <small><?= htmlspecialchars($msg['timestamp']) ?></small>
                </div>
            <?php endforeach; ?>
        </div>
        <form method="post" class="mt-4">
            <div class="mb-3">
                <label for="receiver_id" class="form-label">Select User</label>
                <select class="form-control" id="receiver_id" name="receiver_id" required>
                    <?php
                    // Fetch all users except admin
                    $query = "SELECT user_id, username FROM users WHERE user_id != ?";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("i", $admin_id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    while ($user = $result->fetch_assoc()) {
                        echo '<option value="' . htmlspecialchars($user['user_id']) . '">' . htmlspecialchars($user['username']) . '</option>';
                    }
                    ?>
                </select>
            </div>
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