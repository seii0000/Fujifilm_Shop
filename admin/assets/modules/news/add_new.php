<?php
require_once 'C:/xampp/htdocs/Fujifilm_Shop/admin/config/connect.php';

$db = new Database();
$conn = $db->getConnection();
$newsManager = new NewsManager($conn);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $author = $_POST['author'];
    $published_date = $_POST['published_date'];

    if ($newsManager->createNews($title, $content, $author, $published_date)) {
        header("Location: index.php?success=1&action=add");
        exit();
    } else {
        $error = "Không thể thêm tin tức";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm Tin Tức</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Thêm Tin Tức</h2>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>
        <form method="post">
            <div class="mb-3">
                <label for="title" class="form-label">Tiêu Đề</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Nội Dung</label>
                <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
            </div>
            <div class="mb-3">
                <label for="author" class="form-label">Tác Giả</label>
                <input type="text" class="form-control" id="author" name="author" required>
            </div>
            <div class="mb-3">
                <label for="published_date" class="form-label">Ngày Xuất Bản</label>
                <input type="date" class="form-control" id="published_date" name="published_date" required>
            </div>
            <button type="submit" class="btn btn-primary">Thêm Tin Tức</button>
        </form>
    </div>
</body>
</html>