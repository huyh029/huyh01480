<?php

include"../model/sql.php";
$name=$_GET['this_tenbai'];
$sql="SELECT * FROM baihoc WHERE id='$name' ";
$result=ketnoivoisql($sql);
$row=mysqli_fetch_array($result);
include"../controller/thehoctap.php";
thebai($row['tenbai'],$row['img']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>chi tiết</title>
    <style>
        ul.danhsachtiethoc{
            list-style-type: none;
            width: 300px;
        }
        ul.danhsachtiethoc li
        {
            padding:50px 60px;
        }
        ul.danhsachtiethoc li a{
            font-size: 20px;
            color: black;
            text-decoration: none;
        }
        ul.danhsachtiethoc li:hover
        {
            background-color: #f1f1f1;
        }
        body{
            display: flex;
            flex-direction: row;
        }
    </style>
</head>
<body>
    <div>
      <form action="../controller/xulytiethoc.php" method="POST" enctype="multipart/form-data">
    <input type="text" name="id" value="<?php echo $row['id'];?>" style="display:none;">
    <input type="text" name="Img" value="<?php echo $row['img'];?>" style="display:none;">
    <input type="text" name="oldname" value="<?php echo $row['tenbai'];?>" style="display:none;">
      <label style="font-size: 30px">tên môn học</label>
      <input type="text" name="tenmonhoc" style="padding:10px 50px; font-size:25px;" value="<?php echo $row['tenbai']; ?>">
      <br>
      <label style="font-size: 30px">sửa avata</label>
      <input type="file" name="img" value="chọn ảnh" style="padding:10px 50px;font-size:25px;"> 
        <input type="submit" name="xoaanh" value="xóa ảnh" style="padding:10px;font-size:25px;">
      <br>
        <label style="font-size: 30px">thêm bài học</label>
        <input type="text" name="name" style="padding:10px 50px;font-size:25px;">
        <br>
        <label style="font-size: 30px">xóa bài học</label>
        <input type="text" name="dele" style="padding:10px 50px;font-size:25px;">
        <br>
        <input type="submit" value="xóa tất cả bài học" name="deall" style="padding 30px;font-size:25px">
        <input type="submit" value="gửi" name="sub" style="padding 30px;font-size:25px;">
    </form>
    <a href="bangbaihoc.php"  style="padding 30px;font-size:25px;">quay lại</a>
    <?php
        $monhoc=$row['tenbai'];
        $sql_tiethoc="SELECT * FROM $monhoc ";
        $resuil_tiethoc=ketnoivoisql($sql_tiethoc);
        if(mysqli_num_rows($resuil_tiethoc)>0)
        {
            
            ?>
            <ul class="danhsachtiethoc">
            <?php
            while($row_tiethoc=mysqli_fetch_array($resuil_tiethoc))
            {
                ?>
                <li><a href="tiethoc.php?this_id=<?php echo$monhoc."|".$row_tiethoc['id']; ?>"><?php echo $row_tiethoc['tenbai']; ?></a></li>
                <?php
            }
            ?>
            </ul>
            <?php
        }
?>
    </div>
        
</body>
</html>
