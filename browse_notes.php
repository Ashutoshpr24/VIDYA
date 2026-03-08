<?php
include 'auth.php';
protectPage(['student', 'teacher', 'admin']);

$conn = mysqli_connect("localhost", "root", "", "collegenotes");
$subjects = mysqli_query($conn, "SELECT * FROM subjects");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Browse Notes • VIDYA</title>

<script src="https://cdn.tailwindcss.com"></script>


</head>

<body class="bg-gray-50 text-gray-800">

<!-- HEADER -->
<header class="bg-white shadow-sm">
<div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

<a href="#" class="flex items-center">
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

<h2 class="text-3xl font-bold mb-6">Browse Notes</h2>


<!-- SEARCH BAR -->
<div class="bg-white p-6 rounded-xl shadow mb-8">

<div class="grid md:grid-cols-3 gap-4">

<input
type="text"
id="searchInput"
placeholder="Search by title or description"
class="border rounded-lg px-4 py-2 focus:ring-2 focus:ring-emerald-500 outline-none">

<select
id="subjectFilter"
class="border rounded-lg px-4 py-2 focus:ring-2 focus:ring-emerald-500 outline-none">

<option value="0">All branches</option>

<?php while ($row = mysqli_fetch_assoc($subjects)): ?>

<option value="<?= $row['id'] ?>">
<?= htmlspecialchars($row['name']) ?>
</option>

<?php endwhile; ?>

</select>

<button
id="searchBtn"
class="bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg px-6 py-2">

Search

</button>

</div>

</div>


<!-- NOTES GRID -->
<div id="notesContainer" class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6"></div>

</div>


<script>

const notesContainer = document.getElementById('notesContainer');

function fetchNotes(){

const search = document.getElementById('searchInput').value;
const subject = document.getElementById('subjectFilter').value;

fetch(`browse_notes_process.php?search=${encodeURIComponent(search)}&subject_id=${subject}`)

.then(res => res.json())

.then(notes => {

notesContainer.innerHTML = '';

if(notes.length === 0){

notesContainer.innerHTML =
`<div class="col-span-full text-center text-gray-500">
No notes found
</div>`;

return;
}

notes.forEach(note => {

const card = document.createElement('div');

card.innerHTML = `

<div class="bg-white rounded-xl shadow hover:shadow-xl transition overflow-hidden flex flex-col">

<img
src="${note.image ? note.image : 'css/images/notes1.png'}"
class="w-full h-40 object-cover">

<div class="p-4 flex flex-col flex-grow">

<h3 class="font-semibold text-lg truncate">
${note.title}
</h3>

<p class="text-gray-500 text-sm mt-1">
${note.description.length > 100 ? note.description.substring(0,100)+'...' : note.description}
</p>

<div class="text-sm text-gray-500 mt-3 space-y-1">

<p><strong>Branch:</strong> ${note.subject}</p>
<p><strong>By:</strong> ${note.fullname}</p>
<p><strong>Downloads:</strong> ${note.download_count}</p>

</div>

<a
href="download_note.php?id=${note.note_id}"
class="mt-4 bg-emerald-600 hover:bg-emerald-700 text-white text-center py-2 rounded-lg">

Download

</a>

</div>
</div>

`;

notesContainer.appendChild(card);

});

});

}

fetchNotes();

document.getElementById('searchBtn').addEventListener('click',fetchNotes);

document.getElementById('searchInput').addEventListener('keyup',e=>{
if(e.key==='Enter') fetchNotes();
});

setInterval(fetchNotes,10000);

</script>


<?php
if(isset($_SESSION['role'])){

if($_SESSION['role']==='admin'){
$url='admin_dash.php';
}

elseif($_SESSION['role']==='teacher'){
$url='teacher_dash.php';
}

elseif($_SESSION['role']==='student'){
$url=null;
}

else{
$url='homepage.php';
}

if($url): ?>

<div class="max-w-7xl mx-auto px-6 pb-10">

<a
href="<?php echo $url; ?>"
class="inline-block bg-gray-800 text-white px-6 py-2 rounded-lg hover:bg-black">

Back to Dashboard

</a>

</div>

<?php endif; } ?>


<!-- FOOTER -->
<footer class="bg-gray-900 text-gray-400 py-10 text-center">

© 2026 VIDYA. All rights reserved by Ashutosh Prajapati.

</footer>

</body>
</html>