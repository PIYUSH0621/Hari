<?php
include('partials/_home_nav.php'); include 'feedback.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vaishnav Calendar Events</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        /* Wrap all styles in .events-wrapper to prevent navbar conflicts */
        .events-wrapper {
            font-family: 'Arial', sans-serif;
            text-align: center;
            background: linear-gradient(135deg, #f8f9fa, #e3f2fd);
            padding: 8px;
            margin: 0;
        }

        .events-wrapper h2 {
            color: #007bff;
            font-size: 28px;
            margin-bottom: 20px;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
        }

        .events-container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0px 4px 10px rgba(0,0,0,0.15);
        }

        .events-container ul {
            list-style-type: none;
            padding: 0;
        }

        .events-container li {
            background: #ffffff;
            padding: 15px;
            margin: 10px 0;
            border-radius: 8px;
            box-shadow: 0px 3px 8px rgba(0,0,0,0.1);
            font-size: 18px;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .events-container li:hover {
            transform: scale(1.02);
            box-shadow: 0px 5px 12px rgba(0,0,0,0.2);
        }

        .loading {
            font-size: 20px;
            color: #777;
            font-style: italic;
        }

        @media (max-width: 600px) {
            .events-container {
                width: 99%;
                padding: 15px;
            }
            .events-wrapper h2 {
                font-size: 24px;
            }
            .events-container li {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>

    <div class="events-wrapper">
        <div class="events-container">
            <h2>🗓️ Upcoming Vaishnav Events & Updates</h2>
            <div id="events" class="loading">🔄 Loading events...</div>
        </div>
    </div>

    <script>
        const apiKey = "AIzaSyCI3l-EuISP_0SaYrfynHF_GuMnFvrggYQ"; 
        const calendarId = "52ed66fadbaf2a513ee3d91f153e21133343842647a5365b109cda12971d7cdf@group.calendar.google.com"; 

        async function fetchVaishnavEvents() {
            try {
                const today = new Date().toISOString(); 
                const response = await fetch(
                    `https://www.googleapis.com/calendar/v3/calendars/${calendarId}/events?key=${apiKey}&timeMin=${today}&orderBy=startTime&singleEvents=true`
                );
                const data = await response.json();

                if (!data.items || data.items.length === 0) {
                    document.getElementById("events").innerHTML = "❌ No upcoming events found.";
                    return;
                }

                let events = data.items.slice(0, 10); 
                let htmlContent = "<ul>";

                events.forEach(ev => {
                    let date = new Date(ev.start.date || ev.start.dateTime);
                    htmlContent += `<li><strong>${ev.summary}</strong> - 📅 ${date.toDateString()}</li>`;
                });

                htmlContent += "</ul>";
                document.getElementById("events").innerHTML = htmlContent;
            } catch (error) {
                document.getElementById("events").innerHTML = "❌ Error fetching events.";
                console.error("Error fetching Google Calendar events:", error);
            }
        }

        fetchVaishnavEvents();
    </script>
 
    <?php 
    include 'partials/_footer.php';
    ?>
</body>
</html>
