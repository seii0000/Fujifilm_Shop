<?php
session_start();
require_once 'C:/xampp/htdocs/Fujifilm_Shop/admin/config/connect.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: /Fujifilm_Shop/admin/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$db = new Database();
$conn = $db->getConnection();

// Fetch cart ID for the user
$query = "SELECT cart_id FROM cart WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$cart = $result->fetch_assoc();

if (!$cart) {
    echo "No cart found for the user.";
    exit();
}

$cart_id = $cart['cart_id'];

// Fetch cart items
$query = "SELECT ci.quantity, p.product_id, p.product_name, p.product_handle, p.description, p.price, p.compare_price, p.image_path
          FROM cart_items ci
          JOIN products p ON ci.product_id = p.product_id
          WHERE ci.cart_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $cart_id);
$stmt->execute();
$result = $stmt->get_result();
$cart_items = $result->fetch_all(MYSQLI_ASSOC);

// Calculate total price
$total_price = 0;
foreach ($cart_items as $item) {
    $total_price += $item['price'] * $item['quantity'];
}

// Handle order creation
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['place_order'])) {
    // Insert order
    $query = "INSERT INTO orders (user_id, total_amount) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("id", $user_id, $total_price);
    $stmt->execute();
    $order_id = $stmt->insert_id;

    // Insert order items
    $query = "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    foreach ($cart_items as $item) {
        $stmt->bind_param("iiid", $order_id, $item['product_id'], $item['quantity'], $item['price']);
        $stmt->execute();
    }

    // Clear cart
    $query = "DELETE FROM cart_items WHERE cart_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $cart_id);
    $stmt->execute();

    // Redirect to order confirmation page
    header("Location: /Fujifilm_Shop/page/order_confirmation.php?order_id=$order_id");
    exit();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>adiShop</title>
    <link rel="stylesheet" href="/Fujifilm_Shop/page/style.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <script script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div id="header-placeholder"></div>
    <main>
        <div id="cart-page">
            <div class="container container-xl">
                <div class="cart-page-wrap">
                    <div class="cart-page-left">
                        <div class="cart-page-list">
                            <?php foreach ($cart_items as $item): ?>
                            <div class="cart-page-list-item abc" data-rid="<?= htmlspecialchars($item['product_handle']) ?>">
                                <div class="cart-page-list-item-image">
                                    <img class="img-fluid" src="<?= htmlspecialchars($item['image_path']) ?>" alt="<?= htmlspecialchars($item['product_name']) ?>">
                                </div>
                                <div class="cart-page-list-item-detail">
                                    <span class="item-vendor">Fujifilm</span>
                                    <h3>
                                        <a href="/products/<?= htmlspecialchars($item['product_handle']) ?>">
                                            <?= htmlspecialchars($item['product_name']) ?>
                                        </a>
                                    </h3>
                                    <div class="item-desc">
                                        <span><?= htmlspecialchars($item['description']) ?></span>
                                    </div>
                                </div>
                                <div class="cart-page-list-item-prices">
                                    <span class="price-item"><?= number_format($item['price'], 0, ',', '.') ?>₫</span>
                                    <?php if ($item['compare_price']): ?>
                                    <del><?= number_format($item['compare_price'], 0, ',', '.') ?>₫</del>
                                    <?php endif; ?>
                                </div>
                                <div class="cart-page-list-item-actions">
                                    <div class="cart-product-quantity-wrap">
                                        <button class="cart-product-quantity-button-minus">-</button>
                                        <input class="cart-product-quanity" type="number" value="<?= htmlspecialchars($item['quantity']) ?>" data-vid="<?= htmlspecialchars($item['product_handle']) ?>">
                                        <button class="cart-product-quantity-button-plus">+</button>
                                    </div>
                                    <div class="item-actions">
                                        <a href="/cart/change?line=<?= htmlspecialchars($item['product_handle']) ?>&amp;quantity=0" class="item-actions-remove" data-vid="<?= htmlspecialchars($item['product_handle']) ?>">Xoá</a>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="cart-page-right">
                        <div class="cart-page-info">
                            <h1>Thông tin đơn hàng</h1>
                            <div class="cart-page-subtotal">
                                <span>Tạm tính (<?= count($cart_items) ?> sản phẩm)</span>
                                <span><?= number_format($total_price, 0, ',', '.') ?>₫</span>
                            </div>
                            <div class="cart-page-subtitle">
                                Phí vận chuyển được tính ở trang thanh toán và bạn có thể nhập mã khuyến mãi ở trang thanh toán
                            </div>
                            <div class="sidebox-order_text"></div>
                            <div class="check-policy">
                                <input type="checkbox"> Khi bấm nút "Đặt hàng" đồng nghĩa Khách hàng đã hiểu và đồng ý các Điều khoản và Điều kiện "Mua hàng và Thanh toán" của Fujifilm XSpace.
                            </div>
                            <div class="cart-page-total">
                                <span>Tổng cộng</span>
                                <div class="cart-page-total-price">
                                    <span><?= number_format($total_price, 0, ',', '.') ?>₫</span>
                                </div>
                            </div>
                            <div class="cart-page-checkout">
                                <form method="post">
                                    <input type="hidden" name="place_order" value="1">
                                    <button type="submit" class="btn btn-primary">Đặt Hàng</button>
                                </form>
                            </div>
                        </div>
                        
                        <div class="invoice-block">
                            <div class="invoice-block-head">
                                <input type="checkbox" id="invoice-export">
                                <label for="invoice-export">Xuất Hóa Đơn</label>
                            </div>
                            <div class="invoice-block-body">
                                <div class="form-group">
                                    <label>Tên công ty</label>
                                    <input class="form-control" autocomplete="off" type="text" value="" id="company_name">
                                </div>
                                <div class="form-group">
                                    <label>Mã số thuế</label>
                                    <input class="form-control" autocomplete="off" type="number" value="" id="company_taxcode">
                                </div>
                                <div class="form-group">
                                    <label>Địa chỉ</label>
                                    <input class="form-control" autocomplete="off" type="text" value="" id="company_address">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div id="footer-placeholder"></div>
    <script src="/Fujifilm_Shop/js/main.js"></script>
    <script src="/Fujifilm_Shop/js/loadHeaderFooter.js"></script>
</body>
</html>