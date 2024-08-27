<?php 
include"../model/sql.php";
session_start();
$user=$_SESSION['user'];
if(isset($_POST['sub'])){
    $hoten=$_POST['hoten'];
    $date=$_POST['date'];
    $email=$_POST['email'];
    $sodienthoai=$_POST['sdt'];
    $sql="SELECT * FROM thongtinchitiet WHERE user='$user' ";
    $result=ketnoivoisql($sql);
    $row=mysqli_fetch_array($result);
    $sql_sua="UPDATE thongtinchitiet SET hoten='$hoten', ngaysinh='$date', email='$email', sodienthoai='$sodienthoai' WHERE user='$user' ";
    ketnoivoisql($sql_sua);
    if(isset($_FILES['img'])&&$_FILES['img']['size']!==0)
    {
        xoaavata($row['avata']);
        move_uploaded_file($_FILES ['img']['tmp_name'],'./../picture/avata/'.$_FILES['img']['name']);
        $img=$_FILES['img']['name'];
        $sql_sua="UPDATE thongtinchitiet SET avata='$img' WHERE user='$user' ";
    ketnoivoisql($sql_sua);
    }  
    header('location:../view/index.php?this_page=hoso');  
}
?>