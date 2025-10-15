<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function protectPage($allowed_roles) {
    $role = null;

    if (isset($_SESSION['role'])) {
        $role = $_SESSION['role']; 
    } elseif (isset($_SESSION['admin_id'])) {
        $role = 'admin';
        $_SESSION['role'] = 'admin';
    }

    if (!$role) {
        header("Location: userlogin.php");
        exit();
    }

    if (!is_array($allowed_roles)) {
        $allowed_roles = [$allowed_roles];
    }

    if (!in_array($role, $allowed_roles)) {
        header("Location: userlogin.php");
        exit();
    }
}
?>
