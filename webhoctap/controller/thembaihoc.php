<?php
include"../model/sql.php";
if(isset($_POST['sub']))
{
if(isset($_FILES['chonfile']))
if($_FILES['chonfile']['size']!=0)
move_uploaded_file($_FILES['chonfile']['tmp_name'],'./../picture/anhnenmonhoc/'.$_FILES['chonfile']['name']);
if($_POST['tenbaihoc']!=="")
{
if($_FILES['chonfile']['size']!=0) themdulieuvao_baihoc("",$_POST['tenbaihoc'],$_FILES['chonfile']['name']);
else themdulieuvao_baihoc("",$_POST['tenbaihoc'],"");
themmonhoc($_POST['tenbaihoc']);
echo "đã thêm bài ".$_POST['tenbaihoc'];
}

}
if(isset($_POST['back'])) header('location:../view/bangbaihoc.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .thembaihoc{
            width: 300px;
            height: 30px;
            font-size: 18px;
            margin: 5px;
        }
    </style>
</head>
<body>
    <div>
    <form action="thembaihoc.php" method="POST" enctype="multipart/form-data" class="thembaihoc">
        <label class="thembaihoc">nhập tên môn học</label>
        <br>
        <input type="text" name="tenbaihoc" class="thembaihoc">
        <br>
        <label class="thembaihoc">
            chọn ảnh nền môn học
        </label>
        <br>
        <input type="file" name="chonfile" value="chọn avata" class="thembaihoc">
        <br>
        <input type="submit" name="sub" class="thembaihoc" value="nộp">
        <input type="submit" name="back" value="quay lại" class="thembaihoc">
    </form>
    </div>
</body>
</html>