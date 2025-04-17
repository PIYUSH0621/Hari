<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Festival Videos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }

        .video-section {
            margin: 20px auto;
            padding: 20px;
            background: white;
            border-radius: 12px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
            height :54%
        }

        .scroll-wrapper {
            position: relative;
            padding: 15px 0;
        }

        .scroll-container {
            display: flex;
            overflow-x: auto;
            gap: 15px;
            padding-bottom: 10px;
            scrollbar-width: none;
            scroll-behavior: smooth;
            scroll-snap-type: x mandatory;
        }

        .scroll-container::-webkit-scrollbar {
            display: none;
        }

        .video-card {
            flex: 0 0 auto;
            width: 300px;
            border-radius: 12px;
            scroll-snap-align: start;
            background: white;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: 0.3s;
        }

        .video-card:hover {
            transform: scale(1.05);
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.15);
        }

        .video-card iframe {
            width: 100%;
            height: 265px;
            border-radius: 12px 12px 0 0;
        }

        .video-info {
            padding: 15px;
            text-align: center;
            background: #f9f9f9;
            border-radius: 0 0 12px 12px;
        }

        .video-info h5 {
            font-size: 1.1rem;
            font-weight: bold;
            color: #333;
        }

        .video-info p {
            font-size: 0.9rem;
            color: #555;
        }

        /* Scroll Buttons */
        .scroll-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255, 255, 255, 0.8);
            color: black;
            border: none;
            padding: 10px;
            cursor: pointer;
            font-size: 22px;
            border-radius: 50%;
            z-index: 10;
            transition: 0.3s;
        }

        .scroll-btn:hover {
            background: rgba(0, 0, 0, 0.8);
            color: white;
        }

        .left-btn {
            left: 5px;
        }

        .right-btn {
            right: 5px;
        }

        .scroll-btn:disabled {
            background: rgba(200, 200, 200, 0.8);
            color: gray;
            cursor: not-allowed;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1 class="text-center my-4 text-primary">A few glimpses from the ground</h1> <br>

        <div class="video-section">
            <div class="scroll-wrapper">
                <button class="scroll-btn left-btn" id="left-scroll-btn">&#10094;</button>

                <div class="scroll-container" id="video-scroll">
                    <?php 
                    $videos = [
                        ["feg0WWeZA08", "Maha Abhishek", "2021"],
                        ["Nr8AFtDCRsw", "Jhulan Darshan", "2021"],
                        ["YyWlKBGoCGM", "Beauty of SRVC", "2024"],
                        ["DE8CslEQ17Q", "Radha Ashtami", "2022"],  
                        ["5dRyhsrlta0", "Golden Palace", "2024"],
                        ["q3FE8OulbGs", "Janmashtami", "Aug 26, 2024"],
                        ["vgyL325_114", "Holi", "2023"],
                        ["Bbq3BXGYfU4", "Jagannath Yatra", "2022"],
                        ["3anlq46P1-k", "Wedding", "2019"]
                    ];

                    // Display videos with lazy loading
                    foreach ($videos as $index => $video) {
                        echo '<div class="video-card">
                                <iframe data-src="https://www.youtube.com/embed/' . $video[0] . '" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                <div class="video-info">
                                    <h5>' . $video[1] . '</h5>
                                    <p><small>' . $video[2] . '</small></p>
                                </div>
                              </div>';
                    }
                    ?>
                </div>

                <button class="scroll-btn right-btn" id="right-scroll-btn">&#10095;</button>
            </div>
        </div>
    </div>  <br>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const container = document.getElementById("video-scroll");
            const leftBtn = document.getElementById("left-scroll-btn");
            const rightBtn = document.getElementById("right-scroll-btn");
            const iframes = document.querySelectorAll("iframe");

            function checkScroll() {
                leftBtn.disabled = container.scrollLeft <= 0;
                rightBtn.disabled = container.scrollLeft + container.clientWidth >= container.scrollWidth;
            }

            function scrollLeft() {
                container.scrollBy({ left: -300, behavior: "smooth" });
            }

            function scrollRight() {
                container.scrollBy({ left: 300, behavior: "smooth" });
            }

            leftBtn.addEventListener("click", scrollLeft);
            rightBtn.addEventListener("click", scrollRight);
            container.addEventListener("scroll", checkScroll);

            // Lazy loading for videos
            function lazyLoadVideos() {
                iframes.forEach(iframe => {
                    if (iframe.getBoundingClientRect().top < window.innerHeight) {
                        if (!iframe.src) {
                            iframe.src = iframe.dataset.src;
                        }
                    }
                });
            }

            window.addEventListener("scroll", lazyLoadVideos);
            window.addEventListener("load", lazyLoadVideos);

            checkScroll(); // Initialize button state
        });
    </script>

</body>
</html>
