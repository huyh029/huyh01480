<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../picture/icon.png">
    <link rel="stylesheet" href="../css/index.css">
</head>
<body>
    <ul class="menu">
        <a href="index.php?status=home"><li class="home">Trang chủ</li></a>
        <a href="index.php?status=picture"><li class="picture">Ảnh</li></a>
        <a href="index.php?status=import"><li class="import">Tải lên</li></a>
        <a href="index.php?status=statistics"><li class="statistics">Thống kê</li></a>
    </ul>
    <div class="content">
    <?php
    if(isset($_GET['status'])){
        if($_GET['status']=='home'){
            include("home.php");
        }else if($_GET['status']=='picture'){
            include("picture.php");
        }else if($_GET['status']=='import'){
            include("import.php");
        }else if($_GET['status']=='statistics'){
            include("statistics.php");
        }else {
            header("location:index.php?status=home");
        }
    }else{
        header("location:index.php?status=home");
    }
    ?>
    </div>
</body>
</html>