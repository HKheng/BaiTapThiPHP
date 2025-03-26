<?php
session_start();
require_once '../../config/database.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $MaHP = $_POST['MaHP'];
    $TenHP = $_POST['TenHP'];
    $SoTinChi = $_POST['SoTinChi'];
    $SoLuongDuKien = $_POST['SoLuongDuKien'];

    $sql = "INSERT INTO HocPhan (MaHP, TenHP, SoTinChi, SoLuongDuKien) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssii", $MaHP, $TenHP, $SoTinChi, $SoLuongDuKien);
    
    if ($stmt->execute()) {
        header("Location: hocphan.php");
    } else {
        echo "Lỗi khi thêm học phần.";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Học Phần</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #eef2f7;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            width: 350px;
            text-align: center;
        }
        h2 {
            color: #4a90e2;
        }
        .input-group {
            margin: 10px 0;
            text-align: left;
        }
        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .btn {
            width: 100%;
            padding: 10px;
            background: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }
        .btn:hover {
            background: #218838;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Thêm Học Phần</h2>
        <form method="POST">
            <div class="input-group">
                <label>Mã Học Phần:</label>
                <input type="text" name="MaHP" required>
            </div>
            <div class="input-group">
                <label>Tên Học Phần:</label>
                <input type="text" name="TenHP" required>
            </div>
            <div class="input-group">
                <label>Số tín chỉ:</label>
                <input type="number" name="SoTinChi" required>
            </div>
            <div class="input-group">
                <label>Số lượng dự kiến:</label>
                <input type="number" name="SoLuongDuKien" required>
            </div>
            <button type="submit" class="btn">Thêm Học Phần</button>
        </form>
    </div>
</body>
</html>

