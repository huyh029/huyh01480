<?php
session_start();
if(isset($_SESSION['user']))
{
    header('location:index.php');
}
include"../model/sql.php";
$loichao="chào mừng bạn trở lại";
$color="white";
if(isset($_POST['sub']))
{
$name=$_POST['name'];
$pass=$_POST['pass'];

$sql="SELECT * FROM taikhoan WHERE tendangnhap='$name' AND matkhau='$pass' ";
$result=ketnoivoisql($sql);
if(mysqli_num_rows($result)> 0)
{
    session_start();
    $_SESSION['user']=$name;
    header("location:index.php");
}
else
{
    $loichao="tài khoản mật khẩu sai!";
    $color="red";
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>đăng nhập</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            color: white;
            text-shadow: 1px 1px 10px white;
        }
        .hotro a{
            color: white;
            text-shadow: 1px 1px 10px white;
        }
        body{
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .dangnhap{
            width: 450px;
            height: 350px;
            background-color: rgba(0, 0, 0, 0.268);
            border-radius: 50px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .loichao{
            margin-top: 40px;
            margin-bottom: 10px;
            font-size: 35px;
            color: <?php echo $color; ?>;
            text-shadow: 1px 1px 10px <?php echo $color; ?>;
        }
        .name{
            font-size: 20px;
            margin-top: 10px;
        }
        .box{
            width: 300px;
            height: 30px;
            color: black;
        }
        .hotro{
            display: flex;
            justify-content: space-between;
            width: 300px;
        }
        .sub{
            font-size: 18px;
            margin-top: 25px;
            width: 300px;
            height: 40px;
            background-color: black;
            border: none;
        }
        .bg_video{
            width: 100%;
            height: 100vh;
            object-fit: cover;
            z-index: -1;
            position: absolute;
        }
    </style>
</head>
<body>
    <video src="../video/thanhquanli.mp4" type="video/mp4" autoplay muted loop class="bg_video"></video>
    <form action="dangnhap.php" method="post" class="dangnhap">
        <label class="loichao"><?php echo $loichao; ?></label>
        <label class="name">--tên đăng nhập--</label>
        <input class="box" type="text" name="name">
        <label class="name">--mật khẩu--</label>
        <input class="box" type="password" name="pass">
        <label class="hotro">
            <a href="">quên mật khẩu</a>
            <a href="dangki.php">đăng kí</a>
        </label>
        <input class="sub" type="submit" value="bắt đầu" name="sub">
    </form>
</body>
</html>