<?php
function thebai($name,$img)
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
        .vo{
            background-color: black;
            width: 350px;
            height: 450px;
            border-radius: 30px;
            display: flex;
            flex-direction: column;
           
            align-items: center;

        }
        .img{
            width: 300px;
            border-radius: 30px;
        }
        div.img{
            width: 300px;
            height: 300px;
            margin: 25px 25px 10px 25px;
            display: flex;
            justify-content: center;
            align-items: start;
            overflow: hidden;
        }
        .name{
            color: white;
            font-size: 60px;
            text-shadow: 1px 1px 10px white;
            
        }
        .vo:hover{
            border: 1px solid white;
            box-shadow: 1px 1px 20px rgb(0, 0, 0);
        }
    </style>
</head>
<body>
    <!-- <a href="../view/index.php?this_page=<?php echo $name; ?>" style="text-decoration: none;margin:5px;" > -->
    <div class="vo">
        <div class="img">
        <img src="../picture/anhnenmonhoc/<?php if($img!=="") echo $img; else echo"macdinh.jpg"; ?>" class="img" >
        </div>
        <h1 class="name">
            <?php echo $name; ?>
        </h1>
    </div>
    </a>
</body>
</html>
<?php
}

function the_bai($name,$img)
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
        .vo{
            background-color: black;
            width: 350px;
            height: 450px;
            border-radius: 30px;
            display: flex;
            flex-direction: column;
           
            align-items: center;

        }
        .img{
            width: 300px;
            border-radius: 30px;
        }
        div.img{
            width: 300px;
            height: 300px;
            margin: 25px 25px 10px 25px;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }
        .name{
            color: white;
            font-size: 60px;
            text-shadow: 1px 1px 10px white;
            
        }
        .vo:hover{
            border: 1px solid white;
            box-shadow: 1px 1px 20px rgb(0, 0, 0);
        }
    </style>
</head>
<body>
    <!-- <a href="../view/index.php?this_page=<?php echo $name; ?>" style="text-decoration: none;margin:5px;" > -->
    <div class="vo">
        <div class="img">
        <img src="../picture/anhnoidungmonhoc/<?php if($img!=="") echo $img; else echo"macdinh.jpg"; ?>" class="img" >
        </div>
        <h1 class="name">
            <?php echo $name; ?>
        </h1>
    </div>
    </a>
</body>
</html>
<?php
}
?>
