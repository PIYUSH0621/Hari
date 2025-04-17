<?php include 'partials/_home_nav.php'; ?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Krishna Chanting</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to bottom, #fefefe, #e3f2fd);
            color: #333;
        }

        .content-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
        }

        .chanting-container {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
            text-align: center;
        }

        .chant-display {
            font-size: 75px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #6a11cb;
            transition: transform 0.2s ease-in-out;
        }

        .btn-chant {
                width: 100%;
                max-width: 160px;
                font-size: 18px;
                font-weight: bold;
                border-radius: 30px;
                margin: 10px;
                padding: 12px;
                background: linear-gradient(to right, #6a11cb, #2575fc);
                color: white !important; /* Ensures white text */
                border: none;
                transition: all 0.3s ease-in-out;
            }

            .btn-chant:hover {
                background: linear-gradient(to right, #2575fc, #6a11cb);
                transform: scale(1.05);
                color: white !important; /* Ensures white text on hover */
            }


        .progress-container {
            width: 100%;
            max-width: 400px;
            background: #d6f5d6;
            border-radius: 25px;
            overflow: hidden;
            margin-top: 20px;
            height: 12px;
        }

        .progress-bar {
            height: 100%;
            width: 0%;
            background: linear-gradient(to right, #32CD32, #2E8B57);
            transition: width 0.3s ease-in-out;
        }

        .message {
            font-size: 18px;
            font-weight: bold;
            margin-top: 20px;
            color: #2E8B57;
            display: block;
        }

        .round-popup {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 20px;
            border-radius: 10px;
            font-size: 22px;
            font-weight: bold;
            display: none;
            text-align: center;
            animation: fadeInOut 3s ease-in-out;
        }

        @keyframes fadeInOut {
            0% { opacity: 0; transform: translate(-50%, -50%) scale(0.9); }
            50% { opacity: 1; transform: translate(-50%, -50%) scale(1); }
            100% { opacity: 0; transform: translate(-50%, -50%) scale(0.9); }
        }

    </style>
</head>
<body>

<div class="content-container">
    <p class="mantra" style="font-size: 22px; font-weight: bold; text-align: center; color: #444;">
        Hare Krishna Hare Krishna Krishna Krishna Hare Hare <br>
        Hare Ram Hare Ram Ram Ram Hare Hare <br><br>
    </p>
    
    <div class="chanting-container">
        <h1 class="mb-4" style="color: #6a11cb;">Chanting Counter</h1>
        
        <h2 id="chantDisplay" class="chant-display">0</h2>
        <div class="progress-container">
            <div id="progressBar" class="progress-bar"></div>
        </div><br>
        
        <div class="d-flex justify-content-center flex-wrap">
        <button class="btn btn-chant" onclick="incrementCount()" style="color: white !important;">Chant</button>
        <button class="btn btn-chant" onclick="decrementCount()" style="color: white !important;">Reverse</button>

        </div>
        
        <button class="btn btn-danger btn-chant" onclick="resetCount()">Reset</button>
        <p id="message" class="message">Completed Rounds: <span id="roundsCompleted">0</span></p>
    </div>

    <div id="roundPopup" class="round-popup">🎉 Round Completed! 🎉</div>
</div>

<script>
    let count = localStorage.getItem("chantCount") ? parseInt(localStorage.getItem("chantCount")) : 0;
    let roundsCompleted = localStorage.getItem("roundsCompleted") ? parseInt(localStorage.getItem("roundsCompleted")) : 0;

    document.addEventListener("DOMContentLoaded", function () {
        updateUI();
    });

    function incrementCount() {
        count++;
        if (count > 108) {
            count = 1;
            roundsCompleted++;
            showRoundPopup();
        }
        saveData();
        updateUI();
    }

    function decrementCount() {
        if (count > 0) {
            count--;
            saveData();
            updateUI();
        }
    }

    function resetCount() {
        count = 0;
        roundsCompleted = 0;
        saveData();
        updateUI();
    }

    function saveData() {
        localStorage.setItem("chantCount", count);
        localStorage.setItem("roundsCompleted", roundsCompleted);
    }

    function updateUI() {
        document.getElementById("chantDisplay").innerText = count;
        document.getElementById("roundsCompleted").innerText = roundsCompleted;
        let progress = (count / 108) * 100;
        document.getElementById("progressBar").style.width = progress + "%";
    }

    function showRoundPopup() {
        let popup = document.getElementById("roundPopup");
        popup.style.display = "block";
        setTimeout(() => {
            popup.style.display = "none";
        }, 3000);
    }

    document.addEventListener("keydown", function(event) {
        if (event.key === "Tab") {
            event.preventDefault();
            incrementCount();
        }
    });
</script>

<?php 
include 'discover.php'; 
include 'partials/_footer.php' ?>

</body>
</html>
