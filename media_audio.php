<?php  
include('partials/_home_nav.php'); 
include 'feedback.php'; 

$category = isset($_GET['category']) ? $_GET['category'] : 'Bhajan';

$categoryMap = [
    'Bhajan' => 'Krishna%20Bhajan',
    'Aarti' => 'ISCKON%20Aarti',
    'Radha_rani' => 'Radharani%20Bhajan'
];

$api_query = isset($categoryMap[$category]) ? $categoryMap[$category] : $categoryMap['Bhajan'];
$api_url = "https://saavn.dev/api/search/songs?query=" . $api_query . "&limit=100"; // Fetch 100 songs

$response = file_get_contents($api_url);
$data = json_decode($response, true);

if (!$data || !$data['success']) {
    echo "<p class='text-danger text-center'>Failed to load content.</p>";
    exit;
}

$bhajans = $data['data']['results'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Devotional Playlist</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Arial', sans-serif; }
        .card {
            border: none;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            border-radius: 12px;
            overflow: hidden;
        }
        .card:hover { transform: translateY(-5px); box-shadow: 0px 6px 20px rgba(0, 0, 0, 0.15); }
        .card img { height: 350px; object-fit: fit; }
        audio { width: 100%; border-radius: 10px; }
        .btn-download { display: block; width: 100%; text-align: center; border-radius: 20px; }
        .category-select {
            width: 10%; font-size: 18px; border-radius: 8px; padding: 8px;
        }
        #seeMoreBtn {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            font-size: 18px;
            background: #28a745;
            color: white;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: 0.3s;
        }
        #seeMoreBtn:hover { background: #218838; }
    </style>
</head>
<body>

<div class="container mt-4">
    <h2 class="text-center fw-bold mb-4">📿 Devotional Playlist</h2>

  <!-- Selection Dropdown -->
<form method="GET" class="text-center mb-4">
    <select name="category" id="category" 
        class="form-select form-select-sm mx-auto" 
        style="width: 15%; display: inline-block;" 
        onchange="this.form.submit()">
        <option value="Bhajan" <?= $category == 'Bhajan' ? 'selected' : '' ?>>🎵 Bhajan</option>
        <option value="Aarti" <?= $category == 'Aarti' ? 'selected' : '' ?>>🙏 Aarti</option>
        <option value="Radha_rani" <?= $category == 'Radha_rani' ? 'selected' : '' ?>>💖 Radha Rani Bhajan</option>
    </select>
</form>


    <div class="row" id="bhajanContainer">
        <?php 
        $initialCount = 9; // Show only 9 initially
        foreach (array_slice($bhajans, 0, $initialCount) as $bhajan): 
            $audioUrl = $bhajan['downloadUrl'][4]['url'] ?? $bhajan['downloadUrl'][0]['url'] ?? '';
            if (!$audioUrl) continue; // Skip if no audio available
        ?>
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4 bhajan-item">
                <div class="card h-100">
                    <img src="<?= $bhajan['image'][2]['url'] ?>" class="card-img-top" alt="<?= $bhajan['name'] ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= $bhajan['name'] ?></h5>
                        <p class="card-text">
                            <strong>🎤 Artist:</strong> <?= $bhajan['artists']['primary'][0]['name'] ?><br>
                            <strong>▶ Play Count:</strong> <?= number_format($bhajan['playCount']) ?>
                        </p>
                        
                        <audio controls>
                            <source src="<?= $audioUrl ?>" type="audio/mpeg">
                            Your browser does not support the audio tag.
                        </audio>

                        <a href="<?= $audioUrl ?>" class="btn btn-success btn-sm mt-2 btn-download" download>⬇ Download</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- See More Button -->
    <button id="seeMoreBtn">See More</button>

</div>
<?php 
  include 'discover.php'; 
  include 'partials/_footer.php'; ?>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        let allAudioElements = document.querySelectorAll("audio");

        allAudioElements.forEach(audio => {
            audio.addEventListener("play", function () {
                allAudioElements.forEach(otherAudio => {
                    if (otherAudio !== audio) {
                        otherAudio.pause();
                        otherAudio.currentTime = 0;
                    }
                });
            });
        });

        let allBhajans = <?= json_encode($bhajans) ?>;
        let currentCount = <?= $initialCount ?>;
        const bhajanContainer = document.getElementById("bhajanContainer");
        const seeMoreBtn = document.getElementById("seeMoreBtn");

        seeMoreBtn.addEventListener("click", function () {
            let nextBatch = allBhajans.slice(currentCount, currentCount + 9);

            nextBatch.forEach(bhajan => {
                let audioUrl = bhajan.downloadUrl[4]?.url || bhajan.downloadUrl[0]?.url || '';
                if (!audioUrl) return;

                let colDiv = document.createElement("div");
                colDiv.className = "col-lg-4 col-md-6 col-sm-12 mb-4 bhajan-item";

                colDiv.innerHTML = `
                    <div class="card h-100">
                        <img src="${bhajan.image[2].url}" class="card-img-top" alt="${bhajan.name}">
                        <div class="card-body">
                            <h5 class="card-title">${bhajan.name}</h5>
                            <p class="card-text">
                                <strong>🎤 Artist:</strong> ${bhajan.artists.primary[0].name} <br>
                                <strong>▶ Play Count:</strong> ${Number(bhajan.playCount).toLocaleString()}
                            </p>
                            
                            <audio controls>
                                <source src="${audioUrl}" type="audio/mpeg">
                                Your browser does not support the audio tag.
                            </audio>

                            <a href="${audioUrl}" class="btn btn-success btn-sm mt-2 btn-download" download>⬇ Download</a>
                        </div>
                    </div>
                `;

                bhajanContainer.appendChild(colDiv);
            });

            currentCount += 9;

            // Attach event listeners to newly added audios
            document.querySelectorAll("audio").forEach(audio => {
                audio.addEventListener("play", function () {
                    document.querySelectorAll("audio").forEach(otherAudio => {
                        if (otherAudio !== audio) {
                            otherAudio.pause();
                            otherAudio.currentTime = 0;
                        }
                    });
                });
            });

            if (currentCount >= allBhajans.length) {
                seeMoreBtn.style.display = "none";
            }
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
