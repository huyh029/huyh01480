<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Image Bands</title>
</head>
<body>
    <h2>Upload 5 Image Bands</h2>
    <form action="handle.php" method="POST" enctype="multipart/form-data">
        <label for="band2">Band 2:</label>
        <input type="file" name="band2" id="band2" required><br><br>

        <label for="band3">Band 3:</label>
        <input type="file" name="band3" id="band3" required><br><br>

        <label for="band4">Band 4:</label>
        <input type="file" name="band4" id="band4" required><br><br>

        <label for="band5">Band 5:</label>
        <input type="file" name="band5" id="band5" required><br><br>

        <label for="band6">Band 6:</label>
        <input type="file" name="band6" id="band6" required><br><br>

        <input type="submit" value="Upload Images">
    </form>
</body>
</html>
