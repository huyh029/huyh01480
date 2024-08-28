<?php
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
        .hoso{
            width: 800px;
            height: 500px;
            display: flex;
            flex-direction: row;
            background-color: rgba(255, 255, 0, 0.205);
            align-items: center;
            border: 1px solid rgb(255, 255, 255);
            box-shadow: 1px 1px 20px yellow;
            border-radius: 30px;
        }
        .AVATA{
            width: 400px ;
            height: 400px;
            border-radius: 50%;
            background-image: url("../picture/avata/<?php if($row['avata']==="")echo "macdinh.jpg";else echo $row['avata']; ?>");
            background-size: 100%;
            margin-left: 50px;
            margin-right: 40px;
            box-shadow: 1px 1px 20px white;
        }
        .CONTENT{
            color: white;
            text-shadow: 1px 1px 10px white;
           
           
            font-size: 20px;
        }
        .bg-clip{
            height: 75vh;
            width: 100%;
            object-fit: cover;
            z-index: -1;
            position: absolute;
        }
        .body{
            display:flex;
            align-items: center;
            justify-content: center;
            height: 75vh;
            
        }
        .BOX{
            width: 250px;
            height:30px;
            color: white;
            font-size: 20px;
            background: none;
            border: none;
        }
    </style>
</head>
<body>
    <div class="body">
    <video src="../video/dangki.mov" type="video/mp4" autoplay muted loop class="bg-clip"></video>
    <div class="hoso">
    
    <div class="AVATA">

    </div>
        <form action="../controller/xulyhoso.php" method="post" class="CONTENT" enctype="multipart/form-data">
        <label>Họ tên: </label>
        <input type="text" class="BOX" value="<?php echo $row['hoten']; ?>" name="hoten">
        <br>
        <label>Sinh nhật:</label>
        <input type="date" class="BOX" value="<?php echo $row['ngaysinh']; ?>" name="date">
        <br>
        <label>Email:</label>
        <input type="text" class="BOX" value="<?php echo $row['email']; ?>" name="email">
        <br>
        <label>ĐT:</label>
        <input type="text" class="BOX" value="<?php echo $row['sodienthoai']; ?>" name="sdt">
        <br>
        <label>Cập Nhật Avata:</label>
        <input type="file"  name="img" class="BOX" style="color:none;">
        <br>
        <input type="submit" value="cập nhật hồ sơ" class="BOX" style="text-decoration: underline;" name="sub">
        </form>
    </div>
    </div>
</body>
</html>