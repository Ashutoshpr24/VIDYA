<?php
include 'auth.php';
protectPage(['student', 'teacher', 'admin']);
include 'header.php';

$conn = mysqli_connect("localhost", "root", "", "collegenotes");
if (!$conn) {
    die("DB connection failed: " . mysqli_connect_error());
}

$subjects = mysqli_query($conn, "SELECT * FROM subjects");
?>
<link rel="stylesheet" href="css/upload.css">
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <?php
            if (isset($_GET['success'])) {
                echo '<div class="alert alert-success">✅ Notes uploaded successfully and waiting for admin/teacher approval!</div>';
            } elseif (isset($_GET['error'])) {
                echo '<div class="alert alert-danger">❌ Error: ' . htmlspecialchars($_GET['error']) . '</div>';
            }
            ?>

            <div class="card shadow">
                <div class="card-header custom-header">
                    <h4>Upload Your Notes</h4>
                </div>
                <div class="card-body">
                    <form action="upload_process.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label">Select Branch</label>
                            <select name="subject_id" class="form-control" required>
                                <option value="">-- Choose Branch --</option>
                                <?php while($row = mysqli_fetch_assoc($subjects)) { ?>
                                    <option value="<?= $row['id'] ?>"><?= htmlspecialchars($row['name']) ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Upload File</label>
                            <input type="file" name="file" class="form-control" accept=".pdf,.doc,.docx,.ppt,.pptx" required>
                        </div>

                        <button type="submit" name="upload" class="mybtn btn-primary w-100">Upload Notes</button>
                    </form>
                </div>
            </div>

        </div>
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

<?php include 'footer.php'; ?>
