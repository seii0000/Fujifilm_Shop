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
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO users (username, email, password_hash, full_name, address, phone_number, image_path) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssssss", $username, $email, $hashed_password, $full_name, $address, $phone_number, $image_path);
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

?>