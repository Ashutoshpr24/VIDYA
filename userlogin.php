
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link  rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&family=Schoolbell&display=swap">
    <link rel="stylesheet" href="css/user_login.css">
    <link rel="shortcut icon" href="css/images/logo2.png" type="image/x-icon">
</head>
<body>
    <div class="container">
        <div class="left">
        </div>
        <div class="right">
            <form action="user_logincode.php" method="POST">
                <br>
                <div class="form">
                <h2>Welcome</h2>
                <p>Please fill your personal details</p>
                <label>Email</label><br>
                <input type="email" name="email" placeholder="Enter Your Email Address"><br><br>
                <label>Password</label><br>
                <input type="password" name="password" placeholder="Enter Your Password"><br><br>
                <button type="submit" name="login">Login</button><br>
                <p>Don't have an account? <a href="user_reg.php">Sign Up</a></p>
                </div>
                

            </form>
        </div>
            
        </div>
    </div>
</body>
</html>