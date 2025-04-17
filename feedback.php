<?php

$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest'; // Check if user is logged in

// Check for feedback submission success or error
$feedbackMessage = "";
if (isset($_GET['feedback']) && $_GET['feedback'] == 'success') {
    $feedbackMessage = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Thank you!</strong> Your feedback has been submitted successfully.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
} elseif (isset($_GET['feedback']) && $_GET['feedback'] == 'error') {
    $feedbackMessage = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Oops!</strong> Something went wrong. Please try again.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>love srvc</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <style>
        /* Feedback button */
        .feedback-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 50px;
            padding: 15px 20px;
            font-size: 18px;
            cursor: pointer;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease-in-out;
            z-index: 9999; /* Ensure it stays on top */
        }

        .feedback-btn:hover {
            background-color: #0056b3;
            transform: scale(1.1);
        }

        /* Modal styling */
        .modal-content {
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        }

        .modal-header {
            background: linear-gradient(135deg, #007bff, #00c6ff);
            color: white;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .btn-submit {
            background: linear-gradient(135deg, #007bff, #00c6ff);
            border: none;
            padding: 12px;
            font-size: 1rem;
            border-radius: 5px;
            color: #fff;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
        }

        .btn-submit:hover {
            background: linear-gradient(135deg, #0056b3, #00a6ff);
            box-shadow: 0 0 10px rgba(0, 123, 255, 0.4);
        }
    </style>
</head>
<body>

<!-- Feedback Success/Error Message -->
<?php echo $feedbackMessage; ?>

<!-- Feedback Button -->
<button class="feedback-btn" data-bs-toggle="modal" data-bs-target="#feedbackModal">
    <i class="fas fa-comment-alt"></i> Feedback
</button>

<!-- Feedback Modal -->
<div class="modal fade" id="feedbackModal" tabindex="-1" aria-labelledby="feedbackModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="feedbackModalLabel"><i class="fas fa-comment-alt"></i> Share Your Feedback</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="partials/_feed_db.php" method="POST">
                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-user"></i> Your Name</label>
                        <?php if ($username === 'Guest'): ?>
                            <input type="text" class="form-control" name="name"  required>
                        <?php else: ?>
                            <input type="text" class="form-control" name="name" value="<?php echo htmlspecialchars($username); ?>" readonly>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label"><i class="fas fa-envelope"></i> Your Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="message" class="form-label"><i class="fas fa-edit"></i> Your Message</label>
                        <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                    </div>
                    
                    <button type="submit" class="btn-submit w-100"><i class="fas fa-paper-plane"></i> Submit Feedback</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
