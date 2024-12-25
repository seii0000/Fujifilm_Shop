<?php
session_start();
require_once 'C:/xampp/htdocs/Fujifilm_Shop/admin/config/connect.php';

$db = new Database();
$conn = $db->getConnection();

$query = isset($_GET['query']) ? $_GET['query'] : '';

if (empty($query)) {
    echo "No search query provided.";
    exit();
}

// Fetch products matching the search query
$search_query = "%" . $conn->real_escape_string($query) . "%";
$sql = "SELECT product_id, product_name, product_handle, description, price, compare_price, image_path FROM products WHERE product_name LIKE ? OR description LIKE ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $search_query, $search_query);
$stmt->execute();
$result = $stmt->get_result();
$products = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link rel="stylesheet" href="/Fujifilm_Shop/page/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div id="header-placeholder"></div>
<main>
    <div class="container mt-5">
        <h1>Search Results for "<?= htmlspecialchars($query) ?>"</h1>
        <?php if (empty($products)): ?>
            <p>No products found.</p>
        <?php else: ?>
            <div class="row">
                <?php foreach ($products as $product): ?>
                    <div class="col-md-4">
                        <div class="card mb-4 shadow-sm">
                            <img src="<?= htmlspecialchars($product['image_path']) ?>" class="card-img-top" alt="<?= htmlspecialchars($product['product_name']) ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($product['product_name']) ?></h5>
                                <p class="card-text"><?= htmlspecialchars($product['description']) ?></p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a href="#" title="Xem nhanh" class="setQuickview" data-id="<?= $product['product_id'] ?>" data-toggle="modal" data-target="#quickviewLogin" data-whatever="@quickviewLogin">Xem Nhanh</a>
                                    </div>
                                    <small class="text-muted"><?= number_format($product['price'], 0, ',', '.') ?>₫</small>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</main>

<!-- Quick View Modal -->
<div class="modal fade" id="quickviewLogin" tabindex="-1" aria-labelledby="quickviewLoginLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="quickviewLoginLabel">Chi tiết sản phẩm</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="product-images">
                            <img id="quickview-image" src="" alt="" class="img-fluid">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h2 id="quickview-title"></h2>
                        <div class="price-box">
                            <span class="current-price" id="quickview-price"></span>
                            <span class="old-price" id="quickview-old-price"></span>
                        </div>
                        <div class="product-description" id="quickview-description"></div>
                        <div class="quantity-selector mt-3">
                            <label>Số lượng:</label>
                            <div class="quantity-controls">
                                <button type="button" class="btn btn-outline-secondary btn-sm" onclick="decreaseQuantity()">-</button>
                                <input type="number" id="quantity" value="1" min="1" class="form-control">
                                <button type="button" class="btn btn-outline-secondary btn-sm" onclick="increaseQuantity()">+</button>
                            </div>
                        </div>
                        <button id="add-to-cart-button" class="btn btn-primary mt-3 w-100">Thêm vào giỏ hàng</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="footer-placeholder"></div>
<script src="/Fujifilm_Shop/js/loadHeaderFooter.js"></script>
<script src="/Fujifilm_Shop/js/main.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.setQuickview').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const productId = this.getAttribute('data-id');
                
                // Fetch product data
                fetch(`/Fujifilm_Shop/api/products/get_product_details.php?id=${productId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            const product = data.data;
                            // Update modal content
                            document.getElementById('quickview-title').textContent = product.product_name;
                            document.getElementById('quickview-price').textContent = product.price;
                            document.getElementById('quickview-old-price').textContent = product.compare_price || '';
                            document.getElementById('quickview-description').innerHTML = product.description;
                            document.getElementById('quickview-image').src = product.image_path;
                            document.getElementById('add-to-cart-button').setAttribute('data-product-id', product.product_id);
                            
                            // Show modal
                            const modal = new bootstrap.Modal(document.getElementById('quickviewLogin'));
                            modal.show();
                        } else {
                            console.error('Error fetching product data:', data.message);
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });
        });
    });

    // Quantity controls
    window.increaseQuantity = function() {
        const input = document.getElementById('quantity');
        input.value = parseInt(input.value) + 1;
    }

    window.decreaseQuantity = function() {
        const input = document.getElementById('quantity');
        if (parseInt(input.value) > 1) {
            input.value = parseInt(input.value) - 1;
        }
    }

    // Add to Cart functionality
    document.getElementById('add-to-cart-button').addEventListener('click', function() {
        const productId = this.getAttribute('data-product-id');
        const quantity = document.getElementById('quantity').value;

        fetch('/Fujifilm_Shop/api/cart/add.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ product_id: productId, quantity: quantity })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                alert('Product added to cart successfully!');
                // Optionally, close the modal
                const modal = bootstrap.Modal.getInstance(document.getElementById('quickviewLogin'));
                modal.hide();
            } else {
                console.error('Error adding product to cart:', data.message);
            }
        })
        .catch(error => console.error('Error:', error));
    });
</script>
</body>
</html>