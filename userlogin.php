<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>VIDYA Login</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:Poppins;
}

body{
background:#eef2f7;
display:flex;
align-items:center;
justify-content:center;
min-height:100vh;
padding:10px;
}

/* container */

.container{
display:flex;
max-width:1050px;
width:100%;
min-height:580px;
background:white;
border-radius:14px;
overflow:hidden;
box-shadow:0 25px 50px rgba(0,0,0,0.12);
}

/* LEFT SIDE */

.left{
flex:0.9;
padding:45px 45px 50px 45px;
display:flex;
flex-direction:column;
justify-content:center;
background:white;
box-shadow:6px 0 18px rgba(0,0,0,0.06);
z-index:2;
}

/* LOGO */

.logo{
margin-bottom:20px;
}

.logo img{
width:150px;
height:auto;
}

/* heading */

.left h2{
font-size:26px;
margin-bottom:20px;
color:#111827;
}

/* inputs */

input{
width:100%;
padding:12px;
border-radius:7px;
border:1px solid #d1d5db;
margin-bottom:14px;
font-size:14px;
transition:all .25s ease;
}

input:focus{
outline:none;
border-color:#059669;
box-shadow:0 0 0 3px rgba(16,185,129,0.15);
}

/* button */

button{
width:100%;
padding:12px;
background:#059669;
color:white;
border:none;
border-radius:7px;
font-size:15px;
cursor:pointer;
transition:.25s;
}

button:hover{
background:#047857;
transform:translateY(-2px);
box-shadow:0 8px 18px rgba(0,0,0,0.12);
}

/* signup text */

.signup{
margin-top:16px;
font-size:14px;
color:#6b7280;
text-align:center;
}

/* signup link */

.signup a{
color:#059669;
text-decoration:none;
font-weight:500;
display:inline-block;
transition:transform .2s ease, font-weight .2s ease;
}

.signup a:hover{
font-weight:600;
transform:scale(1.05);
}

/* RIGHT SIDE */

.right{
flex:1.3;
display:flex;
align-items:center;
justify-content:center;
padding:0;
overflow:hidden;
background:white;
}

.right img{
width:100%;
height:100%;
object-fit:cover;
}

/* MOBILE */

@media(max-width:768px){

.container{
flex-direction:column;
min-height:auto;
}

.right{
order:-1;
height:260px;
}

.left{
padding:35px 22px;
box-shadow:none;
}

.left h2{
font-size:22px;
}

.logo img{
width:130px;
}

}

</style>
</head>

<body>

<div class="container">

<div class="left">

<div class="logo">
<img src="css/images/logo vidya1.1.png" alt="VIDYA Logo">
</div>

<h2>Sign into your account</h2>

<form action="user_logincode.php" method="POST">

<input type="email" name="email" placeholder="Email address" required>

<input type="password" name="password" placeholder="Password" required>

<button type="submit" name="login">Log In</button>

<div class="signup">
Don't have an account? <a href="user_reg.php">Sign Up</a>
</div>

</form>

</div>

<div class="right">

<img src="css/images/4444.png" alt="Students studying">

</div>

</div>

</body>
</html>