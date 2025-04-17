<?php  
include('partials/_home_nav.php'); 
include 'feedback.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Darshan</title>
    
    <!-- Elfsight Instagram Feed Script -->
    <script src="https://static.elfsight.com/platform/platform.js" async></script>

    <!-- Bootstrap CSS for Navbar -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        /* Ensure the body and html take full height */
        html, body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        /* Main content wrapper to push footer down */
        .container.instagram-container {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        /* Ensure the footer stays at the bottom */
        footer {
            margin-top: auto;
            width: 100%;
            background-color: #222;
            color: white;
            padding: 10px 0;
        }

        /* Instagram feed container styles */
        .instagram-container {
            max-width: 97%;
            margin: auto;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding-top: 10px; /* To ensure space for the navbar */
        }

        /* Loader Styles */
        .loader {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 200px;
        }

        .spinner {
            width: 50px;
            height: 50px;
            border: 5px solid #ddd;
            border-top: 5px solid #3498db;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Hide Feed Initially */
        .instagram-feed {
            display: none;
        }

        /* Remove Spaces Before and After Images */
        .elfsight-app .elfsight-widget-container {
            margin: 0 !important;  /* Remove space around the feed */
            padding: 0 !important;  /* Remove padding inside the feed */
        }

        .elfsight-app .elfsight-widget-container img {
            margin: 0 !important;  /* Remove space around the images */
            padding: 0 !important; /* Remove padding inside images */
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .instagram-container {
                border-radius: 0;
                box-shadow: none;
            }
        }
    </style>
</head>
<body>

    <!-- Instagram Feed Container -->
    <div class="container instagram-container">
        <!-- Loading Animation -->
        <div class="loader">
            <div class="spinner"></div>
        </div>

        <!-- Instagram Feed Widget -->
        <div class="instagram-feed">
        <div class="elfsight-app-c95417c7-80e4-44e5-b476-2d9de96f01ff" data-elfsight-app-lazy></div>
        </div>
    </div>
    
    <!-- JavaScript to Handle Loading Animation -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            setTimeout(() => {
                document.querySelector(".loader").style.display = "none";
                document.querySelector(".instagram-feed").style.display = "block";
            }, 2000); // 2 seconds delay before feed appears
        });
    </script>

    <?php include 'partials/_footer.php'; ?>

</body>
</html>
