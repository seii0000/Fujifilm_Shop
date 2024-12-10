<?php
session_start();
require_once 'C:/xampp/htdocs/Fujifilm_Shop/admin/config/connect.php';

$db = new Database();
$conn = $db->getConnection();
$userManager = new UserManager($conn);

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $user = $userManager->getUserById($user_id);
} else {
    header("Location: /Fujifilm_Shop/admin/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>adiShop</title>
    <link rel="stylesheet" href="/Fujifilm_Shop/page/style.css" />
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div id="header-placeholder"></div>
    <div id="account-page">
        <div class="container">
            <div class="account-page-wrap mt-5">
                <div class="account-page-sidebar">
                    <div class="account-sidebar-header">
                        <div class="account-sidevar-avatar">
                            <img src="<?php echo htmlspecialchars($user['image_path']); ?>" alt="User Image" width="100">
                        </div>
                        <h3>Hi, <b id="user-name"><?php echo htmlspecialchars($user['username']); ?></b></h3>
                    </div>
                    <div class="mt-5 account-sidebar-menu">
                        <ul>
                            <li><a href="/account" class="active">Account information</a></li>
                            <li><a href="/account?view=orders">Purchase history</a></li>
                            <li><a href="/account/addresses">Address List</a></li>
                            <li><a href="/Fujifilm_Shop/page/account/logout.php">Log out</a></li>
                        </ul>
                    </div>
                </div>
                <div class="account-page-content">
                    <h1>
                        <span>Thông tin tài khoản</span>
                    </h1>
                    <div class="account-page-detail account-page-info">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Họ tên</td>
                                        <td id="full_name"><?php echo htmlspecialchars($user['full_name']); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td id="email"><?php echo htmlspecialchars($user['email']); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Số điện thoại</td>
                                        <td id="phone_number"><?php echo htmlspecialchars($user['phone_number']); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Địa chỉ</td>
                                        <td id="address"><?php echo htmlspecialchars($user['address']); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="footer-placeholder"></div>
    <script src="/Fujifilm_Shop/js/loadHeaderFooter.js"></script>
    <script>
        // Fetch user data from the server
        fetch('/Fujifilm_Shop/get_user_data.php')
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    // Update the HTML with the user data
                    document.getElementById('user-name').textContent = data.username;
                    document.getElementById('full_name').textContent = data.full_name;
                    document.getElementById('email').textContent = data.email;
                    document.getElementById('phone_number').textContent = data.phone_number;
                    document.getElementById('address').textContent = data.address;
                    document.querySelector('.account-sidevar-avatar img').src = data.image_path || '/Fujifilm_Shop/images/default-avatar.png';
                } else {
                    // Display error message
                    document.getElementById('error-message').textContent = data.message;
                    document.getElementById('error-message').style.display = 'block';
                }
            })
            .catch(error => {
                console.error('Error fetching user data:', error);
                document.getElementById('error-message').textContent = 'An error occurred while fetching user data.';
                document.getElementById('error-message').style.display = 'block';
            });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>