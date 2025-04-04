<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>xử lý</title>
    <link rel="icon" href="../picture/icon.png">
    <link rel="stylesheet" href="../css/handle.css">
</head>
<body>
    

<?php
// Kiểm tra các hàm bị vô hiệu hóa
echo ini_get('disable_functions');

// Định nghĩa thư mục lưu trữ ảnh và các loại file được phép
$upload_dir = '../py/picture/';
$allowed_file_types = ['image/tiff', 'image/x-tiff'];

// Kiểm tra và tạo thư mục nếu chưa tồn tại
if (!file_exists($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

// Mảng để lưu tên các file đã upload
$uploaded_files = [];

// Danh sách các band cần upload
$bands = ['band2', 'band3', 'band4', 'band5', 'band6'];

// Lặp qua từng band và xử lý upload
foreach ($bands as $band) {
    if (isset($_FILES[$band]) && $_FILES[$band]['error'] == 0) {
        // Kiểm tra kiểu file
        if (!in_array($_FILES[$band]['type'], $allowed_file_types)) {
            echo "Chỉ chấp nhận file TIFF!";
            exit;
        }

        // Di chuyển file vào thư mục đích với tên mới
        $target_file = $upload_dir . $band . '.tif';
        if (!move_uploaded_file($_FILES[$band]['tmp_name'], $target_file)) {
            echo "Có lỗi khi upload file $band.";
            exit;
        }
        $uploaded_files[$band] = $target_file;
    } else {
        echo "File $band không được tải lên hoặc có lỗi.";
        exit;
    }
}

// Nếu tất cả các file đã được upload thành công, gọi Python để xử lý
if (count($uploaded_files) === 5) {
    // Đường dẫn đến file Python
    $python_script_path = '../py/handle.py';

    // Tạo lệnh CMD để gọi Python và truyền các file vào làm tham số
    $command = 'python ' . $python_script_path . ' ';

    // Hiển thị lệnh CMD sắp thực thi

    // Chạy lệnh CMD và kết hợp stdout và stderr để kiểm tra cả đầu ra và lỗi
    $output = shell_exec($command . ' 2>&1');

    echo '
    <div style="display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
">
    <img style="
    width: 100%;!important
    object-fit: cover;
    " src="../picture/result/rgb_image.png" alt="">
    <img
    style="width: 100%;!important
    object-fit: cover;
    " src="../picture/result/classified_image.png" alt="">
    </div>
    ';

} else {
    echo "Cần upload đủ 5 file band!";
}
?>
<?php
$file_path = "C:/xampp/htdocs/Project2/py/path.txt";

// Kiểm tra xem file có tồn tại không
if (file_exists($file_path)) {
    // Đọc nội dung file
    $lines = file($file_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    
    // Mảng tên các loại địa hình
    $name = ['thực vật', "nước", 'đô thị', 'đất trống'];
    $nameData = ['plant','water','urban','bareLand'];
    $colors = ['green', 'blue', 'red', 'yellow'];
    echo '<form action="../database/add.php" method="GET">';
    echo '<lable>Khu vực</lable><input type="text" name="area">';
    echo '<lable>Thời điểm</lable><input type="date" name="date">';
    // Duyệt từng dòng trong file và hiển thị vào bảng
    foreach ($lines as $index => $line) {
        $color = $colors[$index];
        // Hiển thị nhãn và giá trị với index từ mảng $name
        echo '<label><span style="display: inline-block; width: 30px; height: 15px; background-color: ' . $color . '; margin-right: 10px;"></span>' . $name[$index] . '</label><input name="'.$nameData[$index].'" value="' . htmlspecialchars($line) . '%">';
    }
    echo '<input type="button" value="Thoát" id="cancel" >';
    echo '<input type="submit" value="Lưu" name="save" >';
    echo '</form>';
} else {
    echo "<p>Không tìm thấy file dữ liệu!</p>";
}
?>
</body>
<script src="../js/handle.js">

</script>
</html>