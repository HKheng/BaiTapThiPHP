<?php
// File: views/admin/dashboard.php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
require_once '../../config/database.php';
$students = $conn->query("SELECT * FROM SinhVien");
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            height: 100vh;
            margin: 0;
            background-color: #f8f9fa;
        }
        .sidebar {
            width: 200px;
            background: #007bff;
            color: white;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            margin: 10px 0;
            padding: 10px;
            display: block;
            text-align: center;
            width: 100%;
            border-radius: 5px;
        }
        .sidebar a:hover {
            background: #0056b3;
        }
        .container {
            flex: 1;
            padding: 20px;
            background: white;
            border-radius: 10px;
            margin: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }
        th {
            background: #007bff;
            color: white;
        }
        tr:hover {
            background: #f1f1f1;
        }
        .btn {
            padding: 8px 12px;
            background: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            text-align: center;
        }
        .btn:hover {
            background: #218838;
        }
        .logout {
            background: red;
            margin-top: auto;
        }
        .logout:hover {
            background: darkred;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h3>Admin</h3>
        <a href="hocphan.php">Quản lý Học Phần</a>
        <a href="dangkyhocphan.php">Quản lý Đăng Ký</a>
        <a href="logout.php" class="logout">Đăng xuất</a>
    </div>
    
    <div class="container">
        <h2>Danh sách Sinh Viên</h2>
        <a href="add_student.php" class="btn">Thêm Sinh Viên</a>
        <table>
            <tr>
                <th>Mã SV</th>
                <th>Họ Tên</th>
                <th>Giới Tính</th>
                <th>Ngày Sinh</th>
                <th>Ảnh</th>
                <th>Hành động</th>
            </tr>
            <?php while ($student = $students->fetch_assoc()): ?>
                <tr>
                    <td><?= $student['MaSV'] ?></td>
                    <td><?= $student['HoTen'] ?></td>
                    <td><?= $student['GioiTinh'] ?></td>
                    <td><?= $student['NgaySinh'] ?></td>
                    <td>
                        <?php if (!empty($student['Hinh'])): ?>
                            <img src="../../public/uploads/<?= $student['Hinh'] ?>" width="50">
                        <?php else: ?>
                            Chưa có ảnh
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="edit.php?id=<?= $student['MaSV'] ?>" class="btn">Sửa</a>
                        <a href="delete.php?id=<?= $student['MaSV'] ?>" class="btn" style="background: red;" onclick="return confirm('Xóa sinh viên này?')">Xóa</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>
