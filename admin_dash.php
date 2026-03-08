<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: admin_login.php");
    exit();
}

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

<script src="https://cdn.tailwindcss.com"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body class="bg-gray-50">

<!-- HEADER -->
<header class="bg-white shadow-sm">
  <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
    <!-- Logo -->
    <a href="#" class="flex items-center">
      <img src="css/images/logo vidya1.1.png" alt="VIDYA Logo" class="h-12 w-auto">
      <span class="ml-2 text-xl font-bold text-emerald-600 hidden md:inline"></span>
    </a>

    <!-- Nav links -->
    <nav class="hidden md:flex gap-8 text-sm">
      <a href="homepage.php" class="relative group px-1 py-1 text-gray-700 font-medium hover:text-green-800 transition">
        Home
        <span class="absolute left-0 -bottom-0.5 w-0 h-0.5 bg-green-800 transition-all group-hover:w-full"></span>
      </a>

      <a href="browse_notes.php" class="relative group px-1 py-1 text-gray-700 font-medium hover:text-green-800 transition">
        Browse
        <span class="absolute left-0 -bottom-0.5 w-0 h-0.5 bg-green-800 transition-all group-hover:w-full"></span>
      </a>

      <a href="upload.php" class="relative group px-1 py-1 text-gray-700 font-medium hover:text-green-800 transition">
        Upload
        <span class="absolute left-0 -bottom-0.5 w-0 h-0.5 bg-green-800 transition-all group-hover:w-full"></span>
      </a>

      <a href="about.php" class="relative group px-1 py-1 text-gray-700 font-medium hover:text-green-800 transition">
        About
        <span class="absolute left-0 -bottom-0.5 w-0 h-0.5 bg-green-800 transition-all group-hover:w-full"></span>
      </a>

      <a href="contact.php" class="relative group px-1 py-1 text-gray-700 font-medium hover:text-green-800 transition">
        Contact
        <span class="absolute left-0 -bottom-0.5 w-0 h-0.5 bg-green-800 transition-all group-hover:w-full"></span>
      </a>
    </nav>

    <!-- Buttons -->
<div class="relative inline-block group">

<button class="flex items-center focus:outline-none">
<img src="css/images/user-icon.svg"
alt="User"
class="w-10 h-10 hover:scale-105 transition">
</button>

<div class="absolute right-0 top-full w-44 bg-white border rounded-lg shadow-lg hidden group-hover:block z-50">

<a href="student_dash.php" class="block px-4 py-2 text-sm hover:bg-emerald-600 hover:text-white transition">
Student Dashboard
</a>

<a href="teacher_dash.php" class="block px-4 py-2 text-sm hover:bg-emerald-600 hover:text-white transition">
Teacher Dashboard
</a>

<a href="admin_dash.php" class="block px-4 py-2 text-sm hover:bg-emerald-600 hover:text-white transition">
Admin Dashboard
</a>

</div>

</div>
  </div>
</header>


<div class="flex">

<!-- SIDEBAR -->
<div class="w-64 bg-white shadow-md min-h-screen">

<div class="p-6 font-bold text-lg border-b">
Admin Panel
</div>

<nav class="flex flex-col p-4 space-y-2 text-sm">

<a href="#" class="bg-emerald-600 text-white px-4 py-2 rounded-lg">
Dashboard
</a>

<a href="manage_students.php" class="px-4 py-2 rounded-lg hover:bg-gray-100">
Manage Students
</a>

<a href="manage_teachers.php" class="px-4 py-2 rounded-lg hover:bg-gray-100">
Manage Teachers
</a>

<a href="approve_notes.php" class="px-4 py-2 rounded-lg hover:bg-gray-100">
Approve Notes
</a>

<a href="manage_notes.php" class="px-4 py-2 rounded-lg hover:bg-gray-100">
Manage Notes
</a>

<a href="admin_logout.php" class="px-4 py-2 rounded-lg hover:bg-red-500 hover:text-white">
Logout
</a>

</nav>
</div>


<!-- MAIN CONTENT -->
<div class="flex-1 p-8">

<h2 class="text-2xl font-bold mb-6">
<?php echo "Hello, " . $_SESSION['admin_name']; ?>
</h2>


<!-- STAT CARDS -->
<div class="grid md:grid-cols-4 gap-6 mb-8">

<div class="bg-white p-6 rounded-xl shadow text-center">
<h3 class="text-3xl font-bold text-emerald-600"><?= $total_students ?></h3>
<p class="text-gray-500 mt-1">Students</p>
</div>

<div class="bg-white p-6 rounded-xl shadow text-center">
<h3 class="text-3xl font-bold text-emerald-600"><?= $total_teachers ?></h3>
<p class="text-gray-500 mt-1">Teachers</p>
</div>

<div class="bg-white p-6 rounded-xl shadow text-center">
<h3 class="text-3xl font-bold text-emerald-600"><?= $total_notes ?></h3>
<p class="text-gray-500 mt-1">Notes Uploaded</p>
</div>

<div class="bg-white p-6 rounded-xl shadow text-center">
<h3 class="text-3xl font-bold text-emerald-600"><?= $total_downloads ?></h3>
<p class="text-gray-500 mt-1">Downloads</p>
</div>

</div>


<!-- CHARTS -->
<div class="grid md:grid-cols-3 gap-6">

<div class="md:col-span-2 bg-white p-6 rounded-xl shadow">
<h4 class="font-semibold mb-4">Notes Uploaded per Month</h4>
<canvas id="notesChart"></canvas>
</div>

<div class="bg-white p-6 rounded-xl shadow">
<h4 class="font-semibold mb-4">Users Breakdown</h4>
<canvas id="usersChart"></canvas>
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
data: [5,10,7,12,15,20,25],
borderColor: '#059669',
backgroundColor: 'rgba(5,150,105,0.2)',
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
backgroundColor: ['#10b981','#ef4444']
}]
}
});

</script>

</body>
</html>