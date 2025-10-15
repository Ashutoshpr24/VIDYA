<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "collegenotes";

$conn = mysqli_connect($host, $user, $password, $dbname);
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>College Notes Gallery</title>
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="css/style1.css">
  <style>
    .nav-item.dropdown:hover .dropdown-menu {
  display: block;
  margin-top: 0;
  margin-right: 5px;
}
    body {
      font-family: 'Poppins', sans-serif;
      padding-top: 70px; 
    }
   
    .dropdown-menu {
      right: -65px;
      left: auto;
    }   

  </style>
</head>
<body>

  <nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
      <a class="navbar-brand fs-3" href="#">
        <img src="css/images/logoo.png" height="180px" width="300px" alt="Logo">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
              data-bs-target="#navbarNav" aria-controls="navbarNav" 
              aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon bg-light"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto align-items-center">
          <li class="nav-item"><a class="nav-link" href="homepage.php"><img src="css/images/home.png" height="40px" width="40px" alt=""></a></li>
          <li class="nav-item"><a class="nav-link" href="browse_notes.php"><img src="css/images/browsenotes.png" height="52px" width="52px"></a></li>
          <li class="nav-item"><a class="nav-link" href="upload.php"><img src="css/images/uploadnotes.png" height="40px" width="40px" alt=""></a></li> 

          <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="css/images/circle-user.png" height="40px" width="40px" alt="">
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href=".php">Student</a></li>
            <li><a class="dropdown-item" href="teacher_dash.php">Teacher</a></li>
            <li><a class="dropdown-item" href="admin_dash.php">Admin</a></li>
          </ul>
        </li>
      
        </a></li>
        </ul>
      </div>
    </div>
  </nav>

  <main class="pt-5">
