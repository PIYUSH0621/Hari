<?php  
// Include the navbar
include 'partials/_home_nav.php';
include 'feedback.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-color: #f4f7fc;
            font-family: 'Arial', sans-serif;
            color: #333;
        }

        .about-section {
            margin-bottom: 50px;
        }

        /* Left Column (Contact Info and Image) */
        .about-photo img {
            width: 95%;
            height: auto;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .contact-info {
            background-color: #fff;
            width:95%;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        .contact-info h4 {
            color: #007bff;
            font-weight: bold;
        }

        .social-links a {
            color: #555;
            text-decoration: none;
            font-size: 1.2rem;
            margin-right: 20px;
            transition: color 0.3s ease;
        }

        .social-links a:hover {
            color: #007bff;
        }

        .social-links i {
            margin-right: 10px;
        }

        .about-content h2 {
            font-size: 2.5rem;
            font-weight: bold;
            color: #333;
            margin-top: 20px;
        }

        .about-content p {
            font-size: 1.1rem;
            color: #555;
            line-height: 1.8;
            margin-top: 15px;
        }

        .about-footer {
            background-color: #007bff;
            color: white;
            text-align: center;
            padding: 30px 0;
            border-radius: 10px 10px 0 0;
            box-shadow: 0 -4px 15px rgba(0, 0, 0, 0.1);
        }

        .about-footer p {
            font-size: 1.2rem;
        }

        .about-footer p strong {
            color: #ffcc00;
        }

        /* Mobile Adjustments */
        @media (max-width: 768px) {
            .about-content h2 {
                font-size: 1.8rem;
            }

            .about-content p {
                font-size: 1rem;
            }

            .about-photo img {
                border-radius: 10px;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            }

            .social-links {
                text-align: center;
            }

            .contact-info {
                margin-top: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <h1 class="text-center mb-4">About Us</h1>

        <!-- About Section -->
        <div class="row about-section">
            
            <!-- Left Column (Contact Info and Image) -->
            <div class="col-md-6 col-sm-12 mb-4">
                <br>
                <div class="about-photo p-3">
                    <img src="https://images.pexels.com/photos/30825154/pexels-photo-30825154.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" alt="About Image" class="img-fluid">
                </div>
                <div class="contact-info p-3">
                    <h4>Contact Us</h4> <br>
                    <p><strong>Email:</strong> Lovesrvc03@gmail.com</p>
                    <p><strong>Phone:</strong> 
                    7498565697</p>
                </div>
                
            </div>

            <!-- Right Column (Content Section) -->
            <div class="col-md-6 col-sm-12 mb-4">
                <div class="about-content p-4">
                    <h2>Who We Are</h2>
                    <p>Welcome to our website! We are a spiritual community dedicated to spreading the teachings of Lord Krishna and promoting devotional practices. Our mission is to provide a sanctuary for devotees and seekers alike, offering a space for spiritual growth, chanting, meditation, and service to others.</p>
                    <p>Our center is a place where individuals come together to practice the art of devotion through chanting, prayer, and study of sacred scriptures like the Bhagavad Gita and Srimad Bhagavatam. We strive to create an inclusive and supportive environment for all those who wish to deepen their spiritual practice and understanding of the Divine.</p>
                    <p>We invite you to explore our teachings, join us in our events, and experience the transformative power of devotion.</p>
                    <br>
                    <h4>Join Us On</h4>
                    <br>
                <div class="social-links">
                    <a href="https://www.facebook.com/ShriMadhusudanBapuji"><i class="fab fa-facebook"></i>Facebook</a>
                    <a href="https://chat.whatsapp.com/GFN2kOBx9wR0eLNZluoCX6"><i class="fab fa-whatsapp"></i>WhatsApp</a> <br> <br>
                    <a href="https://www.instagram.com/shri_krishna_bhakt_parivar"><i class="fab fa-instagram"></i>Instagram</a>
                    <a href="https://youtube.com/@shrimadhusudanbapuji"><i class="fab fa-youtube"></i>YouTube</a>
                </div>
                </div>
                
            </div>
        </div>
    </div>

    <!-- Footer Section -->
    <footer class="about-footer">
        <p>&copy; 2025 Madhusudan, Ulhasnagar. All Rights Reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
