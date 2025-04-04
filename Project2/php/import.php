<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Image Bands</title>
    <style>
        /* Tổng thể trang */
        .body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }

        /* Form container */
        form {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            display: grid;
            grid-template-columns: 1fr;
            gap: 10px;
        }

        /* Label */
        label {
            font-size: 16px;
            font-weight: 600;
            color: #333;
        }

        /* Input file */
        input[type="file"] {
            /* width: 90%; */
            padding: 15px;
            border: 2px dashed #4a90e2;
            border-radius: 5px;
            background-color: #f0f8ff;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        /* Hover effect for input file */
        input[type="file"]:hover {
            border-color: #3078d4;
            background-color: #e6f0ff;
        }

        /* Submit button */
        input[type="submit"] {
            background-color: #4a90e2;
            color: white;
            padding: 15px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 15px;
            width: 100%;
        }

        /* Hover effect for submit button */
        input[type="submit"]:hover {
            background-color: #3078d4;
        }

        /* Responsive design */
        @media (max-width: 600px) {
            form {
                padding: 20px;
                width: 90%;
            }

            input[type="submit"] {
                padding: 12px;
            }
        }
    </style>
</head>

<body>
    <div class="body">
        <h2>Upload 5 Image Bands</h2>
        <form action="handle.php" method="POST" enctype="multipart/form-data">
            <label for="band2">Band 2:</label>
            <input type="file" name="band2" id="band2" required>

            <label for="band3">Band 3:</label>
            <input type="file" name="band3" id="band3" required>

            <label for="band4">Band 4:</label>
            <input type="file" name="band4" id="band4" required>

            <label for="band5">Band 5:</label>
            <input type="file" name="band5" id="band5" required>

            <label for="band6">Band 6:</label>
            <input type="file" name="band6" id="band6" required>

            <input type="submit" value="Upload Images">
        </form>
    </div>
</body>

</html>
