<?php
include 'auth.php';
protectPage(['admin']);
include 'manage_teachers_process.php';

$teachers = fetchTeachers($conn);

$editTeacher = null;
if (isset($_GET['edit'])) {
    $id = intval($_GET['edit']);
    $editTeacher = fetchTeacherById($conn, $id);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Manage Teachers</title>

<script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-gray-100">


<!-- YOUR HEADER -->
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



<div class="max-w-7xl mx-auto px-6 py-10">

<h2 class="text-2xl font-bold text-gray-800 mb-6">
Manage Teachers
</h2>


<?php if ($editTeacher): ?>

<div class="bg-white p-6 rounded-xl shadow mb-8">

<h3 class="text-lg font-semibold text-emerald-700 mb-4">
Edit Teacher (ID: <?php echo $editTeacher['id']; ?>)
</h3>

<form method="POST" action="manage_teachers_process.php">

<input type="hidden" name="update_id"
value="<?php echo $editTeacher['id']; ?>">

<div class="grid md:grid-cols-3 gap-4">

<div>
<label class="block text-sm font-medium text-gray-600 mb-1">
Full Name
</label>

<input type="text"
name="fullname"
class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-emerald-500"
value="<?php echo htmlspecialchars($editTeacher['fullname']); ?>"
required>
</div>


<div>
<label class="block text-sm font-medium text-gray-600 mb-1">
Email
</label>

<input type="email"
name="email"
class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-emerald-500"
value="<?php echo htmlspecialchars($editTeacher['email']); ?>"
required>
</div>


<div>
<label class="block text-sm font-medium text-gray-600 mb-1">
Role
</label>

<select name="role"
class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-emerald-500"
required>

<option value="student"
<?php if($editTeacher['role'] == 'student') echo 'selected'; ?>>
Student
</option>

<option value="teacher"
<?php if($editTeacher['role'] == 'teacher') echo 'selected'; ?>>
Teacher
</option>

</select>
</div>

</div>


<div class="mt-5 flex gap-3">

<button type="submit"
class="bg-emerald-600 text-white px-5 py-2 rounded-lg hover:bg-emerald-700 transition">
Update Teacher
</button>

<a href="manage_teachers.php"
class="bg-gray-300 px-5 py-2 rounded-lg hover:bg-gray-400">
Cancel
</a>

</div>

</form>
</div>

<?php endif; ?>


<!-- TEACHERS TABLE -->

<div class="bg-white shadow rounded-xl overflow-hidden">

<table class="w-full text-sm text-left">

<thead class="bg-emerald-600 text-white">

<tr>
<th class="px-4 py-3">ID</th>
<th class="px-4 py-3">Full Name</th>
<th class="px-4 py-3">Email</th>
<th class="px-4 py-3">Role</th>
<th class="px-4 py-3">Registered On</th>
<th class="px-4 py-3 text-center">Actions</th>
</tr>

</thead>

<tbody>

<?php if ($teachers->num_rows > 0): ?>
<?php while($row = $teachers->fetch_assoc()): ?>

<tr class="border-b hover:bg-gray-50">

<td class="px-4 py-3"><?php echo $row['id']; ?></td>

<td class="px-4 py-3 font-medium">
<?php echo htmlspecialchars($row['fullname']); ?>
</td>

<td class="px-4 py-3">
<?php echo htmlspecialchars($row['email']); ?>
</td>

<td class="px-4 py-3">
<span class="px-2 py-1 text-xs bg-emerald-100 text-emerald-700 rounded">
<?php echo htmlspecialchars($row['role']); ?>
</span>
</td>

<td class="px-4 py-3">
<?php echo $row['created_at']; ?>
</td>

<td class="px-4 py-3 text-center flex justify-center gap-2">

<a href="manage_teachers.php?edit=<?php echo $row['id']; ?>"
class="bg-emerald-500 text-white px-3 py-1 rounded hover:bg-emerald-600 transition">
Edit
</a>

<a href="manage_teachers_process.php?delete=<?php echo $row['id']; ?>"
onclick="return confirm('Are you sure you want to delete this teacher?');"
class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition">
Delete
</a>

</td>

</tr>

<?php endwhile; ?>

<?php else: ?>

<tr>
<td colspan="6" class="text-center py-4 text-gray-500">
No teachers found
</td>
</tr>

<?php endif; ?>

</tbody>
</table>

</div>


<?php
if (isset($_SESSION['role'])) {

if ($_SESSION['role'] === 'admin') {
$url = 'admin_dash.php';
} elseif ($_SESSION['role'] === 'teacher') {
$url = 'teacher_dash.php';
} elseif ($_SESSION['role'] === 'student') {
$url = null;
} else {
$url = 'homepage.php';
}

if ($url): ?>

<a href="<?php echo $url; ?>"
class="inline-block mt-6 bg-gray-800 text-white px-5 py-2 rounded-lg hover:bg-black">
Back to Dashboard
</a>

<?php endif; } ?>

</div>


</body>
</html>
