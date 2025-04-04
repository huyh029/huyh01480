<?php
// 1️⃣ Kết nối database
$servername = "localhost";
$username = "root"; // Thay đổi nếu cần
$password = ""; // Thay đổi nếu cần
$database = "projec2";

$conn = new mysqli($servername, $username, $password, $database);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// 2️⃣ Nhận dữ liệu từ URL (GET)
$area = isset($_GET['area']) ? $_GET['area'] : null;
$date = isset($_GET['date']) ? $_GET['date'] : null;
$plant = isset($_GET['plant']) ? str_replace("%", "", $_GET['plant']) : null;
$water = isset($_GET['water']) ? str_replace("%", "", $_GET['water']) : null;
$urban = isset($_GET['urban']) ? str_replace("%", "", $_GET['urban']) : null;
$bareLand = isset($_GET['bareLand']) ? str_replace("%", "", $_GET['bareLand']) : null;
$save = isset($_GET['save']) ? $_GET['save'] : null;

// 3️⃣ Chèn `area` vào bảng `area` nếu chưa tồn tại
if ($area) {
    $sql_check = "SELECT id FROM area WHERE area = '$area'";
    $result = $conn->query($sql_check);

    if ($result->num_rows == 0) {
    // Nếu chưa có, thì thêm mới
    $sql_area = "INSERT INTO area (area) VALUES ('$area')";
    $conn->query($sql_area);
}
}

// 4️⃣ Tạo tên file dựa trên `area` và `date`
$classified = "{$area}_{$date}_classified.png";
$rgb = "{$area}_{$date}_rgb.png";
$band2 = "{$area}_{$date}_band2.tif";
$band3 = "{$area}_{$date}_band3.tif";
$band4 = "{$area}_{$date}_band4.tif";
$band5 = "{$area}_{$date}_band5.tif";
$band6 = "{$area}_{$date}_band6.tif";

// 5️⃣ Kiểm tra dữ liệu và lưu vào bảng `picture`
if ($area && $date && $plant !== null && $water !== null && $urban !== null && $bareLand !== null) {
    $sql_picture = "INSERT INTO picture (area, date, plant, water, urban, bareLand, imgClassified, imgRgb, band2, band3, band4, band5, band6)
                    VALUES ('$area', '$date', '$plant', '$water', '$urban', '$bareLand', '$classified', '$rgb', '$band2', '$band3', '$band4', '$band5', '$band6')";

    if ($conn->query($sql_picture) === TRUE) {
        echo "Dữ liệu đã được lưu thành công!";
    } else {
        echo "Lỗi: " . $sql_picture . "<br>" . $conn->error;
    }
} else {
    echo "Thiếu dữ liệu, vui lòng kiểm tra URL!";
}
function renameFile($old_name, $new_name) {
    return file_exists($old_name) && rename($old_name, $new_name) ? "Đổi tên file thành công!" : "Lỗi khi đổi tên file hoặc file không tồn tại!";
}

echo renameFile("../py/picture/band2.tif", "../picture/data/".$band2);
echo renameFile("../py/picture/band3.tif", "../picture/data/".$band3);
echo renameFile("../py/picture/band4.tif", "../picture/data/".$band4);
echo renameFile("../py/picture/band5.tif", "../picture/data/".$band5);
echo renameFile("../py/picture/band6.tif", "../picture/data/".$band6);
echo renameFile("../picture/result/rgb_image.png", "../picture/data/".$rgb);
echo renameFile("../picture/result/classified_image.png", "../picture/data/".$classified);
$conn->close();
header("location:../index.php");
?>
