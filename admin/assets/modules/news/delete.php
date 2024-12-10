<?php
require_once 'C:/xampp/htdocs/Fujifilm_Shop/admin/config/connect.php';

$db = new Database();
$conn = $db->getConnection();
$newsManager = new NewsManager($conn);

if (isset($_GET['id'])) {
    $news_id = (int)$_GET['id'];
    
    if ($newsManager->deleteNews($news_id)) {
        header("Location: index.php?success=1&action=delete");
        exit();
    } else {
        // Handle error if unable to delete
        echo "Không thể xóa tin tức";
    }
} else {
    header("Location: index.php");
    exit();
}
?>