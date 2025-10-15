<?php
session_start();
$error = "";
if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    unset($_SESSION['error']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&family=Schoolbell&display=swap">
    <link rel="stylesheet" href="css/admin_login.css">
</head>

<body>
    <div class="container">
        <div class="center">
            <form action="admin_login_process.php" method="POST">
                <div class="logo"><img src="css/images/admin1.png" height="100px" width="100px"></div>
                <div class="inputs">
                    <label>Email</label><br>
                    <input type="email" name="email" placeholder="Email" required>
                    <br>
                    <label>Password</label><br>
                    <input type="password" name="password" placeholder="Enter password" required>
                    <br>
                    <button type="submit" name="login">Login</button>
                </div>
        </div>
    </div>

</body>

</html>