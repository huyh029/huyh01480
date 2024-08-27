<?php
include"../model/connect.php";
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
        .thebai{
           margin: auto;
           text-align: center;
           padding: 20px;
        }
        .thebai a{
            display: inline-block;
        }
        table.chiadeu{
            width: 100%;
        }
    </style>
</head>
<body>
    <table class="chiadeu">
    <?php
    $sql="SELECT * FROM baihoc";
    $result=mysqli_query($conn,$sql);
    $dem=1;
    if(mysqli_num_rows($result)> 0){
    while($row=mysqli_fetch_array($result)){
        $monhoc=$row['tenbai'];
        if($dem===1){
            ?>
            <tr>
            <?php
        }
        ?>
        <td class="thebai">
        <a href="index.php?this_page=<?php echo $monhoc; ?>" ><?php thebai($row['tenbai'],$row['img']); ?></a>
        </td>
        <?php
        if($dem===3){
            $dem=1;
            ?>
            </tr>
            <?php
        }
        $dem++;
    }
    ?>
    </tr>
    <?php
}
    ?>
    </table>
</body>
</html>