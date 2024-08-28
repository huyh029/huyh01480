<?php
function menutungphan($name)
{
    $baihoc=xuatnoidunggtiethoc($name);
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
        ul.menu{
            overflow: hidden;
            list-style-type: none;
            width: 20%;
            background-color: #f1f1f1;
            float: left;
        }
        ul.menu li{
            padding: 14px 16px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        ul.menu li a{
            text-decoration: none;
            color: rgb(0, 0, 0);
            font-size: 20px;
        }   
        ul.menu li:hover{
            background-color: #dadada;
        }
    </style>
</head>
<body>
    <ul class="menu">
        <?php
        foreach($baihoc as $value)
        {
        ?>
        <li><a href="index.php?this_page=<?php echo $name."|".$value;?>|img"><?php echo $value; ?></a></li>
        <?php
        }
        ?>
    </ul>
</body>
</html>
<?php
}
?>