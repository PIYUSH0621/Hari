<?php  
// Include the navbar
include 'partials/_home_nav.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>love srvc</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        .hero-section {
            position: relative;
            width: 100%;
            height: 100vh;
            overflow: hidden;
        }

        .hero-section img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0;
            transition: opacity 1s ease-in-out;
        }

        .hero-section img.show {
            opacity: 1;
            animation: zoomEffect 10s ease-in-out forwards;
        }

        @keyframes zoomEffect {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        .hero-section::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 40%;
            background: linear-gradient(to top, rgb(255, 255, 255), rgba(0, 0, 0, 0));
            z-index: 1;
        }

        .content-box {
            position: absolute;
            background: white;
            padding: 20px 30px;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            text-align: center;
            z-index: 2;
            bottom: -2%;
            left: 50%;
            transform: translateX(-50%);
            width: 66%;
            max-width: 96%;
        }

        .content-box h1 {
            font-size: 2rem;
            font-weight: bold;
            color: #333;
        }

        .content-box p {
            font-size: 1rem;
            color: #555;
            margin: 10px 0;
        }

        .footer {
            background-color: #f8f9fa;
            text-align: center;
            padding: 30px 0;
            margin-top: auto;
        }

        .footer p {
            font-size: 1rem;
            color: #555;
        }

        .footer p strong {
            color: #333;
        }

        body, html {
            height: 100%;
        }

        .content-wrapper {
            display: flex;
            flex-direction: column;
        }

        @media (max-width: 768px) {
            .hero-section { height: 60vh; }
            .content-box { width: 97%; padding: 10px; bottom: -5.5%; }
            .content-box h1 { font-size: 1.5rem; }
            .content-box p { font-size: 0.9rem; }
        }
        #typed-text {
    font-size: 2rem;
    font-weight: bold;
    color: #333;
    white-space: nowrap;
    overflow: hidden;
    border-right: 3px solid #ffcc00; /* Cursor effect */
    display: inline-block;
    animation: blinkCursor 0.7s infinite;
}

@keyframes blinkCursor {
    50% { border-color: transparent; }
}


    </style>
</head>
<body>

    <?php if(isset($_SESSION['feedback_success'])): ?>
        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
            <i class="fas fa-check-circle"></i> <?php echo $_SESSION['feedback_success']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['feedback_success']); ?>
    <?php endif; ?>

    <?php if(isset($_SESSION['feedback_error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
            <i class="fas fa-exclamation-triangle"></i> <?php echo $_SESSION['feedback_error']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['feedback_error']); ?>
    <?php endif; ?>

    <div class="content-wrapper">
        <section class="hero-section">
            <div class="hero-image-container">
                <?php 
                $images = [
                    "30824654", "30824674", "30825000", "30824672",
                    "30917877", "30825001", "30824918", "30824673", "30824826","30920003"
                ];
                foreach ($images as $image) {
                    echo '<img src="https://images.pexels.com/photos/' . $image . '/pexels-photo-' . $image . '.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" alt="Image">';
                }
                ?>
            </div>

            <div class="content-box">
            <h2 id="typed-text"></h2>

                <p><strong>Current Darshan :</strong> <?php echo $currentAarti; ?> Darshan</p>
                <p><strong>Upcoming :</strong> <?php echo $upcomingAarti; ?></p>
                

                <div class="row justify-content-center mt-4">
                    <div class="col-auto mb-3">
                        <a href="#" class="btn btn-primary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#aartiModal" style="height: 50px;">Darshan Timing</a>
                    </div>
                    <div class="col-auto mb-3">
                        <a href="temple_map.php" class="btn d-flex align-items-center" style="height: 50px; background-color:rgb(202, 228, 216); border-color: rgb(164, 172, 164);">
                        <i class="fas fa-map-marker-alt" style="color: green; font-size: 24px;"></i>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <div class="modal fade" id="aartiModal" tabindex="-1" aria-labelledby="aartiModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="aartiModalLabel">Aarti Schedule</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Aarti</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($aartiSchedule as $aarti): ?>
                                    <tr>
                                        <td><?php echo date("g:i A", strtotime($aarti[0])); ?></td>
                                        <td><?php echo date("g:i A", strtotime($aarti[1])); ?></td>
                                        <td><?php echo $aarti[2]; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br>
    <?php include 'rvc_Leaders.php'; ?>
    <br>
    <?php include 'old_memory_yt.php'; 
          include 'feedback.php'; 
          include 'discover.php'; 
          include 'partials/_footer.php'; 
          ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const images = document.querySelectorAll('.hero-section img');
        let currentIndex = Math.floor(Math.random() * images.length);
        images[currentIndex].classList.add('show');

        function showNextImage() {
            images[currentIndex].classList.remove('show');
            currentIndex = (currentIndex + 1) % images.length;
            images[currentIndex].classList.add('show');
        }

        setInterval(showNextImage, 10000);
    </script>
    <script>
    const text = "श्री श्री राधा वृन्दावन चन्द्र";  
    let index = 0;

    function typeText() {
        if (index < text.length) {
            document.getElementById("typed-text").innerHTML += text.charAt(index);
            index++;
            setTimeout(typeText, 150); // Adjust speed here (150ms per letter)
        } else {
            document.getElementById("typed-text").style.borderRight = "none"; // Remove cursor after typing
        }
    }

    window.onload = function () {
        setTimeout(typeText, 1000); // Delay before typing starts
    };
</script>

</body>
</html>
