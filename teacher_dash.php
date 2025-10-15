<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'teacher') {
    header("Location: userlogin.php");
    exit();
}
include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Teacher Dashboard | VIDYA</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="css/teacher_dash.css">
<style>

</style>
</head>

<body>
<div class="sidebar">
  <h4 class="text-center mb-4">Teacher Panel</h4>
  <ul class="nav flex-column">
    <li><a href="#" class="nav-link active "><i class="bi bi-speedometer2"></i> Dashboard</a></li>
    <li><a href="manage_students.php" class="nav-link"><i class="bi bi-upload"></i> Manage Students</a></li>
    <li><a href="approve_notes.php" class="nav-link"><i class="bi bi-files"></i> Manage Notes</a></li>
    <li><a href="teacher_profile.php" class="nav-link"><i class="bi bi-person-circle"></i> Profile</a></li>
    <li><a href="logout.php" class="nav-link"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
  </ul>
</div>

<div class="main-content">
  <h2 class="mb-4">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?> 👋</h2>

  <!-- Dashboard Stats -->
  <div class="row mb-4">
    <div class="col-md-3">
      <div class="card card-stat p-3 text-center">
        <h4>12</h4>
        <p>Total Notes Uploaded</p>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card card-stat p-3 text-center">
        <h4>145</h4>
        <p>Total Downloads</p>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card card-stat p-3 text-center">
        <h4>3</h4>
        <p>Pending Approvals</p>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card card-stat p-3 text-center">
        <h4>4.8 ⭐</h4>
        <p>Average Rating</p>
      </div>
    </div>
  </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
