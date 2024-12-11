<?php
session_start();
require_once 'C:/xampp/htdocs/Fujifilm_Shop/admin/config/connect.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: /Fujifilm_Shop/admin/login.php");
    exit();
}

$db = new Database();
$conn = $db->getConnection();
$user_id = $_SESSION['user_id'];

if (isset($_GET['id'])) {
    $address_id = (int)$_GET['id'];
    $query = "SELECT * FROM addresses WHERE address_id = ? AND user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $address_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $address = $result->fetch_assoc();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $label = $_POST['label'];
        $full_name = $_POST['full_name'];
        $address_text = $_POST['address'];
        $phone_number = $_POST['phone_number'];

        $query = "UPDATE addresses SET label = ?, full_name = ?, address = ?, phone_number = ? WHERE address_id = ? AND user_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssssii", $label, $full_name, $address_text, $phone_number, $address_id, $user_id);
        if ($stmt->execute()) {
            header("Location: /Fujifilm_Shop/page/account/addresses.php");
            exit();
        } else {
            $error = "Failed to update address.";
        }
    }
} else {
    header("Location: /Fujifilm_Shop/page/account/addresses.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Address</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Address</h2>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>
        <form method="post">
            <div class="mb-3">
                <label for="label" class="form-label">Label</label>
                <input type="text" class="form-control" id="label" name="label" value="<?= htmlspecialchars($address['label']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="full_name" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="full_name" name="full_name" value="<?= htmlspecialchars($address['full_name']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <textarea class="form-control" id="address" name="address" required><?= htmlspecialchars($address['address']) ?></textarea>
            </div>
            <div class="mb-3">
                <label for="phone_number" class="form-label">Phone Number</label>
                <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?= htmlspecialchars($address['phone_number']) ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Address</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>