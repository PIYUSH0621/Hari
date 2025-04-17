<?php include('partials/_home_nav.php');
include 'feedback.php';  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Temple Map - Madhusudan Ulhasnagar</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        /* Gradient Background */
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
            margin: 0;
            padding: 0;
            color: #333;
        }

        /* Section Heading */
        .section-title {
            text-align: center;
            font-size: 34px;
            font-weight: bold;
            color: #333;
            padding: 15px;
            margin-top: 20px;
            background: #ffffff;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            display: inline-block;
        }

        /* Main Layout */
        .main-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: flex-start;
            margin: 20px auto;
            gap: 20px;
            max-width: 95%;
        }

        /* Map Container */
        .map-container {
            flex: 1;
            min-width: 350px;
            max-width: 100%;
            height: 500px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
            background: white;
            transition: transform 0.3s ease-in-out;
        }

        .map-container:hover {
            transform: scale(1.02);
        }

        iframe {
            width: 100%;
            height: 100%;
            border: none;
        }

        /* Info Section */
        .info-container {
            flex: 1;
            min-width: 350px;
            max-width: 600px;
            background-color: white;
            color: #333;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0px 5px 25px rgba(0, 0, 0, 0.2);
            text-align: left;
            transition: transform 0.3s ease-in-out;
        }

        .info-container:hover {
            transform: translateY(-5px);
        }

        .info-container h3 {
            font-size: 28px;
            margin-bottom: 15px;
            font-weight: 700;
            color: #007bff;
        }

        .info-container p {
            font-size: 18px;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .info-container ul {
            padding-left: 0;
            list-style: none;
            font-size: 17px;
        }

        .info-container li {
            margin-bottom: 12px;
            display: flex;
            align-items: center;
        }

        .info-container li i {
            margin-right: 10px;
            color: #007bff;
        }

        /* Button Styling */
        .btn-iskcon {
            display: inline-block;
            padding: 14px 25px;
            background-color: #007bff;
            color: white;
            border: none;
            font-size: 18px;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s ease;
            text-decoration: none;
            margin-top: 20px;
        }

        .btn-iskcon:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .main-container {
                flex-direction: column;
                align-items: center;
            }

            .map-container, .info-container {
                width: 100%;
                max-width: 90%;
            }

            .section-title {
                font-size: 30px;
            }
        }

        @media (max-width: 768px) {
            .info-container {
                padding: 20px;
            }

            .map-container {
                height: 400px;
            }

            .section-title {
                font-size: 26px;
            }
        }

        @media (max-width: 480px) {
            .section-title {
                font-size: 24px;
            }

            .info-container {
                padding: 15px;
                font-size: 16px;
            }

            .btn-iskcon {
                font-size: 16px;
                padding: 12px 20px;
            }

            .map-container {
                height: 300px;
                width: 100%;
                min-width: 280px;
            }
        }

    </style>
</head>
<body>

<!-- Section Title -->
<div class="text-center">
    <h3 class="section-title">Madhusudan Temple</h3>
</div>

<!-- Main Container -->
<div class="main-container">
    <!-- Google Map -->
    <div class="map-container">
        <iframe id="iskconMap" 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3767.1040795536896!2d73.15397441083287!3d19.234295281928205!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7943db420f201%3A0xde87e4a12e75d669!2sAnand%20Vrindavan%20Dham!5e0!3m2!1sen!2sin!4v1738909218335!5m2!1sen!2sin" 
            allowfullscreen="" loading="lazy">
        </iframe>
    </div>

    <!-- ISKCON Info -->
    <div class="info-container">
        <h3>ISKCON</h3>
         The International Society for Krishna Consciousness, is a global spiritual movement based on the teachings of Lord Krishna.</p>
        <ul>
            <li><i class="fas fa-book"></i> Scriptures: Bhagavad-gītā & Bhagavat Purana.</li>
            <li><i class="fas fa-music"></i> Chanting: Maha-Mantra (Hare Krishna)</li>
            <li><i class="fas fa-seedling"></i> Values: Promoting vegetarianism, simplicity, and selfless service.</li>
            <li><i class="fas fa-globe"></i> Global Reach: 650+ temples worldwide.</li>
            <li><i class="fas fa-hands-praying"></i> Focus: Devotion, meditation, and community service.</li>
        </ul>
        <a href="https://www.google.com/maps/search/near+by+iskcon+temple/" target="_blank" class="btn-iskcon">
            Find Nearest ISKCON Temple
        </a>
    </div>
</div>

<!-- Footer -->
<?php include 'partials/_footer.php'; ?>

</body>
</html>
