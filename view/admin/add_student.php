<?php
// File: views/admin/add_student.php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../../config/database.php';

// Kiểm tra nếu không phải admin, chuyển hướng về trang đăng nhập
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Sinh Viên</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 350px;
        }
        h2 {
            color: #333;
            margin-bottom: 10px;
        }
        .input-group {
            margin: 10px 0;
            text-align: left;
        }
        input, select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            outline: none;
        }
        .btn {
            width: 100%;
            padding: 10px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: 0.3s;
        }
        .btn:hover {
            background: #0056b3;
        }
        .error {
            color: red;
            margin-bottom: 10px;
        }
        a {
            display: block;
            margin-top: 10px;
            text-decoration: none;
            color: #007bff;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Thêm Sinh Viên</h2>
        <?php if (isset($_SESSION['error'])): ?>
            <p class="error"><?= $_SESSION['error'] ?></p>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
        <form action="process_add_student.php" method="POST" enctype="multipart/form-data">
            <div class="input-group">
                <label>Mã SV:</label>
                <input type="text" name="MaSV" required>
            </div>
            <div class="input-group">
                <label>Họ Tên:</label>
                <input type="text" name="HoTen" required>
            </div>
            <div class="input-group">
                <label>Giới Tính:</label>
                <select name="GioiTinh" required>
                    <option value="Nam">Nam</option>
                    <option value="Nữ">Nữ</option>
                </select>
            </div>
            <div class="input-group">
                <label>Ngày Sinh:</label>
                <input type="date" name="NgaySinh" required>
            </div>
            <div class="input-group">
                <label>Ảnh:</label>
                <input type="file" name="Hinh">
            </div>
            <button type="submit" class="btn">Thêm Sinh Viên</button>
        </form>
        <a href="dashboard.php">Quay lại Dashboard</a>
    </div>
</body>
</html>
