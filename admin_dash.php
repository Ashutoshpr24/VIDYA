<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: admin_login.php");
    exit();
}
include 'header.php';

// Example dynamic values (later fetch from Db
$total_students = 120;
$total_teachers = 15;
$total_notes = 340;
$total_downloads = 980;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard - VIDYA</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
   <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&family=Schoolbell&display=swap">
   <link rel="stylesheet" href="css/admin_dash.css">

<style>

</style>

</head>
<body class="bg-light">
<div class="d-flex">
  
 <div class="sidebar">
    <div class="navitems">
     <h3> Admin Panel</h3>
    </div>
  <ul class="nav flex-column">
    <li><a href="#" class="nav-link active"><i class="bi bi-speedometer2"></i> Dashboard</a></li>
    <li><a href="manage_students.php" class="nav-link"><i class="bi bi-upload"></i> Manage Students</a></li>
    <li><a href="manage_teachers.php" class="nav-link"><i class="bi bi-person-circle"></i> Manage Teachers</a></li>
    <li><a href="approve_notes.php" class="nav-link"><i class="bi bi-book"></i> Manage Notes</a></li>
    <li><a href="admin_logout.php" class="nav-link"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
  </ul>
</div>


<div class="main-content container-fluid p-4">
 

    <h2><?php echo "Hello, " . $_SESSION['admin_name']; ?></h2>

   
    <div class="row g-3 mb-4">
      <div class="col-md-3"><div class="card p-3 text-center shadow"><h4><?= $total_students ?></h4><p>Students</p></div></div>
      <div class="col-md-3"><div class="card p-3 text-center shadow"><h4><?= $total_teachers ?></h4><p>Teachers</p></div></div>
      <div class="col-md-3"><div class="card p-3 text-center shadow"><h4><?= $total_notes ?></h4><p>Notes Uploaded</p></div></div>
      <div class="col-md-3"><div class="card p-3 text-center shadow"><h4><?= $total_downloads ?></h4><p>Downloads</p></div></div>
    </div>

   
    <div class="row g-3">
      <div class="col-md-8">
        <div class="card p-3 shadow">
          <h5>Notes Uploaded per Month</h5>
          <canvas id="notesChart"></canvas>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card p-3 shadow">
          <h5>Users Breakdown</h5>
          <canvas id="usersChart"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>

<script>

const ctx1 = document.getElementById('notesChart');
new Chart(ctx1, {
    type: 'line',
    data: {
        labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul'],
        datasets: [{
            label: 'Notes Uploaded',
            data: [5, 10, 7, 12, 15, 20, 25],
            borderColor: 'blue',
            fill: true
        }]
    }
});


const ctx2 = document.getElementById('usersChart');
new Chart(ctx2, {
    type: 'doughnut',
    data: {
        labels: ['Students','Teachers'],
        datasets: [{
            data: [<?= $total_students ?>, <?= $total_teachers ?>],
            backgroundColor: ['#36A2EB','#ff5252']
        }]
    }
});
</script>
</body>
</html>
