<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Chủ - Phân Đoạn Ảnh</title>
    <style>
        /* Reset CSS */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f4f4f4;
            text-align: center;
        }

        /* Phần đầu trang */
        .hero {
            background: url('background.jpg') no-repeat center center/cover;
            height: 60vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
            flex-direction: column;
            padding: 20px;
        }

        .hero h1 {
            font-size: 32px;
            margin-bottom: 10px;
            color: black;
        }

        .hero p {
            font-size: 18px;
            margin-bottom: 20px;
            color: black;
        }

        .btn-custom {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            display: inline-block;
            transition: 0.3s;
        }

        .btn-custom:hover {
            background-color: #0056b3;
        }

        /* Chức năng chính */
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 40px auto;
        }

        .section-title {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            justify-content: center;
        }

        .card {
            background: white;
            border-radius: 10px;
            padding: 15px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 10px;
        }

        .card h5 {
            font-size: 18px;
            margin: 10px 0;
        }

        .card p {
            font-size: 14px;
            color: #666;
            margin-bottom: 15px;
        }

        .btn {
            background-color: #28a745;
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 14px;
            display: inline-block;
        }

        .btn:hover {
            background-color: #218838;
        }

        /* Chân trang */
        footer {
            background-color: #333;
            color: white;
            padding: 10px 0;
            margin-top: 40px;
        }
    </style>
</head>
<body>

<!-- Phần đầu trang -->
<header class="hero">
    <h1>📸 Hệ Thống Phân Đoạn Ảnh</h1>
    <p>Phân tích và phân đoạn ảnh vệ tinh</p>
    <a href="index.php?status=statistics" class="btn-custom">📊 Xem Thống Kê</a>
</header>

<!-- Chức năng chính -->
<section class="container">
    <h2 class="section-title">🚀 Chức Năng Chính</h2>
    <div class="grid">
        <!-- Thống kê dữ liệu -->
        <div class="card">
            <img src="https://lh3.googleusercontent.com/proxy/tsevssZNvWbXKRzsaJCHlQvcrOZyi8U9U_NFWDxVxH0hRki1UDq-w0Fnm6qoDsIXnSh08JiJaZlBqIbMMYXDsIZhd72GZS4nF0scyrjLKrkht4CJlk0" alt="Thống kê">
            <h5>📊 Thống Kê</h5>
            <p>Xem số liệu thống kê về diện tích nước, thực vật, đô thị...</p>
            <a href="index.php?status=statistics" class="btn">Xem Ngay</a>
        </div>
        <!-- Phân tích ảnh -->
        <div class="card">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSN75M1OCiOMLu6cggfNXjQaBCAtSs5ODo-rw&s" alt="Tải ảnh lên">
            <h5>📷 Phân Tích Ảnh</h5>
            <p>Tải ảnh lên và xem kết quả phân đoạn.</p>
            <a href="index.php?status=import" class="btn">Bắt Đầu</a>
        </div>
        <!-- Bản đồ -->
        <div class="card">
            <img src="https://image3.luatvietnam.vn/uploaded/images/original/2025/01/06/cach-doc-thua-dat-tren-ban-do-dia-chinh-_0601104238.jpg" alt="Bản đồ">
            <h5>🗺️ Hình ảnh Trực Quan</h5>
            <p>Xem kết quả phân đoạn trên bản đồ GIS.</p>
            <a href="index.php?status=picture" class="btn">Khám Phá</a>
        </div>
    </div>
</section>



</body>
</html>
