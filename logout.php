<?php
session_start();

// Check if user is logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // Unset all session variables
    $_SESSION = [];

    // Destroy the session
    session_destroy();

    // Redirect to login page with a success message
    header("Location: login.php?logout=success");
    exit;
} else {
    // If not logged in, redirect to login page
    header("Location: login.php");
    exit;
}
?>
