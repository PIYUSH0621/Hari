<?php
include 'partials/_header.php';
include 'partials/_db.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<div class='alert alert-danger text-center'>Invalid Product ID</div>";
    exit();
}

$product_id = intval($_GET['id']);

// Fetch product details
$query = $conn->prepare("SELECT * FROM products WHERE id = ?");
$query->bind_param("i", $product_id);
$query->execute();
$result = $query->get_result();
$product = $result->fetch_assoc();

if (!$product) {
    echo "<div class='alert alert-danger text-center'>Product not found</div>";
    exit();
}

// Handle Add to Cart action
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_to_cart'])) {
    $prod_alt = "";

    if ($product['category'] == "clothes" && isset($_POST['size'])) {
        $prod_alt = $_POST['size']; // Store size for clothes
    } elseif ($product['category'] == "book" && isset($_POST['lang'])) {
        $prod_alt = $_POST['lang']; // Store language for books
    }

    // Initialize cart session if not set
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Unique key for different variations
    $cart_key = $product_id . ($prod_alt ? "_$prod_alt" : "");

    // Add item to cart (increase quantity if already exists)
    if (isset($_SESSION['cart'][$cart_key])) {
        $_SESSION['cart'][$cart_key]['quantity'] += 1;
    } else {
        $_SESSION['cart'][$cart_key] = [
            'id' => $product_id,
            'name' => $product['name'],
            'image'=> $product['image_url'],
            'price' => $product['price'],
            'category' => $product['category'],
            'prod_alt' => $prod_alt,
            'quantity' => 1
        ];
    }

    $_SESSION['cart_message'] = "✅ Added to Cart Successfully!";
    header("Location: product.php?id=" . $product_id);
    exit();
}

// Show success message
if (isset($_SESSION['cart_message'])) {
    echo "<div class='alert alert-success text-center'>" . $_SESSION['cart_message'] . "</div>";
    unset($_SESSION['cart_message']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($product['name']) ?> - Product Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container my-5">
    <div class="row">
        <div class="col-md-6 text-center">
            <img src="<?= htmlspecialchars($product['image_url']) ?>" class="img-fluid rounded shadow" alt="<?= htmlspecialchars($product['name']) ?>" style="max-height: 400px;">
        </div>
        <div class="col-md-6">
            <h2 class="text-primary"><?= htmlspecialchars($product['name']) ?></h2>
            <p class="text-muted"><?= htmlspecialchars($product['description']) ?></p>
            <h4 class="text-danger fw-bold">₹<?= number_format($product['price'], 2) ?></h4>

            <form method="POST">
    <?php if ($product['category'] == "clothes") : ?>
        <label class="form-label mt-3">Select Size:</label>
        <select name="size" class="form-select" required>
            <option value="28">28</option>
            <option value="32">32</option>
            <option value="34">34</option>
            <option value="38">38</option>
            <option value="40">40</option>
            <option value="44">44</option>
        </select>
    <?php endif; ?>

    <?php if ($product['category'] == "gopal") : ?>
        <label class="form-label mt-3">Select Size:</label>
        <select name="size" class="form-select" required>
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
        </select>
    <?php endif; ?>

    <?php if ($product['category'] == "Book") : ?>
        <label class="form-label mt-3">Select Language:</label>
        <select name="lang" class="form-select" required>
            <option value="Hindi">Hindi</option>
            <option value="English">English</option>
            <option value="Marathi">Marathi</option>
            <option value="Gujarati">Gujarati</option>
        </select>
    <?php endif; ?>

    <button type="submit" name="add_to_cart" class="btn btn-success mt-3 w-100">🛒 Add to Cart</button>
</form>


            <a href="home_shop.php" class="btn btn-outline-secondary mt-3 w-100">⬅ Back to Shop</a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php include 'partials/_footer.php'; ?>
</body>
</html>
