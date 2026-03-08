<?php
include 'auth.php';
protectPage(['teacher']); 

$conn = mysqli_connect("localhost", "root", "", "collegenotes");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

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
<title>Teacher Profile • VIDYA</title>
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
        <a href="student_dash.php" class="block px-4 py-2 hover:bg-emerald-600 hover:text-white">Student Dashboard</a>
        <a href="teacher_dash.php" class="block px-4 py-2 hover:bg-emerald-600 hover:text-white">Teacher Dashboard</a>
        <a href="admin_dash.php" class="block px-4 py-2 hover:bg-emerald-600 hover:text-white">Admin Dashboard</a>
      </div>
    </div>

  </div>
</header>

<!-- PAGE -->
<div class="max-w-3xl mx-auto px-6 py-10">

<h2 class="text-3xl font-bold mb-6">Teacher Profile</h2>

<div class="bg-white shadow rounded-xl p-8 flex flex-col items-center gap-4">

    <?php if($profile && $profile['profile_image'] && file_exists($profile['profile_image'])): ?>
        <img src="<?php echo htmlspecialchars($profile['profile_image']); ?>" alt="Profile Picture" class="w-32 h-32 rounded-full object-cover border-2 border-emerald-600">
    <?php else: ?>
        <img src="default_avatar.png" alt="Profile Picture" class="w-32 h-32 rounded-full object-cover border-2 border-emerald-600">
    <?php endif; ?>

    <h3 class="text-2xl font-semibold text-emerald-600"><?php echo htmlspecialchars($_SESSION['username']); ?></h3>
    <p class="text-gray-700"><strong>Email:</strong> <?php echo htmlspecialchars($_SESSION['email']); ?></p>

    <?php if($profile): ?>
        <?php if($profile['qualification']): ?>
            <p class="text-gray-700"><strong>Qualification:</strong> <?php echo htmlspecialchars($profile['qualification']); ?></p>
        <?php endif; ?>

        <?php if($profile['branch']): ?>
            <p class="text-gray-700"><strong>Department:</strong> <?php echo htmlspecialchars($profile['branch']); ?></p>
        <?php endif; ?>

        <?php if($profile['experience'] && $profile['experience'] > 0): ?>
            <p class="text-gray-700"><strong>Experience:</strong> <?php echo htmlspecialchars($profile['experience']); ?> years</p>
        <?php endif; ?>

        <?php if($profile['phone']): ?>
            <p class="text-gray-700"><strong>Contact:</strong> <?php echo htmlspecialchars($profile['phone']); ?></p>
        <?php endif; ?>
    <?php else: ?>
        <p class="text-gray-500 italic text-center">
            Profile not yet created. Please fill your profile information.
        </p>
        <a href="teacher_profileform.php" class="mt-2 bg-amber-500 hover:bg-amber-600 text-white px-6 py-2 rounded-lg">Create Profile</a>
    <?php endif; ?>

    <a href="teacher_profileform.php" class="mt-4 bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-2 rounded-lg">
        Update Profile
    </a>

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

</body>
</html>