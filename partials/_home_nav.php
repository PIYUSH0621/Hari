<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    if (!isset($_SESSION['username'])) {
        $_SESSION['username'] = "Guest";
    }
}
// for home page aarti tt

date_default_timezone_set("Asia/Kolkata");
$currentTime = date("H:i");

// Aarti Schedule with start and end times
$aartiSchedule = [
    ["06:00", "07:00", "Mangala Aarti"],
    ["10:00", "12:15", "Darshan Aarti"],
    ["12:45", "13:10", "Rajbhog Aarti"],
    ["16:45", "18:15", "Pushp Aarti"],
    ["18:45", "21:30", "Sandhya Aarti"],
    ["22:00", "22:10", "Shayan Aarti"]
];

// Function to get current and next Aarti
function getAartiDetails($currentTime, $aartiSchedule) {
    $currentAarti = "Not open";
    $upcomingAarti = "No Upcoming Aarti";

    foreach ($aartiSchedule as $aarti) {
        $start = $aarti[0];
        $end = $aarti[1];
        $name = $aarti[2];

        // Check if current time falls within an Aarti time range
        if ($currentTime >= $start && $currentTime <= $end) {
            $currentAarti = $name;
        }

        // If an upcoming Aarti is not set and the start time is ahead of the current time
        if ($currentTime < $start && $upcomingAarti == "No Upcoming Aarti") {
            $upcomingAarti = "$name at " . date("g:i A", strtotime($start));
        }}
    return [$currentAarti, $upcomingAarti];
}


// Get Current and Upcoming Aarti
list($currentAarti, $upcomingAarti) = getAartiDetails($currentTime, $aartiSchedule);
?>





<nav class="navbar navbar-expand-lg navbar-light bg-light shadow">
    <div class="container">
        <a class="navbar-brand" href="index.php">Madhusudan, Ulhasnagar</a>
        <button class="navbar-toggler" type="button" id="menuButton">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="chanting.php">Naam Jap</a></li>
                
                <!-- Dropdown for Media with hover effect -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" aria-expanded="false">
                        Media
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="media_audio.php">Audio</a></li>
                        <li><a class="dropdown-item" href="media_img.php">Images</a></li>
                        <li><a class="dropdown-item" href="media_vid.php">videos</a></li>
                        <li><a class="dropdown-item" href="media_book.php">Books</a></li>
                        
                    </ul>
                </li>
                <li class="nav-item"><a class="nav-link" href="donate.php">Donate</a></li>
                <li class="nav-item"><a class="nav-link" href="rvc_shop/home_shop.php">Shop</a></li>
                <li class="nav-item"><a class="nav-link" href="update.php">Updates</a></li>

                
                    <li class="nav-item">
                        <span class="nav-link text-primary">Hello <?php echo htmlspecialchars($_SESSION['username']); ?></span>
                    </li>
                    <?php if (isset($_SESSION['username']) && $_SESSION['username'] !== "Guest"): ?>
                    <li class="nav-item"><a class="nav-link text-danger fw-bold" href="logout.php">Logout</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link text-success fw-bold" href="login.php">Login</a></li>
                <?php endif; ?>

            </ul>
        </div>
    </div>
</nav>

<script>
    document.getElementById("menuButton").addEventListener("click", function () {
        const navMenu = document.getElementById("navbarNav");
        navMenu.classList.toggle("show");
    });
</script>

<style>
    /* Show dropdown on hover */
    .nav-item.dropdown:hover .dropdown-menu {
        display: block;
    }
    .dropdown-menu {
        display: none; /* Hide dropdown initially */
    }
</style>
