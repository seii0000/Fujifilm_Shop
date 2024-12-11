<?php
session_start();
require_once 'C:/xampp/htdocs/Fujifilm_Shop/admin/config/connect.php';

$db = new Database();
$conn = $db->getConnection();
$userManager = new UserManager($conn);

// Check if user is logged in
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $user = $userManager->getUserById($user_id);
} else {
    header("Location: /Fujifilm_Shop/admin/login.php");
    exit();
}

// Fetch orders for the user
$query = "SELECT order_id, order_date, status, total_amount FROM orders WHERE user_id = ? ORDER BY order_date DESC";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$orders = $result->fetch_all(MYSQLI_ASSOC);
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
                            <li><a href="/Fujifilm_Shop/page/account/index.php">Account information</a></li>
                            <li><a href="/Fujifilm_Shop/page/account/view.php" class="active">Purchase history</a></li>
                            <li><a href="/Fujifilm_Shop/page/account/addresses.php">Address List</a></li>
                            <li><a href="/Fujifilm_Shop/page/account/logout.php">Log out</a></li>
                        </ul>
                    </div>
                </div>
                <div class="account-page-content">
                    <div class="account-content-header">
                        <h1>Purchase History</h1>
                    </div>
                    <div class="account-content-body">
                        <div class="account-address-list">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Order Date</th>
                                        <th>Status</th>
                                        <th>Total Amount</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($orders as $order): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($order['order_id']) ?></td>
                                        <td><?= htmlspecialchars($order['order_date']) ?></td>
                                        <td><?= htmlspecialchars($order['status']) ?></td>
                                        <td><?= number_format($order['total_amount'], 0, ',', '.') ?>₫</td>
                                        <td>
                                            <a href="view_order.php?order_id=<?= $order['order_id'] ?>" class="btn btn-info btn-sm">View</a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
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
    <script src="/Fujifilm_Shop/js/main.js"></script>
</body>
</html>
            

