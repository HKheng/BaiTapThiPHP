<?php
session_start();
require_once '../../config/database.php';

if (!isset($_SESSION['MaSV'])) {
    header("Location: login.php");
    exit();
}

$MaSV = $_SESSION['MaSV'];

$sql = "SELECT HP.MaHP, HP.TenHP, HP.SoTinChi 
        FROM ChiTietDangKy CTDK
        JOIN DangKy DK ON CTDK.MaDK = DK.MaDK
        JOIN HocPhan HP ON CTDK.MaHP = HP.MaHP
        WHERE DK.MaSV = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $MaSV);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Học Phần Đã Đăng Ký</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 20px;
            text-align: center;
        }
        .container {
            max-width: 600px;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: auto;
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
            border: 1px solid #ddd;
            text-align: center;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Danh sách học phần đã đăng ký</h2>
        <table>
            <tr>
                <th>Mã HP</th>
                <th>Tên HP</th>
                <th>Số tín chỉ</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()) : ?>
            <tr>
                <td><?= htmlspecialchars($row['MaHP']) ?></td>
                <td><?= htmlspecialchars($row['TenHP']) ?></td>
                <td><?= htmlspecialchars($row['SoTinChi']) ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>
