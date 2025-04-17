<?php 
// Include the navbar and database file
include('partials/_home_nav.php');
include('partials/_bg_db.php');
include 'feedback.php'; 

// Function to display a random shloka
function displayRandomShloka($shlokas) {
    $shloka = $shlokas[array_rand($shlokas)];
    echo "<div class='shloka-container'>";
    echo "<h2>Chapter {$shloka['chapter']}, Verse {$shloka['verse']}</h2>";
    echo "<div class='shloka-content'>";
    echo "<div class='shloka-text'>{$shloka['text']}</div>";
    echo "<div class='shloka-translation'>{$shloka['translation']}</div>";
    echo "</div>";
    echo "</div>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bhagavad Gita Random Shloka</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        /* Global Styles */
        body {
            font-family: 'Arial', sans-serif; /* Standard font */
            background-color: #f8f9fa;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .shloka-wrapper {
            font-family: 'Arial', sans-serif; /* Standard font */
            text-align: center;
            background-color: #fef8f1;
            padding: 40px 0;
            height: 85vh;
        }

        .shloka-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: 0 auto;
            text-align: center;
            transition: transform 0.3s ease-in-out;
        }

        .shloka-container:hover {
            transform: scale(1.05);
        }

        h1 {
            font-size: 3rem;
            color: #2d7ff9;
            margin-bottom: 20px;
        }

        h2 {
            font-size: 1.5rem;
            color: #2d7ff9;
            margin-bottom: 10px;
        }

        .shloka-content {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 20px;
        }

        .shloka-text, .shloka-translation {
            font-size: 1.2rem;
            line-height: 1.8;
            margin: 10px;
        }

        .shloka-text {
            font-style: italic;
            color: #6b8e23;
        }

        .shloka-translation {
            font-weight: bold;
            color: #555;
        }

        button {
            padding: 15px 30px;
            font-size: 1.1rem;
            background-color: #2d7ff9;
            color: white;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            margin-top: 30px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        button:hover {
            background-color: #1e5bbf;
            transform: scale(1.05);
        }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            h1 {
                font-size: 2rem;
            }

            .shloka-container {
                padding: 20px;
            }

            .shloka-text, .shloka-translation {
                font-size: 1rem;
            }

            button {
                padding: 12px 24px;
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    

    <!-- Shloka Section -->
    <div class="shloka-wrapper">
        <h1>Bhagavad Gita Shloka</h1>
        <?php displayRandomShloka($shlokas); ?>
        <button onclick="window.location.reload();">Get Another Shloka</button>
    </div>

    <?php include 'partials/_footer.php'; ?>

</body>

</html>
