<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Dashboard | VIDYA</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #0b4141, #062c2c);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
        }

        .coming-card {
            background: #ffffff;
            border-radius: 15px;
            padding: 40px 35px;
            max-width: 500px;
            text-align: center;
            box-shadow: 0 15px 40px rgba(0,0,0,0.2);
        }

        .icon-circle {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            background: #ff6060ff;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: #fff;
            font-size: 40px;
        }

        h2 {
            color: #0b4141;
            font-weight: 600;
        }

        p {
            color: #555;
            margin-top: 10px;
        }

        .highlight {
            color: #ff5252;
            font-weight: 500;
        }

        .btn-back {
            background: #0b4141;
            color: #fff;
            border-radius: 30px;
            padding: 10px 25px;
            margin-top: 20px;
        }

        .btn-back:hover {
            background: #ff5252;
            color: #fff;
        }

        .footer-text {
            margin-top: 25px;
            font-size: 13px;
            color: #777;
        }
    </style>
</head>
<body>

<div class="coming-card">
    <div class="icon-circle">
        <i class="bi bi-mortarboard"></i>
    </div>

    <h2>Student Dashboard</h2>

    <p class="mt-3">
        🚧 <span class="highlight">Coming Soon!</span>
    </p>

    <p>
        We’re currently working on something amazing for you.  
        The student dashboard will be available very soon.
    </p>

    <p class="fw-semibold">
        Thank you for your patience 🙏
    </p>

    <a href="homepage.php" class="btn btn-back">
        <i class="bi bi-arrow-left"></i> Back to Home
    </a>

    <div class="footer-text">
        © <?php echo date("Y"); ?> VIDYA • Learn Better, Share Smarter
    </div>
</div>

</body>
</html>
