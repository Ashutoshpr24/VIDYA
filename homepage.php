<?php
include 'header.php'; 
include 'auth.php';
protectPage(['student','teacher','admin']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>College Notes Gallery</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap">
  <link rel="stylesheet" href="css/style1.css">
</head>
<body>
  

  <section class="hero">
    <div>
       <h2>
      <?php 
        $name = $_SESSION['username'] ?? $_SESSION['admin_name'] ?? 'Guest';
        echo "Hello, " . htmlspecialchars($name); 
      ?>
      </h2>
      <h1>Vidya Welcomes You</h1>
      <p>Find, Share & Download Study Notes Easily</p>
      <div class="search-bar">
        <input type="text" class="form-control form-control-lg" placeholder="Search notes by subject, semester, or keywords...">
      </div>
    </div>
  </section>
  
  <section class="categories py-5">
    <div class="container">
      <h2 class="text-center mb-4">Browse by Categories</h2>
      <div class="row g-4">
        <div class="col-md-4">
          <div class="card p-4 text-center">
            <h4>Computer Science</h4>
            <p>Programming, Algorithms, Databases</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card p-4 text-center">
            <h4>Electronics</h4>
            <p>Circuits, Signals, Microprocessors</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card p-4 text-center">
            <h4>Electrical</h4>
            <p>Design, Thermodynamics, Materials</p>
          </div>
        </div>
      </div>
    </div>
  </section>


  <section class="about-section py-5 bg-white">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-6 mb-4 mb-md-0">
          <img src="css/images/aboutimg.jpg" alt="About Us" class="img-fluid rounded shadow">
        </div>
        <div class="col-md-6">
          <h2 class="mb-3">About Vidya</h2>
          <p class="text-muted">
            College Notes Gallery is a collaborative platform built for students, by students. We aim to make studying easier by providing a place to share and access high-quality notes, materials, and study resources across various branches and semesters.
          </p>
          <p class="text-muted">
            Whether you're preparing for exams, catching up on missed lectures, or just looking to reinforce your understanding — we’ve got you covered. Join the community, contribute your notes, and empower others while growing together!
          </p>
        </div>
      </div>
    </div>
  </section>
  <?php
  // include 'test.php';
  ?>


  

  


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <?php include 'footer.php'; ?>
</body>
</html>
