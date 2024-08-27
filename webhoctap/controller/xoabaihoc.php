<?php
include"../model/sql.php";
$id=$_GET['this_id'];
$sql="SELECT * FROM baihoc WHERE id='$id'";
$result=ketnoivoisql($sql);
$row=mysqli_fetch_array($result);
$tenbai=$row['tenbai'];
xoaanh($row['img']);
{
$sql="DELETE FROM baihoc WHERE id='$id' ";
ketnoivoisql($sql);
}
xoamonhoc($tenbai);
header('location:../view/bangbaihoc.php');
?>