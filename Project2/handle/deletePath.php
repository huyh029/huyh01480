<?php
$files = [
    "../py/picture/band2.tif",
    "../py/picture/band3.tif",
    "../py/picture/band4.tif",
    "../py/picture/band5.tif",
    "../py/picture/band6.tif",
    "../picture/result/classified_image.png",
    "../picture/result/rgb_image.png"
];

foreach ($files as $file) {
    if (file_exists($file)) {
        unlink($file);
        echo "Đã xóa: $file <br>";
    } else {
        echo "Không tìm thấy: $file <br>";
    }
}
header("location:../index.php");
?>
