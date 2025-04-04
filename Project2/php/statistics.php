<?php
// 1️⃣ Kết nối MySQL
$servername = "localhost";
$username = "root";
$password = "";
$database = "projec2";

$conn = new mysqli($servername, $username, $password, $database);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// 2️⃣ Lấy danh sách `area`
$sql_area = "SELECT * FROM area";
$result_area = $conn->query($sql_area);

$tree = [];

// 3️⃣ Duyệt từng `area` để lấy dữ liệu `picture`
if ($result_area->num_rows > 0) {
    while ($row_area = $result_area->fetch_assoc()) {
        $area_name = $row_area['area'];
        
        // Truy vấn lấy danh sách ảnh & dữ liệu statistics thuộc `area`
        $sql_pictures = "SELECT * FROM picture WHERE area = '$area_name' ORDER BY date DESC";
        $result_pictures = $conn->query($sql_pictures);
        
        $tree[$area_name] = []; // Tạo mảng cha cho `area`
        
        while ($row_picture = $result_pictures->fetch_assoc()) {
            $date = $row_picture['date'];
            $formatted_date = date("d/m/Y", strtotime($date)); // Định dạng lại ngày

            // Lưu dữ liệu thống kê vào cây
            $tree[$area_name][$date] = [
                "time" => $formatted_date, // Thêm thời gian vào mảng
                "water" => $row_picture['water'],
                "plant" => $row_picture['plant'],
                "urban" => $row_picture['urban'],
                "bareLand" => $row_picture['bareLand']
            ];
        }
    }
}

// 4️⃣ Đóng kết nối
$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thống kê</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        ul { list-style-type: none; }
        li { margin: 5px 0; }
        .area {
            font-weight: bold; 
            font-size: 20px; 
            color: blue; 
            margin-top: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table, th, td {
            border: 1px solid black;
            text-align: center;
        }
        th, td {
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h2>📊 Dữ Liệu Thống Kê</h2>
<ul>
    <?php foreach ($tree as $area => $dates): ?>
        <li class="area">📍 <?= $area ?></li>
        <table>
            <tr>
                <th>Thời Gian</th>
                <th>Nước (%)</th>
                <th>Thực Vật (%)</th>
                <th>Đất Trống (%)</th>
                <th>Đô Thị (%)</th>
            </tr>
            <?php foreach ($dates as $date => $data): ?>
                <tr>
                    <td><?= $data['time'] ?></td>
                    <td><?= $data['water'] ?>%</td>
                    <td><?= $data['plant'] ?>%</td>
                    <td><?= $data['bareLand'] ?>%</td>
                    <td><?= $data['urban'] ?>%</td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endforeach; ?>
</ul>

</body>
</html>
