<?php
include"connect.php";

function ketnoivoisql($name)
{
   return mysqLi_query($GLOBALS['conn'],$name);
}

function themdulieuvao_taikhoan($id,$tendangnhap,$matkhau)
{
    $sql="INSERT INTO taikhoan(id,tendangnhap,matkhau) VALUES('$id','$tendangnhap','$matkhau')";
    ketnoivoisql($sql);
}

function themdulieuvao_thongtinchitiet($id,$user,$hoten,$ngaysinh,$email,$sodienthoai,$avata)
{
    $sql="INSERT INTO thongtinchitiet(id,user,hoten,ngaysinh,email,sodienthoai,avata) VALUES('$id','$user','$hoten','$ngaysinh','$email','$sodienthoai','$avata')";
    ketnoivoisql($sql);
}

function themdulieuvao_baihoc($id,$tenbai,$img)
{
    $sql="INSERT INTO baihoc(id,tenbai,img) VALUES('$id','$tenbai','$img')";
    ketnoivoisql($sql); 
}

function suadulieu_baihoc($id,$tenbai,$img)
{
    $sql="UPDATE baihoc SET id='$id',tenbai='$tenbai',img='$img' WHERE id=$id ";
    ketnoivoisql($sql);
}

function xoaanh($img)
{
$sql="SELECT * FROM baihoc WHERE img='$img' ";
$resuil=ketnoivoisql($sql);
if(mysqLi_num_rows($resuil)<2) 
if(file_exists("../picture/anhnenmonhoc/".$img))
unlink("../picture/anhnenmonhoc/".$img);
}

function xoaavata($img)
{
$sql="SELECT * FROM thongtinchitiet WHERE avata='$img' ";
$resuil=ketnoivoisql($sql);
if(mysqli_num_rows($resuil)<2) 
if(file_exists("../picture/avata/".$img))
unlink("../picture/avata/".$img);
}

function themmonhoc($tableName) {
    $sql = "CREATE TABLE IF NOT EXISTS `$tableName` (
        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        tenbai VARCHAR(50) NOT NULL,
        noidung VARCHAR(1000) NOT NULL,
        img VARCHAR(255)
    )";
    ketnoivoisql($sql);
}

function xoamonhoc($table_name)
{
    $sql = "DROP TABLE IF EXISTS $table_name";
    ketnoivoisql($sql);
}
function suatenmonhoc($old, $new)
{
    $sql = "RENAME TABLE $old TO $new";
    ketnoivoisql($sql);
}
function themtiethoc($monhoc,$tiethoc)
{
        $id="";
        $noidung="";
        $img="";
        $sql_tiethoc="INSERT INTO $monhoc(id,tenbai,noidung,img) VALUES('$id','$tiethoc','$noidung','$img') ";
        ketnoivoisql($sql_tiethoc);
}
function xoatiethoc($monhoc,$tiethoc)
{
    $sql="DELETE FROM $monhoc WHERE tenbai='$tiethoc' ";
    ketnoivoisql($sql);
}

function suanoidungtiethoc($monhoc,$tiethoc,$content)
{
    $sql="UPDATE $monhoc SET noidung='$content' WHERE id='$tiethoc' ";
    ketnoivoisql($sql);
}
function suaanhtiethoc($monhoc,$tiethoc,$img)
{
    $sql="UPDATE $monhoc SET img='$img' WHERE id='$tiethoc' ";
    ketnoivoisql($sql);
}
function xuatnoidunggtiethoc($name)
{
            $baihoc=array();   
            $sql="SELECT * FROM $name";
            $result=ketnoivoisql($sql);
            if(mysqli_num_rows($result)> 0)
            while($row=mysqli_fetch_array($result))
            {
                $baihoc[]=$row['tenbai'];
            }
            return $baihoc;
}
?>
