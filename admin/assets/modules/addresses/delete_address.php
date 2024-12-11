<?php
session_start();
require_once 'C:/xampp/htdocs/Fujifilm_Shop/admin/config/connect.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: /Fujifilm_Shop/admin/login.php");
    exit();
}

$db = new Database();
$conn = $db->getConnection();
$user_id = $_SESSION['user_id'];

if (isset($_GET['id'])) {
    $address_id = (int)$_GET['id'];
    $query = "DELETE FROM addresses WHERE address_id = ? AND user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $address_id, $user_id);
    if ($stmt->execute()) {
        header("Location: /Fujifilm_Shop/page/account/addresses.php");
        exit();
    } else {
        $error = "Failed to delete address.";
    }
} else {
    header("Location: /Fujifilm_Shop/page/account/addresses.php");
    exit();
}
?>