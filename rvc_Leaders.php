<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Masters</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    
    <style>
        /* Default Styles */
        .leader-photo img {
            width: 100%;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }
        .leader-photo img:hover {
            transform: scale(1.05);
        }

        .leader-content h2 {
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
            margin-top: 15px;
        }
        .leader-content p {
            font-size: 1rem;
            color: #555;
            line-height: 1.6;
        }

        .teachings {
            margin-top: 15px;
        }
        .teachings ul {
            padding-left: 20px;
        }
        .teachings li {
            font-size: 1rem;
            color: #444;
            margin-bottom: 8px;
        }

        /* Animation Styles */
        .animate-left {
            transform: translateX(-100%);
            opacity: 0;
            transition: all 1s ease-in-out;
        }
        .animate-right {
            transform: translateX(100%);
            opacity: 0;
            transition: all 1s ease-in-out;
        }
        .animate-fade {
            opacity: 0;
            transition: opacity 1.5s ease-in-out;
        }
        .show {
            transform: translateX(0);
            opacity: 1;
        }

        /* Mobile Adjustments */
        @media (max-width: 768px) {
            .leader-content h2 {
                font-size: 1.25rem;
            }
            .leader-content p {
                font-size: 0.9rem;
            }
            .leader-photo img {
                border-radius: 8px;
            }

            /* Disable animations on mobile */
            .animate-left, .animate-right, .animate-fade {
                transform: translateX(0);
                opacity: 1;
            }
        }
    </style>
</head>
<body>

    <div class="container my-5">
        <h1 class="text-center mb-4">Our Masters</h1> <br>

        <div class="row">
            <!-- Srila Prabhupada -->
            <div class="col-md-6 col-lg-4 mb-4 animate-left">
                <div class="d-flex flex-column">
                    <div class="leader-photo mb-3">
                        <img src="https://images.pexels.com/photos/30846674/pexels-photo-30846674.jpeg" alt="Abhay Charanaravinda Bhaktivedanta Swami Prabhupada">
                    </div>
                    <div class="leader-content p-3">
                        <h2>Srila Prabhupada</h2>
                        <p>Founder of ISKCON, Srila Prabhupada spread Krishna Consciousness worldwide.</p>
                        <div class="teachings">
                            <ul>
                                <li>Chanting the **Hare Krishna mantra** purifies the soul.</li>
                                <li>Bhagavad Gita teaches **how to live a righteous life**.</li>
                                <li>**Devotional service (Bhakti-yoga)** is the path to God.</li>
                                <li>Establishing **temples** spreads spiritual knowledge.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kirtananda Swami -->
            <div class="col-md-6 col-lg-4 mb-4 animate-fade">
                <div class="d-flex flex-column">
                    <div class="leader-photo mb-3">
                        <img src="https://images.pexels.com/photos/30883146/pexels-photo-30883146.jpeg" alt="Kirtananda Swami">
                    </div>
                    <div class="leader-content p-3">
                        <h2>Srila Bhaktipada</h2>
                        <p>A key disciple of Srila Prabhupada, he emphasized the power of kirtan.</p>
                        <div class="teachings">
                            <ul>
                               <li>**Kirtan (chanting)** brings divine connection.</li>
                                <li>Living in **devotional communities** fosters spiritual growth.</li>
                                <li>Serving God means **serving humanity with love**.</li>
                                <li>Follow the **four regulative principles** (no meat, no intoxication, no gambling, no illicit sex).</li>
                                <li>A simple life dedicated to Krishna leads to true happiness.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Madhusudan Bapuji -->
            <div class="col-md-6 col-lg-4 mb-4 animate-right">
                <div class="d-flex flex-column">
                    <div class="leader-photo mb-3">
                        <img src="https://yt3.googleusercontent.com/ytc/AIdro_mQ1XJAg4580UY25SZJiA-VenOGXJsldazjYqrmOouNyoHj=s900-c-k-c0x00ffffff-no-rj" alt="Madhusudan Bapuji">
                    </div>
                    <div class="leader-content p-3">
                        <h2>Madhusudan Bapuji</h2>
                        <p>A devoted preacher, he built temples and spread Krishna consciousness in India.</p>
                        <div class="teachings">
                            <ul>
                               <li>**Temple worship** brings peace and devotion.</li>
                                <li>**Daily Bhagavad Gita reading** strengthens faith.</li>
                                <li>**Selfless service** is the key to spiritual progress.</li>
                                <li>Spreading **Krishna's name** uplifts society.</li>
                                <li>Satsang (spiritual gatherings) purifies the heart and strengthens devotion. </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Updated JavaScript -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            function animateOnScroll() {
                const elements = document.querySelectorAll(".animate-left, .animate-right, .animate-fade");

                elements.forEach(el => {
                    const rect = el.getBoundingClientRect();
                    const isVisible = rect.top < window.innerHeight - 100; // Adjusted trigger point
                    if (isVisible) {
                        el.classList.add("show");
                    }
                });
            }

            window.addEventListener("scroll", animateOnScroll);
            animateOnScroll(); // Trigger on load in case elements are already visible
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
