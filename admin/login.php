<?php
session_start();
require_once 'C:/xampp/htdocs/Fujifilm_Shop/admin/config/connect.php';

$db = new Database();
$conn = $db->getConnection();

// Initialize error variable
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['customer']['email'];
    $password = $_POST['customer']['password'];

    $email = mysqli_real_escape_string($conn, $email);

    // Query to check user credentials
    $sql = "SELECT user_id, username, email, password_hash FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $user['password_hash'])) {
            // Set session variables
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];

            // Check if user is admin
            if ($email === '1@gmail.com') {
                header("Location: /Fujifilm_Shop/admin/index.php"); // Redirect to admin dashboard
                exit();
            } else {
                header("Location: /Fujifilm_Shop/page/account/index.php"); // Redirect to user account page
                exit();
            }
        } else {
            $error = "Tài khoản hoặc mật khẩu không chính xác";
        }
    } else {
        $error = "Tài khoản hoặc mật khẩu không chính xác";
    }

    // Close connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Fujifilm_Shop/page/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Đăng Nhập</title>
</head>
<body>
    <div id="header-placeholder"></div>
    <main>
        <div class="my-account-wrap">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 offset-md-4 col-sm-6 offset-dm-3 col-12">
                        <div id="auth-form" class="login-layout">
                            <div class="auth-heading">
                                <img src="/Fujifilm_Shop/images/logo/logo.png" alt="" srcset="">
                                <h1 class="mt-5"><span class="login-form-heading">ĐĂNG NHẬP</span></h1>
                                
                                <!-- Error Message Display -->
                                <?php if (!empty($error)): ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <?php echo htmlspecialchars($error); ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                <?php endif; ?>
                                
                                <div class="auth-form-body">
                                    <div class="login-form-body">
                                    <form accept-charset="UTF-8" action="/Fujifilm_Shop/admin/login.php" id="customer_login" method="post">
                                        <input name="form_type" type="hidden" value="customer_login">
                                        <input name="utf8" type="hidden" value="✓">
                                        <div class="form-group">
                                            <label for="login-email">Tài khoản*</label>
                                            <input type="email" id="login-email" class="form-control" name="customer[email]" required="">
                                        </div>
                                        <div class="form-group">
                                            <label for="login-password">Mật khẩu*</label>
                                            <input type="password" id="login-password" class="form-control" name="customer[password]" required="">
                                        </div>
                                        <div class="auth-recover-btn">
                                            <a href="/Fujifilm_Shop/page/account/password_forget.php" data-layout="recover-layout" class="auth-layout-trigger">Quên mật khẩu?</a>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">
                                                ĐĂNG NHẬP
                                            </button>
                                        </div>
                                        <div class="auth-back-btn">
                                            <a href="/Fujifilm_Shop/page/account/register.php">Đăng ký</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <div id="footer-placeholder"></div>
    <script src="/Fujifilm_Shop/js/loadHeaderFooter.js"></script>
    <script src="/Fujifilm_Shop/js/main.js"></script>
</body>
</html>