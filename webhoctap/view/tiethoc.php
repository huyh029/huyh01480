<?php

include"../model/sql.php";
$key=$_GET['this_id'];
$id=explode("|",$key);
$monhoc=$id[0];
$diachi=$id[1];
$sql="SELECT * FROM $monhoc WHERE id='$diachi'";
$result=ketnoivoisql($sql);
$row=mysqli_fetch_array($result);
?>
<form action="../controller/xulythembaihoc.php" method="post" enctype="multipart/form-data">
    <input type="text" name="tenbai" value="<?php echo $key; ?>" style="display:none;">
    <?php if($row['img']!==""){ ?>
    <img src="../picture/anhnoidungmonhoc/<?php echo $row['img'];?>" width="150px" style="object-fit:cover;">
    <?php } ?>
    <input type="submit" name="xoaanh" value="xóa ảnh">
    <br>
    <label>nội dung</label>
    <br>
    <textarea name="noidung" rows="15" cols="40" ><?php echo $row['noidung']; ?></textarea>
    <br>
    <label>ảnh mở đầu</label>
    <br>
    <input type="file" name="img"  style="padding:10px; font-size:20px;">
    <br>
    <input type="submit" name="sub" value="lưu" style="padding:10px; font-size:20px;">
</form>
<?php
$sql_trove="SELECT * FROM baihoc WHERE tenbai='$monhoc' ";
$result_trove=ketnoivoisql($sql_trove);
$row_trove=mysqli_fetch_array($result_trove);
?>
<a href="chitiet.php?this_tenbai=<?php echo $row_trove['id']; ?>" style="font-size:25px;">trở về</a>