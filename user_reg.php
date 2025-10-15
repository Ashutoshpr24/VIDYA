<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REGISTRATION</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&family=Schoolbell&display=swap">
    <link rel="stylesheet" href="css/user_reg.css">
</head>

<body>
    <div class="container">
        <div class="left">
        </div>
        <div class="right">
            <form action="user_regcode.php" method="POST">
            
                <h2>Welcome</h2>
                <p>Please fill your personal details</p>
                <label>Name</label><br>
                <input type="text" name="fullname" placeholder="Enter Your Full Name"><br><br>
                <label>Email</label><br>
                <input type="email" name="email" placeholder="Enter Your Email Address"><br><br>
                <label> Create Password</label><br>
                <input type="password" name="password" placeholder="Enter Your Password"><br><br>
                
                <label for="role">Register As</label>
                <select name="role" required>
                    <option value="student">Student</option>
                    <option value="teacher">Teacher</option>
                </select><br>

                <div id="teacher-code" style="display:none;">
                    <br>
                    <label>TAC</label>
                    <input type="password" class="inp" name="teacher_code" placeholder="Enter Teacher Access Code">
            
                </div>

                <script>
                    document.querySelector('select[name="role"]').addEventListener('change', function() {
                        if (this.value === 'teacher') {
                            document.getElementById('teacher-code').style.display = 'block';
                        } else {
                            document.getElementById('teacher-code').style.display = 'none';
                        }
                    });
                </script><br>

                <button type="submit" name="register">Register</button><br>
                <p>Already have an account? <a href="userlogin.php">Sign In</a></p>


            </form>
        </div>

    </div>
    </div>
</body>

</html>