<?php
$Server='localhost';
$User='root';
$Pass='';
$Database='taikhoan';
$conn=new mysqLi($Server,$User,$Pass,$Database);
if($conn)
{
    mysqLi_query($conn, " SET NAMES 'utf8' ");
}
?>