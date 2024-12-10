<?php
session_start();
require_once 'C:/xampp/htdocs/Fujifilm_Shop/admin/config/connect.php';

$db = new Database();
$conn = $db->getConnection();

$user_id = $_SESSION['user_id']; // Assuming user ID is stored in session

$query = "SELECT username, email, full_name, address, phone_number FROM users WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User Information</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Cập nhật thông tin người dùng</h2>
        <form id="update-form">
            <div class="mb-3">
                <label for="username" class="form-label">Tên đăng nhập</label>
                <input type="text" class="form-control" id="username" name="username" value="<?= htmlspecialchars($user['username']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="full_name" class="form-label">Họ và tên</label>
                <input type="text" class="form-control" id="full_name" name="full_name" value="<?= htmlspecialchars($user['full_name']) ?>">
            </div>
            <div class="mb-3">
                <label for="phone_number" class="form-label">Số điện thoại</label>
                <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?= htmlspecialchars($user['phone_number']) ?>">
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Địa chỉ</label>
                <input type="text" class="form-control" id="address" name="address" value="<?= htmlspecialchars($user['address']) ?>">
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </form>
        <div id="error-message" class="alert alert-danger mt-3" style="display: none;"></div>
    </div>

    <script>
        document.getElementById('update-form').addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(this);

            fetch('/Fujifilm_Shop/api/update_user_data.php', {
                method: 'POST',
                body: new URLSearchParams(formData)
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    alert('Cập nhật thông tin người dùng thành công.');
                    window.location.href = '/Fujifilm_Shop/page/account/index.php'; // Redirect to the user information page
                } else {
                    document.getElementById('error-message').textContent = data.message;
                    document.getElementById('error-message').style.display = 'block';
                }
            })
            .catch(error => {
                console.error('Lỗi khi cập nhật thông tin người dùng:', error);
                document.getElementById('error-message').textContent = 'Đã xảy ra lỗi khi cập nhật thông tin người dùng.';
                document.getElementById('error-message').style.display = 'block';
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>