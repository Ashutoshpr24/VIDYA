<?php
include 'auth.php';
protectPage(['teacher']);
include 'header.php';

$conn = mysqli_connect("localhost", "root", "", "collegenotes");
if (!$conn) die("Connection failed: " . mysqli_connect_error());

$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT * FROM user_profiles WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$profile = $result->fetch_assoc();
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Teacher Profile Form • VIDYA</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">


<!-- PAGE -->
<div class="max-w-3xl mx-auto px-6 py-10">
<h2 class="text-3xl font-bold mb-6 text-center">Teacher Profile Form</h2>

<div class="bg-white shadow rounded-xl p-8">

<form method="POST" action="teacher_profileform_process.php" enctype="multipart/form-data" class="space-y-5">

  <div>
    <label class="block text-gray-700 font-medium mb-1">Full Name</label>
    <input type="text" name="fullname" value="<?php echo htmlspecialchars($_SESSION['username']); ?>" readonly
           class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-gray-100 focus:outline-none focus:ring-2 focus:ring-emerald-600">
  </div>

  <div>
    <label class="block text-gray-700 font-medium mb-1">Email</label>
    <input type="email" name="email" value="<?php echo htmlspecialchars($_SESSION['email']); ?>" readonly
           class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-gray-100 focus:outline-none focus:ring-2 focus:ring-emerald-600">
  </div>

  <div>
    <label class="block text-gray-700 font-medium mb-1">Qualification</label>
    <input type="text" name="qualification" placeholder="e.g. M.Tech, PhD" required
           value="<?php echo $profile['qualification'] ?? ''; ?>"
           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-600">
  </div>

  <div>
    <label class="block text-gray-700 font-medium mb-1">Department</label>
    <input type="text" name="branch" placeholder="e.g. Computer Science" required
           value="<?php echo $profile['branch'] ?? ''; ?>"
           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-600">
  </div>

  <div>
    <label class="block text-gray-700 font-medium mb-1">Experience (in years)</label>
    <input type="number" name="experience" placeholder="e.g. 5" min="0" required
           value="<?php echo $profile['experience'] ?? ''; ?>"
           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-600">
  </div>

  <div>
    <label class="block text-gray-700 font-medium mb-1">Contact Number</label>
    <input type="text" name="phone" placeholder="e.g. +91 9876543210" required
           value="<?php echo $profile['phone'] ?? ''; ?>"
           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-600">
  </div>

  <div>
    <label class="block text-gray-700 font-medium mb-1">Profile Picture</label>
    <input type="file" name="profile_image" accept="image/*"
           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-600">

    <!-- Show existing image -->
    <div id="preview" class="mt-3">
      <?php if(!empty($profile['profile_image'])): ?>
        <img src="<?php echo htmlspecialchars($profile['profile_image']); ?>" class="w-32 h-32 rounded-full object-cover border-2 border-emerald-600">
      <?php endif; ?>
    </div>
  </div>

  <div class="text-center">
    <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-2 rounded-lg font-semibold transition">
      Save Profile
    </button>
  </div>

</form>

</div>

<div class="mt-6 text-center">
    <a href="teacher_dash.php" class="inline-block bg-gray-800 hover:bg-black text-white px-6 py-2 rounded-lg">
        Back to Dashboard
    </a>
</div>

</div>

<!-- FOOTER -->
<footer class="bg-gray-900 text-gray-400 py-10 text-center mt-10">
© 2026 VIDYA. All rights reserved by Ashutosh Prajapati.
</footer>

<!-- JS for live preview -->
<script>
const input = document.querySelector('input[name="profile_image"]');
const previewContainer = document.getElementById('preview');

input.addEventListener('change', function(){
  const file = this.files[0];
  if(file){
    const reader = new FileReader();
    reader.onload = function(e){
      previewContainer.innerHTML = `<img src="${e.target.result}" class="w-32 h-32 rounded-full object-cover border-2 border-emerald-600">`;
    }
    reader.readAsDataURL(file);
  }
});
</script>

</body>
</html>