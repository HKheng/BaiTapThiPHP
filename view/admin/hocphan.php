<?php
session_start();
require_once '../../config/database.php';

// Kiểm tra nếu không phải admin, chuyển hướng về trang đăng nhập
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

// Truy vấn danh sách học phần
$sql = "SELECT * FROM HocPhan";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Học Phần</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #eef2f7;
            text-align: center;
            margin: 0;
            padding: 20px;
        }
        .container {
            width: 90%;
            max-width: 900px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin: auto;
        }
        h2 {
            color: #333;
            margin-bottom: 15px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
        }
        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .btn {
            display: inline-block;
            padding: 8px 14px;
            text-decoration: none;
            color: white;
            border-radius: 6px;
            margin: 4px;
            font-size: 14px;
            transition: 0.3s;
        }
        .btn-add {
            background: #28a745;
        }
        .btn-edit {
            background: #ffc107;
            color: #333;
        }
        .btn-delete {
            background: #dc3545;
        }
        .btn:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Quản Lý Học Phần</h2>
        <a href="add_hocphan.php" class="btn btn-add">➕ Thêm Học Phần</a>
        <table>
            <tr>
                <th>Mã Học Phần</th>
                <th>Tên Học Phần</th>
                <th>Số Tín Chỉ</th>
                <th>Số Lượng Dự Kiến</th>
                <th>Hành Động</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['MaHP'] ?></td>
                <td><?= htmlspecialchars($row['TenHP']) ?></td>
                <td><?= $row['SoTinChi'] ?></td>
                <td><?= $row['SoLuongDuKien'] ?></td>
                <td>
                    <a href="edit_hocphan.php?id=<?= $row['MaHP'] ?>" class="btn btn-edit">✏️ Sửa</a>
                    <a href="delete_hocphan.php?id=<?= $row['MaHP'] ?>" class="btn btn-delete" onclick="return confirm('Bạn có chắc chắn muốn xóa?');">🗑️ Xóa</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>

