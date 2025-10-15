<?php
include 'auth.php';
protectPage(['admin','teacher']);
include 'manage_students_process.php';

$students = fetchStudents($conn);

$editStudent = null;
if (isset($_GET['edit'])) {
  $id = intval($_GET['edit']);
  $editStudent = fetchStudentById($conn, $id);
}

?>
<?php
include 'header.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Manage Students</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/manage_students.css">
</head>

<body class="bg-light">
  <div class="container mt-5">
    <h2 class="mb-4">Manage Students</h2>

    <?php if ($editStudent): ?>
      <div class="card mb-4">
        <div class="card-header bg-warning text-dark">
          Edit Student (ID: <?php echo $editStudent['id']; ?>)
        </div>
        <div class="card-body">
          <form method="POST" action="manage_students_process.php">
            <input type="hidden" name="update_id" value="<?php echo $editStudent['id']; ?>">
            <div class="mb-3">
              <label class="form-label">Full Name</label>
              <input type="text" name="fullname" class="form-control"
                value="<?php echo htmlspecialchars($editStudent['fullname']); ?>" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="email" name="email" class="form-control"
                value="<?php echo htmlspecialchars($editStudent['email']); ?>" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Role</label>
              <select name="role" class="form-control" required>
                <option value="student" <?php if ($editStudent['role'] == 'student') echo 'selected'; ?>>Student</option>
                <option value="teacher" <?php if ($editStudent['role'] == 'teacher') echo 'selected'; ?>>Teacher</option>
              </select>
            </div>
            <button type="submit" class="btn btn-update">Update</button>
            <a href="manage_students.php" class="btn btn-secondary">Cancel</a>
          </form>
        </div>
      </div>
    <?php endif; ?>

    <table class="table table-bordered table-hover">
      <thead>
        <tr>
          <th>ID</th>
          <th>Full Name</th>
          <th>Email</th>
          <th>Role</th>
          <th>Registered On</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = $students->fetch_assoc()): ?>
          <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo htmlspecialchars($row['fullname']); ?></td>
            <td><?php echo htmlspecialchars($row['email']); ?></td>
            <td><?php echo htmlspecialchars($row['role']); ?></td>
            <td><?php echo $row['created_at']; ?></td>
            <td>
              <a href="manage_students.php?edit=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
              <a href="manage_students_process.php?delete=<?php echo $row['id']; ?>"
                class="btn btn-delete"
                onclick="return confirm('Are you sure you want to delete this student?');">Delete</a>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>

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
        <a href="<?php echo $url; ?>" class="btn btn-dark bi bi-box-arrow-right" style="margin-left: 40px;">
            Back to Dashboard
        </a>
    <?php endif; 
}
?>  </div>
  <?php 
  include 'footer.php'; 
  ?>
</body>
</html>