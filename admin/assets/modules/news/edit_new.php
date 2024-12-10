<?php
require_once 'C:/xampp/htdocs/Fujifilm_Shop/admin/config/connect.php';

$db = new Database();
$conn = $db->getConnection();
$newsManager = new NewsManager($conn);

if (isset($_GET['id'])) {
    $news_id = (int)$_GET['id'];
    $article = $newsManager->getNewsById($news_id);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $author = $_POST['author'];
        $published_date = $_POST['published_date'];

        if ($newsManager->updateNews($news_id, $title, $content, $author, $published_date, $category)) {
            header("Location: index.php?success=1&action=edit");
            exit();
        } else {
            $error = "Cập nhật không thành công";
        }
    }
} else {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chỉnh Sửa Tin Tức</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Chỉnh Sửa Tin Tức</h2>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>
        <form method="post">
            <div class="mb-3">
                <label for="title" class="form-label">Tiêu Đề</label>
                <input type="text" class="form-control" id="title" name="title" value="<?= htmlspecialchars($article['title']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Nội Dung</label>
                <textarea class="form-control" id="content" name="content" rows="5" required><?= htmlspecialchars($article['content']) ?></textarea>
            </div>
            <div class="mb-3">
                <label for="author" class="form-label">Tác Giả</label>
                <input type="text" class="form-control" id="author" name="author" value="<?= htmlspecialchars($article['author']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="published_date" class="form-label">Ngày Xuất Bản</label>
                <input type="date" class="form-control" id="published_date" name="published_date" value="<?= htmlspecialchars($article['published_date']) ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Cập Nhật</button>
        </form>
    </div>
</body>
</html>