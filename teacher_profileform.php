<?php
include 'auth.php';
protectPage(['teacher']);
?>
<?php include 'header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Teacher Profile Form</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/teacher_profileform.css">
</head>
<body>

<div class="container">
  <div class="profile-container">
    <div class="profile-header">
      <h2>Teacher Profile Information</h2>
      <p class="text-muted">Please fill in your professional details.</p>
    </div>

    <form method="POST" action="teacher_profileform_process.php" enctype="multipart/form-data">
      
      <div class="mb-3">
        <label class="form-label">Full Name</label>
        <input type="text" class="form-control" name="fullname" 
               value="<?php echo htmlspecialchars($_SESSION['username']); ?>" readonly>
      </div>

      <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" class="form-control" name="email" 
               value="<?php echo htmlspecialchars($_SESSION['email']); ?>" readonly>
      </div>

      <div class="mb-3">
        <label class="form-label">Qualification</label>
        <input type="text" class="form-control" name="qualification" placeholder="e.g. M.Tech, PhD" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Department</label>
        <input type="text" class="form-control" name="department" placeholder="e.g. Computer Science" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Experience (in years)</label>
        <input type="number" class="form-control" name="experience" placeholder="e.g. 5" min="0" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Contact Number</label>
        <input type="text" class="form-control" name="phone" placeholder="e.g. +91 9876543210" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Profile Picture</label>
        <input type="file" class="form-control" name="profile_pic" accept="image/*">
      </div>

      <div class="text-center">
        <button type="submit" class="btn-save">Save Profile</button>
      </div>
    </form>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php include 'footer.php'; ?>
</body>
</html>
