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
                            <li><a href="/Fujifilm_Shop/page/account/index.php">Account information</a></li>
                            <li><a href="/account?view=orders">Purchase history</a></li>
                            <li><a href="/Fujifilm_Shop/page/account/addresses.php" class="active">Address List</a></li>
                            <li><a href="/Fujifilm_Shop/page/account/logout.php">Log out</a></li>
                        </ul>
                    </div>
                </div>
                <div class="account-page-content">
                    <div class="account-content-header">
                        <h1>Address List</h1>
                    </div>
                    <div class="account-content-body">
                        <div class="account-address-list">
                            <?php
                            $query = "SELECT * FROM addresses WHERE user_id = ?";
                            $stmt = $conn->prepare($query);
                            $stmt->bind_param("i", $user_id);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            while ($address = $result->fetch_assoc()):
                            ?>
                            <div class="account-address-item">
                                <div class="account-address-item-header">
                                    <h3><?= htmlspecialchars($address['label']) ?></h3>
                                    <div class="account-address-item-action">
                                        <a href="/Fujifilm_Shop/admin/assets/modules/addresses/edit_address.php?id=<?= $address['address_id'] ?>">Edit</a>
                                        <a href="/Fujifilm_Shop/admin/assets/modules/addresses/delete_address.php?id=<?= $address['address_id'] ?>">Delete</a>
                                    </div>
                                </div>
                                <div class="account-address-item-body">
                                    <p><?= htmlspecialchars($address['full_name']) ?></p>
                                    <p><?= htmlspecialchars($address['address']) ?></p>
                                    <p><?= htmlspecialchars($address['phone_number']) ?></p>
                                </div>
                            </div>
                            <?php endwhile; ?>
                        </div>
                        <div class="account-address-add">
                            <a href="/Fujifilm_Shop/admin/assets/modules/addresses/add_address.php" class="btn btn-primary">Add new address</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="footer-placeholder"></div>
    <script src="/Fujifilm_Shop/js/loadHeaderFooter.js"></script>
</body>

</html>