<?php
require_once 'C:/xampp/htdocs/Fujifilm_Shop/admin/config/connect.php';

$db = new Database();
$conn = $db->getConnection();
$userManager = new UserManager($conn);

if (isset($_GET['id'])) {
    $user_id = (int)$_GET['id'];
    
    if ($userManager->deleteUser($user_id)) {
        header("Location: index.php?success=1&action=delete");
        exit();
    } else {
        // Xử lý lỗi nếu không thể xóa
        echo "Không thể xóa người dùng";
    }
}
?>