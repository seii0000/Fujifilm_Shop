<?php
session_start();
require_once 'C:/xampp/htdocs/Fujifilm_Shop/admin/config/connect.php';

$response = array();

try {
    if (!isset($_SESSION['user_id'])) {
        throw new Exception("User not logged in.");
    }

    $db = new Database();
    $conn = $db->getConnection();

    $user_id = $_SESSION['user_id']; // Assuming user ID is stored in session

    $query = "SELECT username, email, full_name, address, phone_number, image_path FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($query);
    if (!$stmt) {
        throw new Exception("Failed to prepare statement: " . $conn->error);
    }

    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 0) {
        throw new Exception("User not found.");
    }

    $user = $result->fetch_assoc();
    $response['status'] = 'success';
    $response['data'] = $user;

    $stmt->close();
    $conn->close();
} catch (Exception $e) {
    $response['status'] = 'error';
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
?>