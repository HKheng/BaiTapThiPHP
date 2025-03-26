<?php
// File: views/admin/edit.php
session_start();
require_once '../../config/database.php';

// Kiểm tra nếu không phải admin, chuyển hướng về trang đăng nhập
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

// Kiểm tra nếu có ID sinh viên được truyền vào
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Không tìm thấy ID sinh viên.");
}

$MaSV = $_GET['id'];

// Truy vấn thông tin sinh viên
$sql = "SELECT * FROM SinhVien WHERE MaSV = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $MaSV);
$stmt->execute();
$result = $stmt->get_result();

// Kiểm tra nếu không tìm thấy sinh viên
if ($result->num_rows === 0) {
    die("Sinh viên không tồn tại.");
}

// Lấy dữ liệu sinh viên
$student = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh Sửa Sinh Viên</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            width: 320px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        .input-group {
            margin-bottom: 15px;
        }
        label {
            font-size: 14px;
            color: #555;
        }
        input, select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .btn {
            width: 100%;
            padding: 10px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn:hover {
            background: #0056b3;
        }
        .image-preview {
            text-align: center;
            margin: 10px 0;
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 10px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Chỉnh Sửa Sinh Viên</h2>
        <form action="update_student.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="MaSV" value="<?= $student['MaSV'] ?>">
            
            <div class="input-group">
                <label>Họ Tên:</label>
                <input type="text" name="HoTen" value="<?= htmlspecialchars($student['HoTen']) ?>" required>
            </div>
            
            <div class="input-group">
                <label>Giới Tính:</label>
                <select name="GioiTinh">
                    <option value="Nam" <?= ($student['GioiTinh'] == 'Nam') ? 'selected' : '' ?>>Nam</option>
                    <option value="Nữ" <?= ($student['GioiTinh'] == 'Nữ') ? 'selected' : '' ?>>Nữ</option>
                </select>
            </div>
            
            <div class="input-group">
                <label>Ngày Sinh:</label>
                <input type="date" name="NgaySinh" value="<?= $student['NgaySinh'] ?>" required>
            </div>

            <div class="image-preview">
                <?php if (!empty($student['Hinh'])): ?>
                    <img src="../../public/uploads/<?= $student['Hinh'] ?>" width="100" style="border-radius: 5px;"><br>
                <?php else: ?>
                    <p>Chưa có ảnh</p>
                <?php endif; ?>
            </div>

            <div class="input-group">
                <label>Chọn Ảnh Mới:</label>
                <input type="file" name="Hinh">
            </div>

            <button type="submit" class="btn">Cập Nhật</button>
        </form>
        <a href="dashboard.php" class="back-link">Quay lại Dashboard</a>
    </div>
</body>
</html>