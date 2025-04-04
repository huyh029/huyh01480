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
        
        // Truy vấn lấy danh sách ảnh thuộc `area`
        $sql_pictures = "SELECT * FROM picture WHERE area = '$area_name' ORDER BY date DESC";
        $result_pictures = $conn->query($sql_pictures);
        
        $tree[$area_name] = []; // Tạo mảng cha cho `area`
        
        while ($row_picture = $result_pictures->fetch_assoc()) {
            $date = $row_picture['date'];
            $formatted_date = date("d/m/Y", strtotime($date)); // Định dạng lại ngày

            // Tạo danh sách ảnh theo ngày
            $tree[$area_name][$date] = [
                "time" => $formatted_date, // Thêm thời gian vào mảng
                "classified" => '../picture/data/'.$row_picture['imgClassified'],
                "rgb" => '../picture/data/'.$row_picture['imgRgb'],
                "band2" => '../picture/data/'.$row_picture['band2'],
                "band3" => '../picture/data/'.$row_picture['band3'],
                "band4" => '../picture/data/'.$row_picture['band4'],
                "band5" => '../picture/data/'.$row_picture['band5'],
                "band6" => '../picture/data/'.$row_picture['band6']
            ];
        }
    }
}

// 4️⃣ Đóng kết nối
$conn->close();

// 5️⃣ Hàm kiểm tra file TIFF và chuyển sang iframe Google Viewer nếu cần
function displayImage($imagePath) {
    $ext = pathinfo($imagePath, PATHINFO_EXTENSION);
    
    if ($ext === "tif" || $ext === "tiff") {
        return "<a href='$imagePath' target='_blank'>Xem TIFF</a> | <a href='$imagePath' download>Tải về</a>";
    } else {
        return "<img src='$imagePath' width='150'>";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách ảnh</title>
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

<h2>📁 Dữ Liệu Ảnh</h2>
<ul>
    <?php foreach ($tree as $area => $dates): ?>
        <li class="area">📍 <?= $area ?></li>
        <?php foreach ($dates as $date => $images): ?>
            <table>
                <tr>
                    <th>Thời Gian</th>
                    <th>Classified</th>
                    <th>RGB</th>
                    <th>Band 2</th>
                    <th>Band 3</th>
                    <th>Band 4</th>
                    <th>Band 5</th>
                    <th>Band 6</th>
                </tr>
                <tr>
                    <td><?= $images['time'] ?></td>
                    <td><?= displayImage($images['classified']) ?></td>
                    <td><?= displayImage($images['rgb']) ?></td>
                    <td><?= displayImage($images['band2']) ?></td>
                    <td><?= displayImage($images['band3']) ?></td>
                    <td><?= displayImage($images['band4']) ?></td>
                    <td><?= displayImage($images['band5']) ?></td>
                    <td><?= displayImage($images['band6']) ?></td>
                </tr>
            </table>
        <?php endforeach; ?>
    <?php endforeach; ?>
</ul>

</body>
</html>
