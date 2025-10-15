<?php
include 'auth.php';
protectPage(['admin', 'teacher']);

$conn = mysqli_connect("localhost", "root", "", "collegenotes");
if (!$conn) {
    die("DB connection failed: " . mysqli_connect_error());
}

$result = mysqli_query($conn, "
    SELECT notes.id, notes.title, notes.description, notes.file_path, users.fullname, subjects.name AS subject 
    FROM notes
    JOIN users ON notes.user_id = users.id
    JOIN subjects ON notes.subject_id = subjects.id
    WHERE notes.status='pending'");
?>

<?php include 'header.php'; ?>

<div class="container py-5">
    <div class="row">
        <div class="col-md-12">

            <h3 class="mb-4">Pending Notes for Approval</h3>

            <?php if (isset($_GET['msg'])): ?>
                <div class="alert alert-success">
                    <?= htmlspecialchars($_GET['msg']) ?>
                </div>
            <?php endif; ?>
            

            <div class="card shadow">
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Uploaded By</th>
                                <th>Subject</th>
                                <th>File</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                    <td><?= $row['id'] ?></td>
                                    <td><?= htmlspecialchars($row['title']) ?></td>
                                    <td><?= htmlspecialchars($row['description']) ?></td>
                                    <td><?= htmlspecialchars($row['fullname']) ?></td>
                                    <td><?= htmlspecialchars($row['subject']) ?></td>
                                    <td><a href="<?= $row['file_path'] ?>" target="_blank" class="btn btn-sm btn-info">View</a></td>
                                    <td>
                                        <a href="approve_notes_process.php?action=approve&id=<?= $row['id'] ?>" class="btn btn-success btn-sm">Approve</a>
                                        <a href="approve_notes_process.php?action=reject&id=<?= $row['id'] ?>" class="btn btn-danger btn-sm">Reject</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                    <?php if (mysqli_num_rows($result) == 0): ?>
                        <p class="text-muted">No pending notes right now 🎉</p>
                    <?php endif; ?>
                </div>
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
        <a href="<?php echo $url; ?>" class="btn btn-dark bi bi-box-arrow-right" style="margin-left: 40px;">
            Back to Dashboard
        </a>
    <?php endif; 
}
?>
              
        </div>
        
    </div>
    
</div>


<?php include 'footer.php'; ?>
