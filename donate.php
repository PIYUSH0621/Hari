<?php 
ob_start(); // Start output buffering to prevent header errors
include('partials/_home_nav.php'); 
include('partials/_dbconnect.php');
include 'feedback.php'; 

$showSuccess = false;
$showERR = false;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_donation'])) {
    // Check if the user is logged in
    if (!isset($_SESSION['username']) || $_SESSION['username'] === "Guest") {
        $_SESSION['error_message'] = "Error: You must log in to donate.";
        header("Location: login.php");
        exit();
    }

    // Get values from the form
    $username = $_SESSION['username'];
    $cause = $_POST['cause'] ?? '';
    $amount = $_POST['amount'] ?? '';
    $message = $_POST['message'] ?? '';

    // Validate inputs
    if (empty($cause) || empty($amount) || !is_numeric($amount) || $amount <= 0) {
        $_SESSION['error_message'] = "Invalid input! Please select a cause and enter a valid amount.";
        header("Location: donate.php");
        exit();
    }

    $_SESSION['cause'] = $cause;
    $_SESSION['amount'] = $amount;
    $_SESSION['message'] = $message;

    // Show QR Code for payment
    $_SESSION['show_qr'] = true;
    header("Location: donate.php");
    exit();
}

// Handle payment status
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['payment_status'])) {
    // Check if the user is logged in before processing payment
    if (!isset($_SESSION['username']) || $_SESSION['username'] === "Guest") {
        $_SESSION['error_message'] = "Error: You must log in to complete the donation.";
        header("Location: login.php");
        exit();
    }

    $payment_status = $_POST['payment_status'];

    if ($payment_status == "done") {
        // Insert donation details into the database
        $sql = "INSERT INTO donations (username, cause, amount, message) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssds", $_SESSION['username'], $_SESSION['cause'], $_SESSION['amount'], $_SESSION['message']);

        if ($stmt->execute()) {
            $_SESSION['success_message'] = "Thank you for your donation!";
            $_SESSION['show_qr'] = false; // Disable QR display after donation
            echo '<script>window.sessionStorage.setItem("donationComplete", "true");</script>';
        } else {
            $_SESSION['error_message'] = "Error: Could not process the donation.";
        }
        $stmt->close();
    } else {
        $_SESSION['error_message'] = "Payment not completed. Please try again.";
    }

    unset($_SESSION['show_qr']);
    header("Location: donate.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donate</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .cause-selection img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-radius: 15px;
            cursor: pointer;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .cause-selection img:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
        .selected {
            border: 3px solid #007bff;
        }
        .cause-name {
            text-align: center;
            margin-top: 10px;
            font-size: 16px;
            font-weight: bold;
        }
        .form-group {
            margin-top: 20px;
        }
        .alert {
            margin-top: 20px;
        }
        /* QR Section Styling */
        .qr-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            text-align: center;
        }
        .qr-container img {
            max-width: 100%;
            height: auto;
            max-height: 300px;
            margin-top: 20px;
        }
        .qr-container button {
            margin-top: 15px;
            padding: 10px 20px;
            font-size: 16px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .qr-container button:hover {
            background-color: #0056b3;
        }

        /* Responsive Styling */
        @media (max-width: 768px) {
            .cause-selection img {
                height: 200px;
            }
        }
        @media (max-width: 576px) {
            .cause-selection img {
                height: 150px;
            }
            .cause-name {
                font-size: 14px;
            }
        }
    </style>
    <script>
        // Page reload when returning to the donate page
        window.onload = function() {
            if (window.sessionStorage.getItem('donationComplete')) {
                location.reload();
                window.sessionStorage.removeItem('donationComplete');
            }
        };
    </script>
</head>
<body>

<div class="container mt-5">
    <h2>Donate to a Cause</h2>

    <?php 
    if (isset($_SESSION['success_message'])) {
        echo "<div class='alert alert-success'>".$_SESSION['success_message']."</div>";
        unset($_SESSION['success_message']);
    }
    if (isset($_SESSION['error_message'])) {
        echo "<div class='alert alert-danger'>".$_SESSION['error_message']."</div>";
        unset($_SESSION['error_message']);
    }
    ?>

    <?php if (!isset($_SESSION['show_qr'])): ?>
        <!-- Donation Form -->
        <form method="POST" action="donate.php">
            <div class="row mb-4 cause-selection d-flex justify-content-center">
                <div class="col-md-3 mb-3 text-center">
                    <img src="https://static.sadhguru.org/d/46272/1679562685-linga-bhairavi_rituals_gau-seva_20190108_sun_0037-e.jpg"
                     alt="Gau Seva" class="img-fluid cause-image" onclick="selectCause('Gau Seva', this)">
                    <div class="cause-name">Gau Seva</div>
                </div>
                <div class="col-md-3 mb-3 text-center">
                    <img src="https://iskconghaziabad.com/wp-content/uploads/2023/11/bhagavad-gita-6548b4b4d89ab.webp" 
                    alt="Gita Seva" class="img-fluid cause-image" onclick="selectCause('Gita Seva', this)">
                    <div class="cause-name">Gita Seva</div>
                </div>
                <div class="col-md-3 mb-3 text-center">
                    <img src="https://i0.wp.com/www.manishjaishree.com/wp-content/uploads/2018/07/IMG_0905.jpg?ssl=1" 
                    alt="Temple Seva" class="img-fluid cause-image" onclick="selectCause('Temple Seva', this)">
                    <div class="cause-name">Temple Seva</div>
                </div>
                <div class="col-md-3 mb-3 text-center">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSbZVRhUHW5sMgQM9aoRwkJ1MDuwEzRCi36xQ&s"
                     alt="Other" class="img-fluid cause-image" onclick="selectCause('Other', this)">
                    <div class="cause-name">Other</div>
                </div>
            </div>

            <input type="hidden" name="cause" id="selectedCause">
            
            <div class="form-group">
                <label for="amount">Donation Amount (₹):</label>
                <input type="number" class="form-control" name="amount" id="amount" required>
            </div>

            <div class="form-group">
                <label for="message">Message (Optional):</label>
                <textarea class="form-control" name="message" id="message" rows="4"></textarea>
            </div>

            <?php if (!isset($_SESSION['username']) || $_SESSION['username'] === "Guest"): ?>
                <a href="login.php" class="btn btn-warning mt-4">Login to Donate</a>
            <?php else: ?>
                <button type="submit" name="submit_donation" class="btn btn-primary mt-4">Donate</button>
            <?php endif; ?>
        </form>
    <?php else: ?>
        <!-- QR Code Section -->
        <div class="qr-container">
            <h4>Scan the QR Code to Donate</h4>
            <img src="partials/_qr.jpg" alt="QR Code" class="img-fluid mt-3" style="max-width: 300px;">
            
            <form method="POST" action="donate.php">
                <label>Status:</label><br><br>
                <input type="radio" name="payment_status" value="done"> Payment Done<br><br>
                <input type="radio" name="payment_status" value="not_done"> Payment Not Done<br><br>
                <button type="submit" class="btn btn-success mt-2">Submit Payment Status</button>
            </form>
        </div>
    <?php endif; ?>
</div>

<br>
<script>
    function selectCause(cause, element) {
        document.getElementById('selectedCause').value = cause;

        document.querySelectorAll('.cause-image').forEach(img => img.classList.remove('selected'));
        element.classList.add('selected');
    }
</script>
<?php 
    include 'partials/_footer.php';
    ?>

</body>
</html>

<?php ob_end_flush(); // End output buffering ?>
