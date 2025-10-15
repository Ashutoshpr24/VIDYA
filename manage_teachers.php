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
<?php
include 'header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Teachers</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/manage_teachers.css">
  <style>


</style>

</head>
<body class="bg-light">

<div class="container mt-5">
  <h2 class="mb-4">Manage Teachers</h2>

  <?php if ($editTeacher): ?>
  <div class="card mb-4">
    <div class="card-header bg-warning text-dark">
      Edit Teacher (ID: <?php echo $editTeacher['id']; ?>)
    </div>
    <div class="card-body">
      <form method="POST" action="manage_teachers_process.php">
        <input type="hidden" name="update_id" value="<?php echo $editTeacher['id']; ?>">
        <div class="mb-3">
          <label class="form-label">Full Name</label>
          <input type="text" name="fullname" class="form-control" 
                 value="<?php echo htmlspecialchars($editTeacher['fullname']); ?>" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" name="email" class="form-control" 
                 value="<?php echo htmlspecialchars($editTeacher['email']); ?>" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Role</label>
          <select name="role" class="form-control" required>
            <option value="student" <?php if($editTeacher['role'] == 'student') echo 'selected'; ?>>Student</option>
            <option value="teacher" <?php if($editTeacher['role'] == 'teacher') echo 'selected'; ?>>Teacher</option>
          </select>
        </div>
        <button type="submit" class="btn btn-update">Update</button>
        <a href="manage_teachers.php" class="btn btn-secondary">Cancel</a>
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
      <?php while($row = $teachers->fetch_assoc()): ?>
      <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo htmlspecialchars($row['fullname']); ?></td>
        <td><?php echo htmlspecialchars($row['email']); ?></td>
        <td><?php echo htmlspecialchars($row['role']); ?></td>
        <td><?php echo $row['created_at']; ?></td>
        <td>
          <a href="manage_teachers.php?edit=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
          <a href="manage_teachers_process.php?delete=<?php echo $row['id']; ?>" 
             class="btn btn-delete"
             onclick="return confirm('Are you sure you want to delete this teacher?');">Delete</a>
        </td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>

  <a href="admin_dash.php" class="bi bi-box-arrow-right btn btn-dark"> Back to Dashboard</a>
</div>
<?php 
  include 'footer.php'; 
  ?>
</body>
</html>
