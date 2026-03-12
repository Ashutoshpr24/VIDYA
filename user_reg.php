<?php
$conn = mysqli_connect("localhost", "root", "", "collegenotes");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// AJAX request for TAC validation
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

// AJAX request for Email validation
if (isset($_POST['ajax_check_email'])) {
    $email = $_POST['email'] ?? '';
    if ($email === '') {
        echo json_encode(['status'=>'empty','message'=>'❌ Email cannot be empty']);
    } else {
        $sql = "SELECT * FROM users WHERE email=?";
        $stmt = mysqli_prepare($conn,$sql);
        mysqli_stmt_bind_param($stmt,'s',$email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if(mysqli_num_rows($result)>0){
            echo json_encode(['status'=>'wrong','message'=>'❌ Email already registered.']);
        } 
    }
    exit();
}

// Handle registration form submission
if (isset($_POST['register'])) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Teacher code check
    if ($role === 'teacher') {
        $teacher_code = $_POST['teacher_code'] ?? '';
        $code_sql = "SELECT code FROM teacher_codes LIMIT 1";
        $code_result = mysqli_query($conn, $code_sql);
        if ($code_result && mysqli_num_rows($code_result) > 0) {
            $row = mysqli_fetch_assoc($code_result);
            $correct_code = $row['code'];
            if ($teacher_code !== $correct_code) {
                $error_msg = "❌ Invalid Teacher Access Code";
            }
        } else {
            $error_msg = "❌ No Teacher Code set in database.";
        }
    }

    if (!isset($error_msg)) {
        $sql = "INSERT INTO users(fullname,email,password,role) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssss", $fullname, $email, $hashedPassword, $role);
        if(mysqli_stmt_execute($stmt)){
            header("Location: success.php");
            exit();
        } else {
            if(mysqli_errno($conn)==1062){
                $error_msg="❌ Email already registered. Please use another.";
            } else {
                $error_msg="❌ Error: ".mysqli_error($conn);
            }
        }
        mysqli_stmt_close($stmt);
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
<link rel="stylesheet" href="css/user_reg.css">
</head>
<body>
<div class="container">
    <div class="left">
        <div class="logo">
            <img src="css/images/logo vidya1.1.png" alt="VIDYA Logo">
        </div>
        <h2>Create your account</h2>
        <p>Please fill your personal details</p>

        <!-- Email error above Full Name field -->
        <div id="error-email"><?php if(isset($error_msg)) echo $error_msg; ?></div>

        <form id="regForm" method="POST">
            <input type="text" name="fullname" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email Address" required>
            <input type="password" name="password" placeholder="Create Password" required>
            <select name="role" required>
                <option value="">Register As</option>
                <option value="student">Student</option>
                <option value="teacher">Teacher</option>
            </select>

            <!-- Teacher code -->
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
const emailInput = document.querySelector('input[name="email"]');
const errorEmail = document.getElementById('error-email');

// Teacher code toggle
roleSelect.addEventListener('change',()=>{
    if(roleSelect.value==='teacher'){
        teacherCodeDiv.classList.add('show');
    } else {
        teacherCodeDiv.classList.remove('show');
        errorTac.innerText='';
        errorTac.className='';
    }
});

// Live TAC validation
let debounceTAC;
tacInput.addEventListener('input',()=>{
    clearTimeout(debounceTAC);
    debounceTAC = setTimeout(()=>{
        const code = tacInput.value.trim();
        if(code===''){ errorTac.innerText='❌ Teacher Access Code cannot be empty'; errorTac.className='empty'; return; }
        const formData = new FormData();
        formData.append('ajax_check_tac', true);
        formData.append('teacher_code', code);
        fetch('',{method:'POST',body:formData})
        .then(res=>res.json())
        .then(data=>{
            errorTac.innerText=data.message;
            errorTac.className=(data.status==='ok')?'ok':'wrong';
        });
    },300);
});

// Live Email validation
let debounceEmail;
emailInput.addEventListener('input',()=>{
    clearTimeout(debounceEmail);
    debounceEmail = setTimeout(()=>{
        const email = emailInput.value.trim();
        if(email===''){ errorEmail.innerText='❌ Email cannot be empty'; errorEmail.className='empty'; return; }
        const formData = new FormData();
        formData.append('ajax_check_email', true);
        formData.append('email', email);
        fetch('',{method:'POST',body:formData})
        .then(res=>res.json())
        .then(data=>{
            errorEmail.innerText = data.message;
            errorEmail.className = (data.status==='ok')?'ok':'wrong';
        });
    },300);
});

// Prevent form submission if TAC invalid
regForm.addEventListener('submit',(e)=>{
    if(roleSelect.value==='teacher' && (tacInput.value.trim()==='' || errorTac.innerText.includes('Invalid'))){
        e.preventDefault();
        tacInput.focus();
    }
    if(emailInput.value.trim()==='' || errorEmail.innerText.includes('already')){
        e.preventDefault();
        emailInput.focus();
    }
});
</script>
</body>
</html>