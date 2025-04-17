<?php
session_start(); // Start session for storing success/error messages

// Database connection
$servername = "localhost";
$username = "root"; // Change if needed
$password = ""; // Change if needed
$database = "acc_login";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form data exists
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['name'], $_POST['email'], $_POST['message'])) {
    // Get form data and sanitize it
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    // Insert into database
    $sql = "INSERT INTO feedback (name, email, message) VALUES ('$name', '$email', '$message')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['feedback_success'] = "Thank you! Your feedback has been submitted successfully.";
    } else {
        $_SESSION['feedback_error'] = "Oops! Something went wrong. Please try again.";
    }

    $conn->close();
    header("Location: ../index.php"); // Redirect back to welcome.php
    exit();
}

$conn->close();
?>
