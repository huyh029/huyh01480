<?php
function img($monhoc,$tiethoc)
{
    $sql="SELECT * FROM $monhoc WHERE tenbai='$tiethoc' ";
    $result=ketnoivoisql($sql);
    $row=mysqli_fetch_array($result);
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            .khung
            {
                width: 70%;
                height: 70vh;
                background-color: black;
                float: right;
                margin: 20px;
                border-radius: 30px;
                display: flex;
                flex-direction: column;

                align-items: center;
            }
            .anh
            {
                width: 95%;
                height: 60vh;
                background-color: red;
                float: right;
                margin: 20px;
                border-radius: 30px;
                background-image: url("../picture/anhnoidungmonhoc/<?php echo $row['img']; ?>");
                background-size: 100%;
            }
            .nut_img{
                margin-top: -7px;
                width: 95%;
                display: flex;
                flex-direction: row;
                justify-content: start;
                align-items: center;
                
            }
            .blue{
                margin:-3px 10px;
                width: 20px;
                height: 20px;
                border-radius: 50%;
                background-color: green;
            }
            .red{
                margin:-3px 10px;
                width: 30px;
                height: 30px;
                border-radius: 50%;
                background-color: red;
            }
            .blue:hover{
                width: 30px;
                height: 30px;
            }
        </style>
    </head>
    <body>
        <div class="khung">
            <div class="anh">

            </div>
        
            <div class="nut_img">
            <div class="red"></div>
            <div class="blue"></div>
            </div>
        </div>
        </div>
    </body>
    </html>
    <?php
}
function content($monhoc,$tiethoc)
{
    $sql="SELECT * FROM $monhoc WHERE tenbai='$tiethoc' ";
    $result=ketnoivoisql($sql);
    $row=mysqli_fetch_array($result);
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            .khung
            {
                width: 70%;
                height: 70vh;
                background-color: black;
                float: right;
                margin: 20px;
                border-radius: 30px;
                display: flex;
                flex-direction: column;
               
                align-items: center;
            }
            .anh
            {
                width: 95%;
                height: 60vh;
                overflow: hidden;
                float: right;
                margin: 20px;

                background-size: 100%;
                background-color: white;
                font-size: 18px;
                display: flex;
                justify-content: center;
                align-items: center;
                background-color: black;
                color: white;
            }
            .noidung
            {
                width: 100%;
                height: 60vh;
                overflow: hidden;
                font-size: 18px;
                border: none;
                box-shadow: none;
                outline: none;
                background-color: black;
                color: white;
            }
            .nut_img{
                margin-top: -7px;
                width: 95%;
                display: flex;
                flex-direction: row;
                justify-content: start;
                align-items: center;
                
            }
            .blue{
                margin:-3px 10px;
                width: 20px;
                height: 20px;
                border-radius: 50%;
                background-color: red;
            }
            .red{
                margin:-3px 10px;
                width: 30px;
                height: 30px;
                border-radius: 50%;
                background-color: green;
            }
            .blue:hover{
                width: 30px;
                height: 30px;
            }
        </style>
    </head>
    <body>
        <div class="khung">
            <div class="anh">
            <textarea class="noidung"><?php echo $row['noidung'];?></textarea>
            </div>
            <div class="nut_img">
            <div class="blue"></div>
            <div class="red"></div>
            </div>
        </div>
        </div>
    </body>
    </html>
    <?php
}
?>