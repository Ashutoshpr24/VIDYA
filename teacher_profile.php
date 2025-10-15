<?php
include 'auth.php';
protectPage(['teacher']); 
include 'header.php';


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
    <title>Teacher Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/teacher_profile.css">
</head>
<body>

<div class="container">
    <div class="profile-card">
        <?php if($profile && $profile['profile_image'] && file_exists($profile['profile_image'])): ?>
            <img src="<?php echo htmlspecialchars($profile['profile_image']); ?>" alt="Profile Picture">
        <?php else: ?>
            <img src="default_avatar.png" alt="Profile Picture">
        <?php endif; ?>

        <h3><?php echo htmlspecialchars($_SESSION['username']); ?></h3>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($_SESSION['email']); ?></p>

        <?php if($profile): ?>
            <?php if($profile['qualification']): ?>
                <p><strong>Qualification:</strong> <?php echo htmlspecialchars($profile['qualification']); ?></p>
            <?php endif; ?>

            <?php if($profile['branch']): ?>
                <p><strong>Department:</strong> <?php echo htmlspecialchars($profile['branch']); ?></p>
            <?php endif; ?>

            <?php if($profile['experience'] && $profile['experience'] > 0): ?>
                <p><strong>Experience:</strong> <?php echo htmlspecialchars($profile['experience']); ?> years</p>
            <?php endif; ?>

            <?php if($profile['phone']): ?>
                <p><strong>Contact:</strong> <?php echo htmlspecialchars($profile['phone']); ?></p>
            <?php endif; ?>
        <?php else: ?>
            <p class="text-muted">Profile not yet created. Please fill your profile information. <br>
           <h6 class="mybtn"><a href="teacher_profileform.php">Create Profile </a></h6></p>
        <?php endif; ?>
        <h6 class="mybtn"><a href="teacher_profileform.php">Update Profile</a></h6>
    </div>
    <a href="teacher_dash.php" class="btn btn-dark bi bi-box-arrow-right"> Back to Dashboard</a>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php include 'footer.php'; ?>
</body>
</html>
