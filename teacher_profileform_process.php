<?php
include 'auth.php';
protectPage(['teacher']); 

$conn = mysqli_connect("localhost", "root", "", "collegenotes");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];

    $qualification = trim($_POST['qualification']);
    $branch = trim($_POST['department']); // 'department' field in form maps to 'branch' in DB
    $phone = trim($_POST['phone']);
    $experience = !empty($_POST['experience']) ? intval($_POST['experience']) : 0;
    $profile_image = null;

    if (!empty($_FILES['profile_pic']['name'])) {
        $target_dir = "uploads/profile_pics/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $file_name = time() . "_" . basename($_FILES["profile_pic"]["name"]);
        $target_file = $target_dir . $file_name;

        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        $file_ext = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if (in_array($file_ext, $allowed_types)) {
            if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file)) {
                $profile_image = $target_file;
            }
        }
    }

    $check = $conn->prepare("SELECT profile_id FROM user_profiles WHERE user_id = ?");
    $check->bind_param("i", $user_id);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        if ($profile_image) {
            $sql = "UPDATE user_profiles 
                    SET qualification = ?, branch = ?, phone = ?, experience = ?, profile_image = ?, updated_at = NOW() 
                    WHERE user_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssissi", $qualification, $branch, $phone, $experience, $profile_image, $user_id);
        } else {
            $sql = "UPDATE user_profiles 
                    SET qualification = ?, branch = ?, phone = ?, experience = ?, updated_at = NOW() 
                    WHERE user_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssisii", $qualification, $branch, $phone, $experience, $user_id);
        }
    } else {
        $sql = "INSERT INTO user_profiles (user_id, qualification, branch, phone, experience, profile_image) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isssis", $user_id, $qualification, $branch, $phone, $experience, $profile_image);
    }

    if ($stmt->execute()) {
        echo "<script>alert('✅ Profile saved successfully!'); window.location.href='teacher_dash.php';</script>";
    } else {
        echo "<script>alert('❌ Error saving profile.'); window.history.back();</script>";
    }

    $stmt->close();
    $conn->close();

} else {
    header("Location: teacher_profileform.php");
    exit();
}
?>
