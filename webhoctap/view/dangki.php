<?php
include"../model/sql.php";
$loichao="chào mừng bạn trở lại";
$color="black";
if(isset($_POST['sub']))
{
$name=$_POST['name'];
$pass=$_POST['pass'];
$xnpass=$_POST['xn'];
if($pass===$xnpass&&$name!==""&&$pass!=="")
{
$sql="SELECT * FROM taikhoan WHERE tendangnhap='$name' AND matkhau='$pass' ";
$result=ketnoivoisql($sql);
if(mysqli_num_rows($result)> 0)
{
   $loichao="đã có tài khoản này";
   $color="red";
}
else
{
    themdulieuvao_taikhoan("",$name,$pass);
    themdulieuvao_thongtinchitiet("",$name,"","","","","");
    header('location:dangnhap.php');
}

}
else
{
    $loichao="mật khẩu không khớp!";
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
          
            text-shadow: 1px 1px 10px black;
        }
        body{
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .dangnhap{
            width: 450px;
            height: 400px;
            background-color: rgba(255, 255, 0, 0.2);
            border: 1px solid white;
            box-shadow: 1px 1px 30px yellow;
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
        .sub{
            font-size: 18px;
            margin-top: 25px;
            width: 300px;
            height: 40px;
            background-color: yellow;
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
    <video src="../video/dangki.mov" type="video/mp4" autoplay muted loop class="bg_video"></video>
    <form action="dangki.php" method="post" class="dangnhap">
        <label class="loichao"><?php echo $loichao; ?></label>
        <label class="name">--tên đăng nhập--</label>
        <input class="box" type="text" name="name">
        <label class="name">--mật khẩu--</label>
        <input class="box" type="password" name="pass">
        <label class="name">--xác nhận mật khẩu--</label>
        <input class="box" type="password" name="xn">
        <input class="sub" type="submit" value="bắt đầu" name="sub">
    </form>
</body>
</html>