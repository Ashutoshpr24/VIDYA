<?php
$conn = mysqli_connect("localhost", "root", "", "collegenotes");
if (!$conn) {
    die("DB connection failed: " . mysqli_connect_error());
}

if (isset($_GET['action']) && isset($_GET['id'])) {
    $note_id = intval($_GET['id']);
    $action = $_GET['action'];

    if ($action === 'approve') {
        mysqli_query($conn, "UPDATE notes SET status='approved' WHERE id=$note_id");
        $msg = "Note approved successfully";
    } elseif ($action === 'reject') {
        
        $res = mysqli_query($conn, "SELECT file_path FROM notes WHERE id=$note_id");
        if ($res && mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            $file = $row['file_path'];
            if (file_exists($file)) {
                unlink($file); 
            }
        }
    
        mysqli_query($conn, "DELETE FROM notes WHERE id=$note_id");
        $msg = "Note rejected and deleted successfully";
    }

    header("Location: approve_notes.php?msg=" . urlencode($msg));
    exit();
} else {
    header("Location: approve_notes.php?msg=" . urlencode("Invalid request"));
    exit();
}
