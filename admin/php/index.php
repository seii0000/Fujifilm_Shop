<?php
include 'connect.php';
if ($conn){
    echo "Kết nối thành công";
} else {
    echo "Kết nối thất bại";
}

$sql = "SELECT * FROM categories";
$stmt = $conn->prepare($sql);
$stmt->execute();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>TEST PDO</title>
</head>
<body>
    <button><a href="add_student.php">THÊM THỂ LOẠI</a></button>
    <div class="containter">
        <table class="table table-inverse">
            <tr>
                <th>Mã sinh viên</th>
                <th>Họ tên</th>
                <th>Điểm</th>
                <th>Thao tác</th>
            </tr>
        </table>
    </div>
</body>
</html>