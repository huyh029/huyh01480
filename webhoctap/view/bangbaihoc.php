<?php
session_start();
if(!isset($_SESSION['user']))
{
    header('location:dangnhap.php');
}
include"../model/sql.php";
$sql_baihoc="SELECT * FROM baihoc";
$result_baihoc=ketnoivoisql($sql_baihoc);
if(mysqli_num_rows($result_baihoc)>0)
{
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        table{
            border-collapse: collapse;
        }
        th,td{
            border: 1px solid black;
            padding: 20px 30px;
            font-size: 20px;
        }
    </style>
</head>
<body>
    <table>
        <tr>
            <th>tên bài</th>
            <th>img </th>
            <th>chi tiết</th>
            <th>xóa</th>
        </tr>            
            <?php
             while($row_baihoc=mysqli_fetch_array($result_baihoc))
             {
         ?>
         <tr>
         <td><?php echo $row_baihoc['tenbai']; ?></td>
         <?php if($row_baihoc['img']!="") {?>
            <td><img src="../picture/anhnenmonhoc/<?php echo $row_baihoc['img']; ?>" width="100px" style="object-fit: cover;"></td>
           <?php }
           else{ ?>
           <td></td>
           <?php } ?>
            <td><a href="chitiet.php?this_tenbai=<?php echo $row_baihoc['id']; ?>">chi tiết</a></td>
            <td>
                <form action="../controller/xoabaihoc.php?this_id=<?php echo $row_baihoc['id'];?>" method="POST">
                    <input type="submit" name="xoa" value="xóa">
                </form>
            </td>
            </tr>
         <?php
             }
         }
            ?>
        
    </table>
    <form action="bangbaihoc.php" method="POST" >
    <input type="submit" value="thêm bài học" name="thembaihoc" style="padding: 14px 16px;font-size: 18px;">
    </form>
</body>
</html>
<?php
if(isset($_POST['thembaihoc']))
{
    header('location:../controller/thembaihoc.php');
}
?>