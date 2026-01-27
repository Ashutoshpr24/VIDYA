<?php
include 'auth.php';

include 'manage_notes_process.php';
include 'header.php';
?>

<div class="container py-5">

    <h3 class="mb-4">
        <i class="bi bi-journal-text"></i> Manage Notes
    </h3>

    <div class="card shadow">
        <div class="card-body">

            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Uploaded By</th>
                        <th>Subject</th>
                        <th>Status</th>
                        <th>File</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                <?php if (mysqli_num_rows($result) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <!-- NOTE ID -->
                            <td><?= $row['note_id'] ?></td>

                            <td><?= htmlspecialchars($row['title']) ?></td>

                            <!-- USER (NULL-safe) -->
                            <td>
                                <?= $row['fullname']
                                    ? htmlspecialchars($row['fullname'])
                                    : '<span class="text-muted fst-italic">Deleted User</span>' ?>
                            </td>

                            <!-- SUBJECT (NULL-safe) -->
                            <td>
                                <?= $row['subject']
                                    ? htmlspecialchars($row['subject'])
                                    : '<span class="text-muted">N/A</span>' ?>
                            </td>

                            <!-- STATUS -->
                            <td>
                                <?php
                                if ($row['status'] === 'approved') {
                                    echo '<span class="badge bg-success">Approved</span>';
                                } elseif ($row['status'] === 'rejected') {
                                    echo '<span class="badge bg-danger">Rejected</span>';
                                } else {
                                    echo '<span class="badge bg-warning text-dark">Pending</span>';
                                }
                                ?>
                            </td>

                            <!-- FILE -->
                            <td>
                                <?php if (!empty($row['file_path'])): ?>
                                    <a href="<?= $row['file_path'] ?>" target="_blank"
                                       class="btn btn-sm btn-info">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                <?php else: ?>
                                    <span class="text-muted">Missing</span>
                                <?php endif; ?>
                            </td>

                            <!-- ACTIONS (FIXED) -->
                            <td>
                                <?php if ($row['status'] === 'rejected'): ?>
                                    <!-- RESTORE -->
                                    <a href="manage_notes_process.php?action=restore&id=<?= $row['note_id'] ?>"
                                       class="btn btn-sm btn-warning"
                                       title="Restore">
                                        <i class="bi bi-arrow-counterclockwise"></i>
                                    </a>
                                <?php endif; ?>

                                <!-- DELETE PERMANENT -->
                                <a href="manage_notes_process.php?action=delete&id=<?= $row['note_id'] ?>"
                                   onclick="return confirm('Delete permanently? This cannot be undone!')"
                                   class="btn btn-sm btn-danger"
                                   title="Delete">
                                    <i class="bi bi-trash-fill"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center text-muted">
                            No notes found
                        </td>
                    </tr>
                <?php endif; ?>
                </tbody>

            </table>

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

<?php include 'footer.php'; ?>
