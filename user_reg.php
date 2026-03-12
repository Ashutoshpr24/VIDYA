<?php
// Database connection
$conn = mysqli_connect("localhost", "root", "", "collegenotes");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle AJAX request for TAC validation
if (isset($_POST['ajax_check_tac'])) {
    $teacher_code = $_POST['teacher_code'] ?? '';
    $code_sql = "SELECT code FROM teacher_codes LIMIT 1";
    $code_result = mysqli_query($conn, $code_sql);
    if ($code_result && mysqli_num_rows($code_result) > 0) {
        $row = mysqli_fetch_assoc($code_result);
        $correct_code = $row['code'];
        if ($teacher_code === '') {
            echo json_encode(['status' => 'empty', 'message' => '❌ Teacher Access Code cannot be empty']);
        } elseif ($teacher_code !== $correct_code) {
            echo json_encode(['status' => 'wrong', 'message' => '❌ Invalid Teacher Access Code']);
        } else {
            echo json_encode(['status' => 'ok', 'message' => '✅ TAC is correct']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => '❌ No Teacher Code set in database']);
    }
    exit();
}

// Handle form submission
if (isset($_POST['register'])) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role']; 

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    if ($role === 'teacher') {
        $teacher_code = $_POST['teacher_code'] ?? '';
        $code_sql = "SELECT code FROM teacher_codes LIMIT 1";
        $code_result = mysqli_query($conn, $code_sql);

        if ($code_result && mysqli_num_rows($code_result) > 0) {
            $row = mysqli_fetch_assoc($code_result);
            $correct_code = $row['code'];
        } else {
            $error_msg = "❌ No Teacher Code set in database.";
        }

        if ($teacher_code !== $correct_code) {
            $error_msg = "❌ Invalid Teacher Access Code";
        }
    }

    if (!isset($error_msg)) {
        $sql = "INSERT INTO users(fullname,email,password,role) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ssss", $fullname, $email, $hashedPassword, $role);

            if (mysqli_stmt_execute($stmt)) {
                header("Location: success.php");
                exit();
            } else {
                if (mysqli_errno($conn) == 1062) {
                    $error_msg = "❌ Email already registered. Please use another.";
                } else {
                    $error_msg = "❌ Error: " . mysqli_error($conn);
                }
            }
            mysqli_stmt_close($stmt);
        } else {
            $error_msg = "❌ Failed to prepare statement: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>VIDYA Register</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:Poppins,sans-serif;}
body{background:#eef2f7;display:flex;align-items:center;justify-content:center;min-height:100vh;padding:10px;}
.container{display:flex;max-width:1050px;width:100%;min-height:550px;background:white;border-radius:14px;overflow:hidden;box-shadow:0 25px 50px rgba(0,0,0,0.12);}
.left{flex:0.9;padding:30px 40px;display:flex;flex-direction:column;justify-content:center;background:white;box-shadow:6px 0 18px rgba(0,0,0,0.06);z-index:2;}
.logo{margin-bottom:14px;}
.logo img{width:150px;height:auto;}
.left h2{font-size:24px;margin-bottom:4px;color:#111827;}
.left p{font-size:13px;color:#6b7280;margin-bottom:14px;}
input, select{width:100%;padding:10px;border-radius:6px;border:1px solid #d1d5db;margin-bottom:8px;font-size:14px;transition:all .25s ease;}
input:focus, select:focus{outline:none;border-color:#059669;box-shadow:0 0 0 3px rgba(16,185,129,0.15);}
button{width:100%;padding:10px;background:#059669;color:white;border:none;border-radius:6px;font-size:14px;cursor:pointer;transition:.25s;margin-top:6px;}
button:hover{background:#047857;transform:translateY(-2px);box-shadow:0 8px 18px rgba(0,0,0,0.12);}
.signin{margin-top:12px;font-size:13px;color:#6b7280;text-align:center;}
.signin a{color:#059669;text-decoration:none;font-weight:500;display:inline-block;transition:transform .2s ease, font-weight .2s ease;}
.signin a:hover{font-weight:600;transform:scale(1.05);}
.right{flex:1.3;display:flex;align-items:center;justify-content:center;overflow:hidden;background:white;}
.right img{width:100%;height:100%;object-fit:cover;}

/* Teacher Code Field */
#teacher-code {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.3s ease;
    margin-bottom: 6px; /* reduced space below input+message */
}
#teacher-code.show {
    max-height: 65px; /* enough for input + message */
}
#error-tac {
    font-size: 11px;
    margin: 0; /* remove space above/below */
    padding: 0;
    min-height: 14px;
    line-height: 14px;
    transition: color 0.2s ease;
}

/* Color changes dynamically */
#error-tac.ok { color: green; }
#error-tac.wrong, #error-tac.empty { color: red; }

@media(max-width:768px){
    .container{flex-direction:column;min-height:auto;}
    .right{order:-1;height:260px;}
    .left{padding:25px 22px;box-shadow:none;}
    .left h2{font-size:20px;}
    .logo img{width:130px;}
}
</style>
</head>
<body>

<div class="container">

    <div class="left">
        <div class="logo">
            <img src="css/images/logo vidya1.1.png" alt="VIDYA Logo">
        </div>

        <h2>Create your account</h2>
        <p>Please fill your personal details</p>

        <?php if(isset($error_msg)){ echo "<div style='color:red;margin-bottom:10px;text-align:center;'>{$error_msg}</div>"; } ?>

        <form id="regForm" method="POST">
            <input type="text" name="fullname" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email Address" required>
            <input type="password" name="password" placeholder="Create Password" required>

            <select name="role" required>
                <option value="">Register As</option>
                <option value="student">Student</option>
                <option value="teacher">Teacher</option>
            </select>

            <!-- teacher code field -->
            <div id="teacher-code">
                <input type="password" name="teacher_code" placeholder="Teacher Access Code">
                <div id="error-tac"></div>
            </div>

            <button type="submit" name="register">Register</button>

            <div class="signin">
                Already have an account? <a href="userlogin.php">Sign In</a>
            </div>
        </form>
    </div>

    <div class="right">
        <img src="css/images/4444.png" alt="Students studying">
    </div>

</div>

<script>
const roleSelect = document.querySelector('select[name="role"]');
const teacherCodeDiv = document.getElementById('teacher-code');
const regForm = document.getElementById('regForm');
const tacInput = document.querySelector('input[name="teacher_code"]');
const errorTac = document.getElementById('error-tac');

roleSelect.addEventListener('change', function() {
    if(this.value === 'teacher'){
        teacherCodeDiv.classList.add('show');
    } else {
        teacherCodeDiv.classList.remove('show');
        errorTac.innerText = '';
        errorTac.className = '';
    }
});

// AJAX validation for TAC on input
tacInput.addEventListener('input', function() {
    const code = tacInput.value.trim();
    if(code === '') {
        errorTac.innerText = '❌ Teacher Access Code cannot be empty';
        errorTac.className = 'empty';
        return;
    }

    const formData = new FormData();
    formData.append('ajax_check_tac', true);
    formData.append('teacher_code', code);

    fetch('', {method:'POST', body: formData})
    .then(res => res.json())
    .then(data => {
        errorTac.innerText = data.message;
        if(data.status === 'ok') {
            errorTac.className = 'ok';
        } else {
            errorTac.className = 'wrong';
        }
    })
    .catch(err => console.error(err));
});

// prevent form submission if TAC invalid
regForm.addEventListener('submit', function(e){
    if(roleSelect.value === 'teacher' && (tacInput.value.trim() === '' || errorTac.innerText.includes('Invalid'))) {
        e.preventDefault();
        tacInput.focus();
    }
});
</script>

</body>
</html>