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

    // Get the updated data from the request
    $username = $_POST['username'];
    $email = $_POST['email'];
    $full_name = $_POST['full_name'];
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];

    // Update the user data in the database
    $query = "UPDATE users SET username = ?, email = ?, full_name = ?, phone_number = ?, address = ? WHERE user_id = ?";
    $stmt = $conn->prepare($query);
    if (!$stmt) {
        throw new Exception("Failed to prepare statement: " . $conn->error);
    }

    $stmt->bind_param("sssssi", $username, $email, $full_name, $phone_number, $address, $user_id);
    $stmt->execute();

    if ($stmt->affected_rows === 0) {
        throw new Exception("No rows updated.");
    }

    $response['status'] = 'success';
    $response['message'] = 'User data updated successfully.';

    $stmt->close();
    $conn->close();
} catch (Exception $e) {
    $response['status'] = 'error';
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
?>