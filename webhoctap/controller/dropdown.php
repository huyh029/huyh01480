<?php

function dropdown($name)
{
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
        .drop{
            
        }
        .name_drop{
            display: inline-block;
            padding: 14px 16px;
            background-color: black;
            color: white;
            font-size: 20px;
        }
        a{
            text-decoration: none;

        }
        .content a{
            display: block;
            padding: 14px 16px;
            color: black;
            font-size: 18px;
        }
        .content a:hover{
            background-color: #f1f1f1;
        }
        .content{
            box-shadow: 1px 1px 5px black;
            width: 150px;
            background-color: white;
            position: absolute;
            display: none;
        }
        .name_drop:hover, .drop:hover .name_drop{
            background-color: aqua;
            border: 1px solid white;
            box-shadow: 1px 1px 5px aqua;
        }
        .drop:hover .content{
            display: block;
        }
    </style>
</head>
<body>
    <div class="drop">
        <a href="../view/index.php?this_page=<?php echo $name;?>" class="name_drop"><?php echo $name; ?></a>
        <div class="content">
            <?php  
            foreach(xuatnoidunggtiethoc($name) as $value)
            {
                ?>
           <a href="index.php?this_page=<?php echo $name."|".$value;?>|img"><?php echo $value; ?></a>
                <?php
            }
            ?>
        </div>
    </div>
</body>
</html>
<?php
}
?>