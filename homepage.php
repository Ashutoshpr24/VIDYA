<?php 
include 'auth.php';
protectPage(['student','teacher','admin']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>VIDYA • Online Learning</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 text-gray-800">

<!-- NAVBAR -->
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


<!-- HERO -->
<section class="relative w-full bg-gray-50 min-h-[69vh]">
  <div class="absolute inset-0">
    <img src="css/images/herosection.jpg" class="w-full h-full object-cover" alt="Hero Background">
    <div class="absolute inset-0 bg-gradient-to-r from-gray-50/50 via-gray-50/20 to-transparent"></div>
  </div>

  <div class="relative max-w-7xl mx-auto px-6 py-32 md:py-40 grid md:grid-cols-2 gap-10 items-center z-10">
    <div>
      <h2 class="text-4xl font-bold leading-tight text-gray-900">
        Online Education <br>
        <span class="text-green-800">Feels Like Real Classroom</span>
      </h2>

      <p class="text-gray-700 mt-4 max-w-md">
        Learn from trusted teachers, download notes, and grow smarter with VIDYA.
      </p>

      <button class="mt-6 px-6 py-3 bg-green-800 text-white rounded-xl">
        Get Started
      </button>
    </div>
  </div>
</section>


<!-- FEATURES -->
<section class="bg-white py-16">
  <div class="max-w-6xl mx-auto px-6 text-center mb-6">
    <h2 class="text-3xl font-bold text-gray-900">Our Highlights</h2>
    <p class="text-gray-500 mt-2">Discover the benefits of learning with VIDYA</p>
  </div>

  <div class="max-w-6xl mx-auto px-6 grid sm:grid-cols-2 lg:grid-cols-4 gap-16">
    <div class="bg-emerald-600 text-white rounded-2xl p-6 text-center shadow transition transform hover:-translate-y-2 hover:shadow-xl hover:bg-gray-100 hover:text-black">
      <h3 class="font-semibold">Best Curriculum</h3>
      <p class="text-sm mt-2">Structured notes by subject & semester.</p>
    </div>

    <div class="bg-emerald-600 text-white rounded-2xl p-6 text-center shadow transition transform hover:-translate-y-2 hover:shadow-xl hover:bg-gray-100 hover:text-black">
      <h3 class="font-semibold">Best Teachers</h3>
      <p class="text-sm mt-2">Content uploaded by verified teachers & toppers.</p>
    </div>

    <div class="bg-emerald-600 text-white rounded-2xl p-6 text-center shadow transition transform hover:-translate-y-2 hover:shadow-xl hover:bg-gray-100 hover:text-black">
      <h3 class="font-semibold">Happy Students</h3>
      <p class="text-sm mt-2">Thousands of downloads every semester.</p>
    </div>

    <div class="bg-emerald-600 text-white rounded-2xl p-6 text-center shadow transition transform hover:-translate-y-2 hover:shadow-xl hover:bg-gray-100 hover:text-black">
      <h3 class="font-semibold">Anytime Access</h3>
      <p class="text-sm mt-2">Learn anytime, anywhere, on any device.</p>
    </div>
  </div>
</section>


<!-- HOW IT WORKS -->
<section class="py-16 max-w-6xl mx-auto px-6">
  <h2 class="text-2xl font-bold text-center mb-10">How VIDYA Works</h2>

  <div class="grid sm:grid-cols-3 gap-8 text-center">
    <div>
      <div class="w-12 h-12 mx-auto bg-emerald-100 rounded-full flex items-center justify-center">1</div>
      <p class="mt-3 font-semibold">Sign Up</p>
      <p class="text-sm text-gray-500">Create your free account</p>
    </div>

    <div>
      <div class="w-12 h-12 mx-auto bg-emerald-100 rounded-full flex items-center justify-center">2</div>
      <p class="mt-3 font-semibold">Browse Notes</p>
      <p class="text-sm text-gray-500">Search subject-wise notes</p>
    </div>

    <div>
      <div class="w-12 h-12 mx-auto bg-emerald-100 rounded-full flex items-center justify-center">3</div>
      <p class="mt-3 font-semibold">Download</p>
      <p class="text-sm text-gray-500">One click PDF access</p>
    </div>
  </div>
</section>


<!-- TESTIMONIAL -->
<section class="bg-white py-16">
  <div class="max-w-6xl mx-auto px-6 grid md:grid-cols-2 gap-10 items-center">
    <div>
      <h2 class="text-2xl font-bold">What Students Say</h2>
      <p class="text-gray-500 mt-4">
        “VIDYA helped me clear my semester easily. Notes are clean and reliable.”
      </p>
      <p class="mt-2 font-semibold">— Engineering Student</p>
    </div>

    <img src="https://cdn-icons-png.flaticon.com/512/2922/2922561.png" class="w-64 mx-auto">
  </div>
</section>


<!-- FAQ -->
<section class="py-16 max-w-6xl mx-auto px-6">
  <h2 class="text-2xl font-bold mb-6">Frequently Asked Questions</h2>

  <div class="space-y-4">
    <div class="bg-emerald-100 p-4 rounded-xl">Are the notes free?</div>
    <div class="bg-emerald-100 p-4 rounded-xl">Can students upload notes?</div>
    <div class="bg-emerald-100 p-4 rounded-xl">Is registration required?</div>
  </div>
</section>

<!-- FOOTER -->
<footer class="bg-gray-900 text-gray-400 py-10 text-center">
  © 2026 VIDYA. All rights reserved by Ashutosh Prajapati.
</footer>

</body>
</html>