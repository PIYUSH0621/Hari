<?php
include 'partials/_db.php';
include 'partials/_header.php';

// Fetch distinct categories
$categories = $conn->query("SELECT DISTINCT category FROM products");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Devotional Products</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* General Styling */
        body {
            background-color: #f8f9fa;
        }

        h2, h3 {
            font-weight: bold;
        }

        /* Product Section */
        .category-section {
            margin-bottom: 40px;
            padding: 20px;
            background: white;
            border-radius: 12px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
        }

        /* Scrollable Product Row */
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

        .product-card {
            flex: 0 0 auto;
            width: 270px;
            border-radius: 12px;
            scroll-snap-align: start;
        }

        @media (max-width: 768px) {
            .product-card {
                width: 90%;
                margin: auto;
            }
        }

        /* Card Styling */
        .card {
            border: none;
            border-radius: 12px;
            transition: 0.3s;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.15);
        }

        .card img {
            width: 100%;
            height: 260px;
            object-fit: cover;
            border-radius: 12px 12px 0 0;
        }

        @media (max-width: 768px) {
            .card img {
                height: 200px;
            }
        }

        .card-body {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            text-align: center;
        }

        /* Scroll Buttons */
        .scroll-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgb(255, 255, 255);
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

        /* Buttons */
        .btn-primary {
            background-color: rgb(34, 218, 255);
            border: none;
        }

        .btn-primary:hover {
            background-color: rgb(25, 97, 230);
        }

        .btn-warning {
            background-color: #fbc02d;
            border: none;
        }

        .btn-warning:hover {
            background-color: #f9a825;
        }
    </style>
</head>
<body>

    <h2 class="text-center my-4 text-primary">✨ Devotional Products ✨</h2>

    <div class="container">
        <?php while ($category = $categories->fetch_assoc()) : ?>
            <div class="category-section">
                <h3 class="mt-2 text-success"><?= strtoupper($category['category']); ?></h3>

                <!-- Scrollable Row -->
                <div class="scroll-wrapper">
                    <button class="scroll-btn left-btn" onclick="scrollLeft('scroll-<?= $category['category']; ?>')">&#10094;</button>
                    
                    <div class="scroll-container" id="scroll-<?= $category['category']; ?>">
                        <?php
                        $cat_name = $category['category'];
                        $products = $conn->query("SELECT * FROM products WHERE category = '$cat_name' LIMIT 10");
                        while ($product = $products->fetch_assoc()) :
                        ?>
                            <div class="product-card">
                                <div class="card shadow-sm border-0">
                                    <img src="<?= $product['image_url']; ?>" class="card-img-top" alt="<?= $product['name']; ?>">
                                    <div class="card-body">
                                        <h5 class="card-title text-dark"><?= $product['name']; ?></h5>
                                        <p class="card-text text-danger fw-bold">₹<?= number_format($product['price'], 2); ?></p>

                                        <?php if (isset($_SESSION['username']) && $_SESSION['username'] !== "Guest") : ?>
                                            <a href="product.php?id=<?= $product['id']; ?>" class="btn btn-primary btn-sm mt-2">View Details</a>
                                        <?php else : ?>
                                            <a href="../login.php" class="btn btn-warning btn-sm mt-2">Login to Add</a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>

                    <button class="scroll-btn right-btn" onclick="scrollRight('scroll-<?= $category['category']; ?>')">&#10095;</button>
                </div>

            </div>
        <?php endwhile; ?>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll(".scroll-container").forEach(function (container) {
                let leftBtn = container.parentElement.querySelector(".left-btn");
                let rightBtn = container.parentElement.querySelector(".right-btn");

                function checkScroll() {
                    leftBtn.disabled = container.scrollLeft <= 0;
                    rightBtn.disabled = container.scrollLeft + container.clientWidth >= container.scrollWidth;
                }

                leftBtn.addEventListener("click", function () {
                    container.scrollBy({ left: -300, behavior: "smooth" });
                });

                rightBtn.addEventListener("click", function () {
                    container.scrollBy({ left: 300, behavior: "smooth" });
                });

                container.addEventListener("scroll", checkScroll);
                checkScroll(); // Initialize button state
            });
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <?php include 'partials/_footer.php'; ?>

</body>
</html>
