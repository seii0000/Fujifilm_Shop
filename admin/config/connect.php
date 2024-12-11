<?php
class Database {
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'camera_shop';
    public $conn;

    public function __construct() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);

        if ($this->conn->connect_error) {
            die("Kết nối không thành công: " . $this->conn->connect_error);
        }

        $this->conn->set_charset('utf8');
    }

    public function getConnection() {
        return $this->conn;
    }

    public function closeConnection() {
        $this->conn->close();
    }
}

class UserManager {
    private $conn;

    public function __construct($connection) {
        $this->conn = $connection;
    }

    // Lấy danh sách người dùng
    public function getAllUsers($limit = 10, $offset = 0) {
        $query = "SELECT * FROM users ORDER BY created_at DESC LIMIT ? OFFSET ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $limit, $offset);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    // Đếm tổng số người dùng
    public function countUsers() {
        $result = $this->conn->query("SELECT COUNT(*) as total FROM users");
        return $result->fetch_assoc()['total'];
    }

    // Lấy thông tin người dùng theo ID
    public function getUserById($user_id) {
        $query = "SELECT * FROM users WHERE user_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Cập nhật người dùng
    public function updateUser($user_id, $username, $email, $full_name, $address, $phone_number, $image_path) {
        $query = "UPDATE users SET username = ?, email = ?, full_name = ?, address = ?, phone_number = ?, image_path = ? WHERE user_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssssssi", $username, $email, $full_name, $address, $phone_number, $image_path, $user_id);
        return $stmt->execute();
    }

    // Xóa người dùng
    public function deleteUser($user_id) {
        $query = "DELETE FROM users WHERE user_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $user_id);
        return $stmt->execute();
    }

    // Thêm người dùng mới
    public function createUser($username, $email, $password, $full_name, $address, $phone_number, $image_path) {
        $query = "INSERT INTO users (username, email, password_hash, full_name, address, phone_number, image_path) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssssss", $username, $email, $password, $full_name, $address, $phone_number, $image_path);
        return $stmt->execute();
    }
}

class NewsManager {
    private $conn;

    public function __construct($connection) {
        $this->conn = $connection;
    }

    public function countNews() {
        $result = $this->conn->query("SELECT COUNT(*) as total FROM news");
        return $result->fetch_assoc()['total'];
    }

    // Get all news
    public function getAllNews($limit = 10, $offset = 0) {
        $query = "SELECT * FROM news ORDER BY published_date DESC LIMIT ? OFFSET ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $limit, $offset);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    // Get news by ID
    public function getNewsById($news_id) {
        $query = "SELECT * FROM news WHERE news_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $news_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Create news
    public function createNews($title, $content, $author, $published_date) {
        $query = "INSERT INTO news (title, content, author, published_date) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssss", $title, $content, $author, $published_date);
        return $stmt->execute();
    }

    // Update news
    public function updateNews($news_id, $title, $content, $author, $published_date) {
        $query = "UPDATE news SET title = ?, content = ?, author = ?, published_date = ? WHERE news_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssssi", $title, $content, $author, $published_date, $news_id);
        return $stmt->execute();
    }

    // Delete news
    public function deleteNews($news_id) {
        $query = "DELETE FROM news WHERE news_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $news_id);
        return $stmt->execute();
    }
}

class ProductManager {
    private $conn;

    public function __construct($connection) {
        $this->conn = $connection;
    }

    public function countProducts() {
        $result = $this->conn->query("SELECT COUNT(*) as total FROM products");
        return $result->fetch_assoc()['total'];
    }

    public function getAllProducts($limit = 10, $offset = 0) {
        $query = "SELECT * FROM products ORDER BY created_at DESC LIMIT ? OFFSET ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $limit, $offset);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    // Get product by ID
    public function getProductById($product_id) {
        $query = "SELECT * FROM products WHERE product_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Add new product
    public function addProduct($product_name, $product_handle, $description, $price, $category_id, $image_path) {
        $query = "INSERT INTO products (product_name, product_handle, description, price, category_id, image_path) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssdis", $product_name, $product_handle, $description, $price, $category_id, $image_path);
        return $stmt->execute();
    }

    // Update product
    public function updateProduct($product_id, $product_name, $product_handle, $description, $price, $category_id, $image_path) {
        $query = "UPDATE products SET product_name = ?, product_handle = ?, description = ?, price = ?, category_id = ?, image_path = ? WHERE product_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssdisi", $product_name, $product_handle, $description, $price, $category_id, $image_path, $product_id);
        return $stmt->execute();
    }

    // Delete product
    public function deleteProduct($product_id) {
        $query = "DELETE FROM products WHERE product_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $product_id);
        return $stmt->execute();
    }
}

class CartManager {
    private $conn;

    public function __construct($connection) {
        $this->conn = $connection;
    }

    public function countCartItems($user_id) {
        $query = "SELECT COUNT(*) as total FROM cart_items WHERE user_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc()['total'];
    }

    public function getCartItems($user_id) {
        $query = "SELECT ci.quantity, p.product_name, p.product_handle, p.description, p.price, p.compare_price, p.image_path
                  FROM cart_items ci
                  JOIN products p ON ci.product_id = p.product_id
                  WHERE ci.user_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function addCartItem($user_id, $product_id, $quantity) {
        $query = "INSERT INTO cart_items (user_id, product_id, quantity) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("iii", $user_id, $product_id, $quantity);
        return $stmt->execute();
    }

    public function updateCartItem($user_id, $product_id, $quantity) {
        $query = "UPDATE cart_items SET quantity = ? WHERE user_id = ? AND product_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("iii", $quantity, $user_id, $product_id);
        return $stmt->execute();
    }

    public function deleteCartItem($user_id, $product_id) {
        $query = "DELETE FROM cart_items WHERE user_id = ? AND product_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $user_id, $product_id);
        return $stmt->execute();
    }
}
?>