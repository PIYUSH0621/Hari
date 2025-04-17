<?php 
session_start();
$showALERT = false;
$showERR = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'partials/_dbconnect.php';
    
    $username = $_POST["username"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];

    // Validate username and password length
    if (strlen($username) < 2) {
        $_SESSION['error'] = "Username must be at least 2 characters long";
    } elseif (strlen($password) < 6) {
        $_SESSION['error'] = "Password must be at least 6 characters long";
    } else {
        // Check if username already exists
        $existSql = "SELECT * FROM user_db WHERE username= '$username'";
        $result = mysqli_query($conn, $existSql);
        $numExistRows = mysqli_num_rows($result);

        if ($numExistRows > 0) {
            $_SESSION['error'] = "Username already exists";
        } else {
            if ($password == $cpassword) {
                $sql = "INSERT INTO user_db (username, password, dt) 
                        VALUES ('$username', '$password', current_timestamp())";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    $_SESSION['success'] = "Your account was created successfully!";
                } else {
                    $_SESSION['error'] = "Error in registration";
                }
            } else {
                $_SESSION['error'] = "Passwords do not match";
            }
        }
    }
    
    // Redirect to prevent form resubmission
    header("Location: signup.php");
    exit();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css">
    <title>Sign Up</title>
</head>
<body>
    <?php require 'partials/_nav.php'; ?>

    <div class="container my-4">
        <h1 class="text-center">Sign Up</h1>

        <!-- Success Message -->
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> <?= $_SESSION['success']; ?>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <!-- Error Message -->
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> <?= $_SESSION['error']; ?>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <form action="signup.php" method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="form-control" required minlength="2">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" required minlength="6">
            </div>
            <div class="form-group">
                <label for="cpassword">Confirm Password</label>
                <input type="password" name="cpassword" id="cpassword" class="form-control" required minlength="6">
                <small class="form-text text-muted">Both passwords should be the same</small>
            </div>
            <button type="submit" class="btn btn-primary">Sign Up</button>
        </form>
        <p class="mt-3 text-center">
            Already have an account? <a href="login.php">Login here</a>
        </p>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"></script>
</body>
</html>
