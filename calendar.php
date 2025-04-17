<?php 
include 'partials/_home_nav.php';
include 'feedback.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vaishnav Calendar & Events</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        /* Global container */
        .calendar-wrapper {
            font-family: Arial, sans-serif; 
            text-align: center; 
            background: linear-gradient(135deg, #f8f9fa, #e3f2fd); 
            padding: 5px;
        }

        /* Title Styling */
        .calendar-wrapper h2 { 
            color: #007bff; 
            font-size: 26px;
            margin-bottom: 20px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }

        /* Main layout container */
        .calendar-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            max-width: 1400px; 
            margin: auto;
        }

        /* Sections Styling */
        .calendar-section, .events-section {
            flex: 1;
            min-width: 400px; 
            max-width: 700px;  
            padding: 10px;
            background: white;
            border-radius: 12px;
            box-shadow: 0px 4px 10px rgba(0,0,0,0.15);
        }

        /* Calendar Embed */
        .calendar-section iframe {
            width: 100%;
            height: 600px; 
            border-radius: 10px;
            border: none;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
        }

        /* Events Section */
        .events-section {
            padding: 20px;
            text-align: left;
        }

        /* Events List */
        .events-section ul { 
            list-style-type: none;
            padding: 0;
        }

        .events-section li { 
            background: #ffffff;
            padding: 12px;
            margin: 8px 0;
            border-radius: 8px;
            box-shadow: 0px 3px 8px rgba(0,0,0,0.1);
            font-size: 18px;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .events-section li:hover {
            transform: scale(1.02);
            box-shadow: 0px 5px 12px rgba(0,0,0,0.2);
        }

        /* 🌟 RESPONSIVE STYLING */
        @media (max-width: 992px) {
            .calendar-container {
                flex-direction: column;
                align-items: center;
            }

            .calendar-section, .events-section {
                width: 98%; /* Ensures full width on mobile */
                min-width: unset;
                max-width: 98%;
            }

            .calendar-section iframe {
                height: 450px;
            }

            .events-section h2 {
                font-size: 5vw;
            }

            .events-section li {
                font-size: 4vw;
                padding: 8px;
            }
        }

        @media (max-width: 576px) {
            .calendar-section iframe {
                height: 350px;
            }

            .calendar-wrapper h2 {
                font-size: 6vw;
            }

            .events-section h2 {
                font-size: 6vw;
            }

            .events-section li {
                font-size: 5vw;
            }
        }
    </style>
</head>
<body>

    <div class="calendar-wrapper">
        <br>
        <h2>🗓️ Vaishnav Calendar & Upcoming Events</h2>  
        <div class="calendar-container">
            <!-- Google Calendar Embed -->
            <div class="calendar-section">
                <iframe 
                    src="https://calendar.google.com/calendar/embed?src=52ed66fadbaf2a513ee3d91f153e21133343842647a5365b109cda12971d7cdf@group.calendar.google.com&ctz=Asia/Kolkata">
                </iframe>
            </div>

            <!-- Upcoming Events Section -->
            <div class="events-section">
                <h2>🕉️ Upcoming Events</h2>
                <div id="events">🔄 Loading events...</div>
            </div>
        </div> <br>
    </div>

    <?php 
    include 'partials/_footer.php';
    ?>

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
 

</body>
</html>
