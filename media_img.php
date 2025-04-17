<?php  
include('partials/_home_nav.php');
include 'feedback.php';  
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Responsive Image Gallery</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    h1 {
      text-align: center;
      margin-bottom: 30px;
    }
    .gallery-img {
      width: 100%;
      height: 100%;
      object-fit: cover; /* Adjusts the image to cover the space */
      border-radius: 10px; /* Optional: Adds rounded corners */
      transition: all 0.3s ease;
    }
    .gallery-item {
      position: relative;
      padding: 10px; /* Adds space around images */
      overflow: hidden; /* Ensures no content overflows */
      border: 2px solid #f0f0f0; /* Optional: Adds a border around each image */
      border-radius: 10px; /* Optional: Rounded corners for the images */
      transition: transform 0.3s ease, box-shadow 0.3s ease; /* Adds smooth transitions */
    }
    .gallery-item:hover {
      transform: scale(1.05); /* Zoom effect on hover */
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); /* Adds a shadow on hover */
    }
    .download-btn {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background-color: #007bff;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      font-size: 16px;
      cursor: pointer;
      display: none;
    }
    .download-btn:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>
<br>
  <h1>GALLERY</h1>

  <div class="container">
    <div class="row g-3" id="imageGallery"></div> <!-- Bootstrap gap utility -->
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const images = [
        "https://i.pinimg.com/474x/72/dc/44/72dc441042f2fe87c15a454f6f6ff636.jpg",
        "https://i.pinimg.com/474x/93/66/cc/9366cce1b71df9270fd275fac272da3e.jpg",
        "https://i.pinimg.com/474x/12/03/fa/1203fa85e4a629940b2d426d1437d1c9.jpg",
        "https://i.pinimg.com/736x/78/eb/dd/78ebdd935d77099e78e2655b311866df.jpg",
        "https://i.pinimg.com/736x/66/29/97/662997519d992d9d701a473dfd6d5144.jpg",
        "https://w0.peakpx.com/wallpaper/968/722/HD-wallpaper-banke-bihari-devotional-hindu-god-bhakti-lord-krishna.jpg",
        "https://i.pinimg.com/736x/89/b3/de/89b3de945350448ef8e559ac79fdee44.jpg",
        "https://i.pinimg.com/originals/ec/73/44/ec7344ecd7822fd95f5fc9c54908e56f.jpg",
        "https://i.pinimg.com/736x/73/6f/0a/736f0a3b9958b1f80fc1f6155abb5a53.jpg",
        "https://i.pinimg.com/736x/38/7e/e9/387ee9d08592b7895d4b36aca3194838.jpg",
        "https://i.pinimg.com/736x/bb/6a/36/bb6a36c4ee871e6b7a94951dea0f31be.jpg",
        "https://i.pinimg.com/736x/24/6f/1a/246f1a661dfaef96525b2ee278ffd31d.jpg",
        "https://i.pinimg.com/736x/4a/90/9a/4a909af53ebf83444ca49f799d38e4f5.jpg",
        "https://i.pinimg.com/736x/8a/ea/41/8aea4165a94aa38a96a411c1dcc98194.jpg",
        "https://i.pinimg.com/736x/4d/b7/bc/4db7bc54a6bc53765da776458d703770.jpg",
        "https://i.pinimg.com/736x/19/81/23/198123a3683d67c5cd39d239f1d57f50.jpg",
        "https://i.pinimg.com/736x/ef/e2/16/efe2166d97091248b467fa9b16ac86fc.jpg",
        "https://i.pinimg.com/736x/6c/55/47/6c55470c5ba0b1bca2a65c0a07fd54be.jpg",
        "https://i.pinimg.com/736x/12/45/34/124534612b29703c4158d3ac833eec35.jpg",
        "https://i.pinimg.com/736x/8a/5f/06/8a5f062cb47d0f77c5ed6c39ccb9ba6b.jpg",
        "https://i.pinimg.com/736x/f5/70/b6/f570b66da794ad5e5e0eb145c48e5f26.jpg",
        "https://i.pinimg.com/736x/b4/7d/93/b47d93c7af7417c936e248a298e178f8.jpg",
        "https://i.pinimg.com/736x/ca/04/48/ca0448edd081f2499c04c4ba133623d0.jpg",
        "https://i.pinimg.com/736x/2b/36/fe/2b36fe54e216d1305529dc53fbb61599.jpg",
        "https://i.pinimg.com/564x/a9/89/63/a98963316a4a30b47be2a51dcd61339b.jpg",
        "https://i.pinimg.com/736x/ae/a8/ef/aea8efa880318984b607fded8fc7b894.jpg",
        "https://i.pinimg.com/736x/61/7c/cc/617ccc0a486b6f930f043a58e42c451c.jpg",
        "https://i.pinimg.com/736x/9a/4a/e3/9a4ae39d2c7f6e29d3cafaa33181c52b.jpg",
        "https://i.pinimg.com/736x/b2/50/4b/b2504b86fcc008917caa1310196e2731.jpg",
        "https://i.pinimg.com/736x/fa/85/a6/fa85a6feb258fa38b8e319443c72c1e8.jpg",
        "https://pbs.twimg.com/media/EuqA42VUUAQWsJE.jpg",
        "https://i.pinimg.com/736x/63/e2/3b/63e23b49f9cf75be3509b9a6ade6645c.jpg",
        "https://i.pinimg.com/736x/93/54/35/9354354899f88864ea3b29e3e50a8731.jpg",
        "https://i.pinimg.com/736x/d6/f2/9c/d6f29c887505e81554fe2acc8668186a.jpg",
        "https://i.pinimg.com/736x/7c/44/3a/7c443a66282d44850223e2cef13fbc85.jpg",
        "https://i.pinimg.com/736x/47/68/6b/47686b83a03899db706541351c66623b.jpg",
        "https://i.pinimg.com/736x/5b/2d/76/5b2d768c08deb499b1d14a6ae9cdd0c0.jpg",
        "https://i.pinimg.com/736x/d4/7f/b7/d47fb7b0192e050374a7e6bd7f9248ea.jpg",
        "https://i.pinimg.com/736x/9b/0a/9a/9b0a9a4fab05c268829dfc9e31f51342.jpg",
        "https://i.pinimg.com/550x/6b/b9/c7/6bb9c71c0618d6296ccfa840b4b4a923.jpg",
        "https://i.pinimg.com/736x/cc/84/c4/cc84c4bb53c28e963f2e60a809fe3851.jpg",
        "https://i.pinimg.com/736x/6a/d8/bc/6ad8bcb416269322ef200b3418d16a3b.jpg",
        "https://i.pinimg.com/736x/24/4b/b9/244bb93c55c6d2f0a765a847f1e9e7ef.jpg",
        "https://i.pinimg.com/736x/08/64/b7/0864b76984af8c2470a8604a4b4d0516.jpg",
        "https://i.pinimg.com/736x/b6/26/77/b62677406e08e4bff68ec461cc096c62.jpg",
        "https://i.pinimg.com/736x/dd/37/36/dd3736ac89272dfe7b7a2233f9102fdb.jpg",
        "https://i.pinimg.com/736x/e6/bc/8b/e6bc8b49ccdd78fef9bfda2604d8a32c.jpg",
        "https://i.pinimg.com/736x/16/c5/c0/16c5c09aa31f370574cdce15478b87b3.jpg",
        "https://i.pinimg.com/736x/e5/99/18/e599180ad931700b75a5f75b45900311.jpg",
        "https://i.pinimg.com/736x/fd/70/7c/fd707cadeb773fa090a1390e0fbabe67.jpg",
        "https://i.pinimg.com/736x/ac/c9/d1/acc9d1df7c9b9d2e4c29729eef011cfa.jpg",
        "https://i.pinimg.com/736x/62/f6/4f/62f64fa6e04489d39f654151657bf2f4.jpg"
      ];

      function shuffleArray(array) {
      for (let i = array.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]];
      }
    }

    const galleryContainer = document.getElementById("imageGallery");
    shuffleArray(images); // Shuffle images before displaying

    let imagesToShow = 8;
    function displayImages(count) {
      galleryContainer.innerHTML = ""; // Clear previous images
      images.slice(0, count).forEach((imgSrc, index) => {
        const colDiv = document.createElement("div");
        colDiv.className = "col-12 col-sm-6 col-md-4 col-lg-3 gallery-item";

        const imgElement = document.createElement("img");
        imgElement.src = imgSrc;
        imgElement.className = "gallery-img";
        imgElement.alt = `Image ${index + 1}`;

        colDiv.appendChild(imgElement);
        galleryContainer.appendChild(colDiv);
      });
    }

    displayImages(imagesToShow);

    // "See More" Button
    const seeMoreBtn = document.createElement("button");
    seeMoreBtn.innerText = "See More";
    seeMoreBtn.className = "btn btn-primary mt-3";
    seeMoreBtn.style.display = "block";
    seeMoreBtn.style.margin = "auto";

    seeMoreBtn.addEventListener("click", function () {
      imagesToShow += 8;
      if (imagesToShow >= images.length) {
        seeMoreBtn.style.display = "none"; // Hide button when all images are displayed
      }
      displayImages(imagesToShow);
    });

    galleryContainer.after(seeMoreBtn);
  });
</script>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <br>
  <?php 
    include 'discover.php'; 
    include 'partials/_footer.php';
    ?>
</body>
</html>
