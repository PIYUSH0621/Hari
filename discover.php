<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discover More</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f9f9f9;
        }
        .discover-section {
            border-radius: 2%;
            margin: 2%;
            text-align: center;
            padding: 80px 20px;
            background-color: #fff;
        }
        .discover-title {
            font-size: 40px;
            font-weight: bold;
            color: #3a2171;
            margin-bottom: 50px;
            opacity: 0;
            transform: translateY(-20px);
            animation: fadeIn 1s ease-out forwards;
        }
        .discover-items {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 0.1%;
            justify-items: center;
            align-items: center;
        }
        .discover-item {
            text-align: center;
            width: 100%;
            max-width: 220px;
            opacity: 0;
            transition: transform 0.4s ease-in-out;
        }
        .discover-item.show {
            opacity: 1;
        }
        .discover-item a {
            text-decoration: none;
            display: block;
        }
        .discover-item img {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid #3a2171;
            transition: transform 0.3s ease-in-out;
        }
        .discover-item img:hover {
            transform: scale(1.1);
        }
        .discover-item p {
            margin-top: 15px;
            font-size: 22px;
            font-weight: bold;
            color: #3a2171;
            transition: transform 0.3s ease-in-out;
        }
        .discover-item p:hover {
            transform: scale(1.1);
        }
        /* Scroll Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        /* Responsive */
        @media (max-width: 992px) {
            .discover-items {
                gap: 30px;
            }
        }
        @media (max-width: 576px) {
            .discover-items {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

    <section class="discover-section">
        <h2 class="discover-title">Discover More</h2> <br> <br>
        <div class="discover-items">
            <div class="discover-item">
                <a href="daily_darshan.php">
                    <img src="https://images.pexels.com/photos/30920209/pexels-photo-30920209.jpeg?auto=compress&cs=tinysrgb&w=800&lazy=load" alt="Daily Darshan">
                    <p>Daily Darshan</p>
                </a>
            </div>
            <div class="discover-item">
                <a href="chanting.php">
                    <img src="https://www.naamjapa.com/wp-content/uploads/2024/01/How-Many-Beads-in-a-Japa-Mala-768x492.jpg" alt="Naam Jap">
                    <p>Naam Jap</p>
                </a>
            </div>
            <div class="discover-item">
                <a href="bg_game.php">
                    <img src="https://shubhmandir.com/wp-content/uploads/2020/03/chapter-1-bhagwat-gita.jpg" alt="One Shlok Each Day">
                    <p>One Shlok Each Day</p>
                </a>
            </div>
            <div class="discover-item">
                <a href="calendar.php">
                    <img src="https://images.pexels.com/photos/30920318/pexels-photo-30920318.jpeg?auto=compress&cs=tinysrgb&w=800&lazy=load" alt="Vaishnav Calendar">
                    <p>Vaishnav Calendar</p>
                </a>
            </div>
        </div>
    </section>
    <br>

    <script>
        // Fade-in animation on scroll
        $(document).ready(function() {
            function revealElements() {
                $(".discover-item").each(function(i) {
                    let elementTop = $(this).offset().top;
                    let windowBottom = $(window).scrollTop() + $(window).height();
                    if (elementTop < windowBottom - 50) {
                        $(this).addClass("show");
                    }
                });
            }
            $(window).on("scroll", revealElements);
            revealElements();
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
