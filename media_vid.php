<?php

include('partials/_home_nav.php');
include 'feedback.php';  

// YouTube Playlists
$playlists = [
    "Mahabharat Drama" => "PLFr_jkwUp0hiLGbvRIvIlzXlblgNbDbob",
    "Lectures" => "PLXsm49VKXVj5DxH3XYvZ-ZuPaLVfPMeeJ"
];

// Search-based categories
$categories = [
    "Krishna Cartoons" => "little Krishna cartoon",
    "Bhajan & Songs" => "Krishna bhajan"
];

$allCategories = array_merge(array_keys($playlists), array_keys($categories));
$selectedCategory = $_GET['category'] ?? 'Lectures';

function fetchPlaylistVideos($playlistId) {
    $playlistUrl = "https://www.youtube.com/playlist?list=" . $playlistId;
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $playlistUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0');

    $html = curl_exec($ch);
    curl_close($ch);

    preg_match_all('/"videoId":"(.*?)"/', $html, $matches);
    $videoIds = array_unique($matches[1]);

    $videos = [];
    foreach ($videoIds as $id) {
        $videos[] = [
            "videoId" => $id,
            "thumbnail" => "https://i.ytimg.com/vi/$id/hqdefault.jpg"
        ];
    }
    return $videos;
}

function fetchYouTubeVideos($query) {
    $searchUrl = "https://www.youtube.com/results?search_query=" . urlencode($query);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $searchUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0');

    $html = curl_exec($ch);
    curl_close($ch);

    preg_match_all('/"videoId":"(.*?)"/', $html, $matches);
    $videoIds = array_unique($matches[1]);

    $videos = [];
    foreach ($videoIds as $id) {
        $videos[] = [
            "videoId" => $id,
            "thumbnail" => "https://i.ytimg.com/vi/$id/hqdefault.jpg"
        ];
    }
    return $videos;
}

if (isset($playlists[$selectedCategory])) {
    $videos = fetchPlaylistVideos($playlists[$selectedCategory]);
} elseif (isset($categories[$selectedCategory])) {
    $videos = fetchYouTubeVideos($categories[$selectedCategory]);
} else {
    $videos = [];
}

$defaultVideoId = !empty($videos) ? $videos[0]['videoId'] : 'dQw4w9WgXcQ';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Devotional Videos</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        h2 {
            color: #333;
            margin-bottom: 10px;
            text-align: center;
        }

        select {
            padding: 10px;
            font-size: 16px;
            border-radius: 8px;
            border: 1px solid #ddd;
            background: white;
            cursor: pointer;
            transition: 0.3s;
        }

        select:hover {
            background: #e9ecef;
        }

        .video-player {
            width: 94%;
            max-width: 800px;
            margin: 20px auto;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            overflow: hidden;
        }

        iframe {
            width: 100%;
            height: 400px;
            border: none;
            border-radius: 10px;
        }

        .video-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
            padding: 20px;
        }

        .video-item {
            width: 300px;
            cursor: pointer;
            display: none;
            transition: 0.3s;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.15);
        }

        .video-item img {
            width: 100%;
            border-radius: 10px;
            transition: transform 0.3s ease-in-out;
        }

        .video-item img:hover {
            transform: scale(1.1);
        }

        .see-more {
            margin: 20px;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            background: linear-gradient(45deg, #007bff, #00c3ff);
            color: white;
            cursor: pointer;
            border-radius: 5px;
            transition: 0.3s;
        }

        .see-more:hover {
            background: linear-gradient(45deg, #0056b3, #0099cc);
        }
        
        @media (max-width: 768px) {
            .video-player iframe {
                height: 250px;
            }
            
            .video-grid {
                flex-direction: column;
                align-items: center;
            }

            .video-item {
                width: 90%;
            }
        }

        @media (max-width: 480px) {
            h2 {
                font-size: 20px;
            }

            select {
                font-size: 14px;
                padding: 8px;
            }

            .video-player iframe {
                height: 200px;
            }

            .video-item {
                width: 100%;
                max-width: 400px;
            }

            .see-more {
                font-size: 14px;
                padding: 8px 16px;
            }
        }
    </style>
    <script>
        function playVideo(videoId) {
            document.getElementById("videoFrame").src = "https://www.youtube.com/embed/" + videoId;
            document.querySelector(".video-player").scrollIntoView({ behavior: "smooth", block: "start" });
        }

        function loadMore(categoryClass) {
            let videos = document.querySelectorAll("." + categoryClass);
            let shown = 0;

            videos.forEach((video) => {
                if (video.style.display === "none" && shown < 4) {
                    video.style.display = "block";
                    shown++;
                }
            });

            if (Array.from(videos).every(video => video.style.display !== "none")) {
                document.getElementById(categoryClass + "-toggle").style.display = "none";
            }
        }

        function changeCategory() {
            let selectedCategory = document.getElementById("categorySelect").value;
            window.location.href = "?category=" + encodeURIComponent(selectedCategory);
        }
    </script>
</head>
<body> <br>
    <h2>Video Playlists</h2>
    <h2> 
        <select id="categorySelect" onchange="changeCategory()">
            <?php
            foreach ($allCategories as $category) {
                $selected = ($category === $selectedCategory) ? "selected" : "";
                echo "<option value='$category' $selected>$category</option>";
            }
            ?>
        </select>
    </h2>

    <div class="video-player">
        <iframe id="videoFrame" src="https://www.youtube.com/embed/<?php echo $defaultVideoId; ?>" allowfullscreen></iframe>
    </div>

    <h2><?php echo htmlspecialchars($selectedCategory); ?></h2>
    <div class='video-grid'>
        <?php
        $categoryClass = preg_replace('/[^a-z0-9]+/i', '-', strtolower($selectedCategory));

        foreach ($videos as $index => $video) {
            $displayStyle = ($index < 8) ? "display: block;" : "display: none;";
            echo "
            <div class='video-item $categoryClass' style='$displayStyle' onclick='playVideo(\"{$video['videoId']}\")'>
                <img src='{$video['thumbnail']}' alt='Video Thumbnail'>
            </div>";
        }

        if (count($videos) > 8) {
            echo "<button id='$categoryClass-toggle' class='see-more' onclick='loadMore(\"$categoryClass\")'>See More</button>";
        }
        ?>
    </div>

    <?php 
    include 'discover.php'; 
     include 'partials/_footer.php'; ?>
</body>
</html>
