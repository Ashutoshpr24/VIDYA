
<?php
include 'auth.php';
include 'manage_notes_process.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Manage Notes • VIDYA</title>

<script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-gray-50 text-gray-800">

<!-- HEADER -->
<header class="bg-white shadow-sm">
<div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

<a href="#">
<img src="css/images/logo vidya1.1.png" class="h-12">
</a>

<nav class="hidden md:flex gap-8 text-sm">

<a href="homepage.php" class="relative group px-1 py-1 text-gray-700 font-medium hover:text-green-800">
Home
<span class="absolute left-0 -bottom-0.5 w-0 h-0.5 bg-green-800 transition-all group-hover:w-full"></span>
</a>

<a href="browse_notes.php" class="relative group px-1 py-1 text-gray-700 font-medium hover:text-green-800">
Browse
<span class="absolute left-0 -bottom-0.5 w-0 h-0.5 bg-green-800 transition-all group-hover:w-full"></span>
</a>

<a href="upload.php" class="relative group px-1 py-1 text-gray-700 font-medium hover:text-green-800">
Upload
<span class="absolute left-0 -bottom-0.5 w-0 h-0.5 bg-green-800 transition-all group-hover:w-full"></span>
</a>

<a href="about.php" class="relative group px-1 py-1 text-gray-700 font-medium hover:text-green-800">
About
<span class="absolute left-0 -bottom-0.5 w-0 h-0.5 bg-green-800 transition-all group-hover:w-full"></span>
</a>

<a href="contact.php" class="relative group px-1 py-1 text-gray-700 font-medium hover:text-green-800">
Contact
<span class="absolute left-0 -bottom-0.5 w-0 h-0.5 bg-green-800 transition-all group-hover:w-full"></span>
</a>

</nav>

<div class="relative group">

<img src="css/images/user-icon.svg" class="w-10 cursor-pointer">

<div class="absolute right-0 hidden group-hover:block bg-white border rounded-lg shadow w-44">

<a href="student_dash.php" class="block px-4 py-2 hover:bg-emerald-600 hover:text-white">
Student Dashboard
</a>

<a href="teacher_dash.php" class="block px-4 py-2 hover:bg-emerald-600 hover:text-white">
Teacher Dashboard
</a>

<a href="admin_dash.php" class="block px-4 py-2 hover:bg-emerald-600 hover:text-white">
Admin Dashboard
</a>

</div>

</div>

</div>
</header>


<!-- PAGE -->
<div class="max-w-7xl mx-auto px-6 py-10">

<h2 class="text-3xl font-bold mb-6">Manage Notes</h2>


<div class="bg-white shadow rounded-xl overflow-hidden">

<table class="w-full text-sm">

<thead class="bg-emerald-600 text-white">
<tr>
<th class="text-left px-4 py-3">ID</th>
<th class="text-left px-4 py-3">Title</th>
<th class="text-left px-4 py-3">Uploaded By</th>
<th class="text-left px-4 py-3">Subject</th>
<th class="text-left px-4 py-3">Status</th>
<th class="text-left px-4 py-3">File</th>
<th class="text-left px-4 py-3">Actions</th>
</tr>
</thead>

<tbody class="divide-y">

<?php if (mysqli_num_rows($result) > 0): ?>

<?php while ($row = mysqli_fetch_assoc($result)): ?>

<tr class="hover:bg-gray-50">

<td class="px-4 py-3"><?= $row['note_id'] ?></td>

<td class="px-4 py-3">
<?= htmlspecialchars($row['title']) ?>
</td>

<td class="px-4 py-3">

<?= $row['fullname']
? htmlspecialchars($row['fullname'])
: '<span class="text-gray-400 italic">Deleted User</span>' ?>

</td>

<td class="px-4 py-3">

<?= $row['subject']
? htmlspecialchars($row['subject'])
: '<span class="text-gray-400">N/A</span>' ?>

</td>

<td class="px-4 py-3">

<?php
if ($row['status'] === 'approved') {
echo '<span class="bg-emerald-100 text-emerald-700 px-2 py-1 rounded text-xs">Approved</span>';
} elseif ($row['status'] === 'rejected') {
echo '<span class="bg-red-100 text-red-700 px-2 py-1 rounded text-xs">Rejected</span>';
} else {
echo '<span class="bg-amber-100 text-amber-700 px-2 py-1 rounded text-xs">Pending</span>';
}
?>

</td>

<td class="px-4 py-3">

<?php if (!empty($row['file_path'])): ?>

<a href="<?= $row['file_path'] ?>" target="_blank"
class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-md text-xs">
View
</a>

<?php else: ?>

<span class="text-gray-400">Missing</span>

<?php endif; ?>

</td>

<td class="px-4 py-3 flex gap-2">

<?php if ($row['status'] === 'rejected'): ?>

<a href="manage_notes_process.php?action=restore&id=<?= $row['note_id'] ?>"
class="bg-amber-500 hover:bg-amber-600 text-white px-3 py-1 rounded-md text-xs">
Restore
</a>

<?php endif; ?>

<a href="manage_notes_process.php?action=delete&id=<?= $row['note_id'] ?>"
onclick="return confirm('Delete permanently? This cannot be undone!')"
class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-md text-xs">
Delete
</a>

</td>

</tr>

<?php endwhile; ?>

<?php else: ?>

<tr>
<td colspan="7" class="text-center text-gray-500 py-6">
No notes found
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

<div class="mt-6">

<a href="<?php echo $url; ?>"
class="inline-block bg-gray-800 text-white px-6 py-2 rounded-lg hover:bg-black">

Back to Dashboard

</a>

</div>

<?php endif; } ?>

</div>


<!-- FOOTER -->
<footer class="bg-gray-900 text-gray-400 py-10 text-center mt-10">

© 2026 VIDYA. All rights reserved by Ashutosh Prajapati.

</footer>

</body>
</html>
