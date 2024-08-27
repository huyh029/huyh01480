<?php

include"../controller/dropdown.php";
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
        .thanhdieukhien{
            display: flex;
            flex-direction: row;
            overflow: hidden;
            background-color: black;
        }
        .home{
            display: inline-block;
            padding: 14px 16px;
            
            background-color: rgb(255, 0, 0);
            border: 1px solid #f1f1f1;
            box-shadow: 1px 1px 1px red;    
        }
        .home a{
            text-decoration: none;
            font-size: 20px;
            color: white;
        }
        .home:hover{
            background-color: red;
            border: 1px solid white;
            box-shadow: 1px 1px 20px red;
        }
        ul.thanhdieukhien{
         list-style-type: none;
        }
    </style>
</head>
<body>
    <ul class="thanhdieukhien">
        <li class="home"><a href="index.php?this_page=trangchu">HOME</a></li>
        <?php
        $sql="SELECT * FROM baihoc";
        $result=mysqli_query($conn,$sql);
        while($row=mysqli_fetch_array($result)){
            $monhoc=$row['tenbai'];
            ?>
            <li><a href="index.php?this_page=<?php echo $monhoc; ?>">
                <?php
                dropdown($monhoc);
                ?>
            </a></li>
            <?php
        }
        ?>
    </ul>
</body>
</html>