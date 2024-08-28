<?php
include"menutungphan.php";
include"thehoctap.php";
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
                display: inline;
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
        <td><a href="" class="cot"><?php thebai($row_tiethoc['tenbai'],$row_tiethoc['img']); ?></a></td>
        <?php
        if($i===3)
        {
            ?>
            </tr>
            <?php
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
    }
}
?>