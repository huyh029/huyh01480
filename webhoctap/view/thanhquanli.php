<?php
include"../model/sql.php";
$user=$_SESSION['user'];
$sql="SELECT * FROM thongtinchitiet WHERE user='$user'";
$result=ketnoivoisql($sql);
$row=mysqli_fetch_array($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        *{
            margin: 0;
            padding: 0;
        }
        .background-video{
            width: 100%;
            height: 130px;
            object-fit: cover;
            z-index: -1;
            position: absolute;
        }
        .avata{
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background-image: url("../picture/avata/<?php if($row['avata']==="")echo "macdinh.jpg";else echo $row['avata']; ?>");   /*-------------avata--------------------*/
            background-size:100%;
        }
        .dropdown{
            background-color: white;
            box-shadow: 1px 1px 5px black;
            width: 150px;
            position: absolute;
            display: none;
        }
        .dropdown a{
            display: block;
            color: rgb(0, 0, 0);
            font-size: 18px;
            padding: 14px 16px;
            text-decoration: none;
        }
        .dropdown a:hover{
            background-color: #f1f1f1;
        }
        .Content:hover .dropdown{
            display: block;
        }
        .loichao{
            color: white;
            margin-right: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .thanhquanli{
            display: flex;
            flex-direction: row;
            justify-content: end;
            align-items: center;
            height: 130px;
        }
        .Content{
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="thanhquanli">
        <video src="../video/moman.mov" type="video/mp4" class="background-video" autoplay muted loop></video>
        <div class="Content">
        <div class="avata">

        </div>
        <div class="dropdown">
            <a href="index.php?this_page=trangchu">HOME</a>
            <a href="index.php?this_page=hoso">HỒ SƠ</a>
            <a href="../controller/dangxuat.php">ĐĂNG XUẤT</a>
        </div>
        </div>
        <div class="loichao">
            <h4>--chào mừng bạn trở lại--</h4>
            <h3>--<?php echo $user;?>--</h3>            <!------------------------user----------------------->
        </div>
    </div>
</body>
</html>