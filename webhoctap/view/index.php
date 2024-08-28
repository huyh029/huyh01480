<?php
session_start();
if(!isset($_SESSION['user']))
{
    header('location:dangnhap.php');
}
include"thanhquanli.php";
include"thanhdieukhien.php";
include"../controller/thehoctap.php";
include"../controller/menutungphan.php";
include"../controller/content.php";
if(isset($_GET['this_page']))
switch($_GET['this_page'])
{
    case "hoso": include"hoso.php"; break;
    case "trangchu": include"trangchu.php"; break;
    default:
    $monhoc=$_GET['this_page'];
    xuly($monhoc);
}
else include"trangchu.php";
?>
<?php
function xuly($name)
{   
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            .chiacot{
                width: 100%;
       

            }
            .chiacot td{
                padding: 10px;
                text-align: center;
   
            }
            .cot{
                display: inline-block;
            }
        </style>
    </head>
    <body>
    <?php
    $sql="SELECT * FROM baihoc WHERE tenbai='$name' ";
    $result=ketnoivoisql($sql);
    if(mysqli_num_rows($result)>0)
    {
        $row=mysqli_fetch_array($result);
        $ten=$row['tenbai'];
        $sql_tiethoc="SELECT * FROM $ten ";
        $result_tiethoc=ketnoivoisql($sql_tiethoc);
        if(mysqli_num_rows($result_tiethoc)> 0)
        ?>
        <table class="chiacot">
        <?php
        $i=1;
        while($row_tiethoc=mysqli_fetch_array($result_tiethoc))
    {
        if($i===1)
        {
            ?>
            <tr>
            <?php
        }
        ?>
        <td><a href="index.php?this_page=<?php echo $ten."|".$row_tiethoc['tenbai'];?>|img" class="cot"><?php the_bai($row_tiethoc['tenbai'],$row_tiethoc['img']); ?></a></td>
        <?php
        if($i===3)
        {
            ?>
            </tr>
            <?php
            $i=0;
        }
        $i++;
    }    
    ?>
            </tr>
    </table>
    </body>
    </html>
    <?php
}
    else {
        $ten=explode("|",$name);
        $name=$ten[0];
        $tenbai=$ten[1];
        $sql_tiethoc= "SELECT * FROM $name WHERE tenbai='$tenbai' ";
        $result_tiethoc=ketnoivoisql($sql_tiethoc);
        $row_tiethoc=mysqli_fetch_array($result_tiethoc);
        menutungphan($name);
        if($ten[2]=="img")
        {
            ?>
            <a href="index.php?this_page=<?php echo $name."|".$row_tiethoc['tenbai']; ?>|content" >
                <?php img($name,$tenbai); ?>
            <?php
        }
        else{
            ?>
            <a href="index.php?this_page=<?php echo $name."|".$row_tiethoc['tenbai'];?>|img">
                <?php content($name,$tenbai); ?>
            </a>
            <?php
        }
    }
}
?>