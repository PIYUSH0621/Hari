<?php
session_start();
include 'partials/_dbconnect.php';

$login = false;
$showError = "";

// Step 1: Login via Phone Number and OTP
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $phone = $_POST["phone"];
    $otp = $_POST["otp"];

    // Step 2: Verify OTP using Firebase
    $enteredOtp = $_POST["otp"];
    if ($enteredOtp == $_SESSION['otp']) {
        $login = true;
        // You can store the login session, user data, etc. here
        $_SESSION['loggedin'] = true;
        $_SESSION['phone'] = $phone;
        header("Location: welcome.php"); // Redirect to your homepage or dashboard
        exit();
    } else {
        $showError = "Invalid OTP. Try again.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login with OTP</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">

    <!-- Firebase SDK -->
    <script src="https://www.gstatic.com/firebasejs/9.0.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.0.0/firebase-auth.js"></script>

    <script>
        // Firebase Configuration
        const firebaseConfig = {
            apiKey: "YOUR_API_KEY", 
            authDomain: "YOUR_AUTH_DOMAIN",
            projectId: "YOUR_PROJECT_ID",
            storageBucket: "YOUR_STORAGE_BUCKET",
            messagingSenderId: "YOUR_MESSAGING_SENDER_ID",
            appId: "YOUR_APP_ID"
        };

        // Initialize Firebase
        const app = firebase.initializeApp(firebaseConfig);
        const auth = firebase.auth();

        // Step 1: Send OTP
        function sendOtp() {
            const phoneNumber = document.getElementById("phone").value;
            const appVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container', {
                'size': 'invisible'
            });

            auth.signInWithPhoneNumber(phoneNumber, appVerifier)
                .then((confirmationResult) => {
                    window.confirmationResult = confirmationResult;
                    alert('OTP sent!');
                })
                .catch((error) => {
                    alert("Error sending OTP: " + error.message);
                });
        }

        // Step 2: Verify OTP
        function verifyOtp() {
            const otp = document.getElementById("otp").value;
            window.confirmationResult.confirm(otp)
                .then((result) => {
                    alert('OTP verified successfully!');
                    document.getElementById("verifyOtpForm").submit();  // Proceed to next step
                })
                .catch((error) => {
                    alert('Invalid OTP. Please try again.');
                });
        }
    </script>
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center">Login with OTP</h2>

        <?php if ($showError): ?>
            <div class="alert alert-danger"><?= $showError; ?></div>
        <?php endif; ?>

        <!-- OTP Request Form (Step 1) -->
        <form method="POST" action="new_login.php">
            <div class="mb-3">
                <label for="phone" class="form-label">Phone Number</label>
                <input type="text" name="phone" id="phone" class="form-control" required>
            </div>

            <div id="recaptcha-container"></div>
            <button type="button" class="btn btn-primary w-100" onclick="sendOtp()">Send OTP</button>
        </form>

        <!-- OTP Verification Form (Step 2) -->
        <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['phone'])): ?>
            <form method="POST" id="verifyOtpForm" action="new_login.php">
                <div class="mb-3">
                    <label for="otp" class="form-label">Enter OTP</label>
                    <input type="text" name="otp" id="otp" class="form-control" required>
                </div>
                <button type="button" class="btn btn-success w-100" onclick="verifyOtp()">Verify OTP</button>
            </form>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
