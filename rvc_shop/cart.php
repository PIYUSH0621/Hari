<?php

include 'partials/_db.php';
include 'partials/_header.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    echo '<div class="container text-center my-5">
            <h3 class="text-danger">⚠ Please Login First</h3>
            <a href="../login.php" class="btn btn-primary mt-3">Login Now</a>
          </div>';
    include 'partials/_footer.php';
    exit(); // Stop execution if not logged in
}

// Initialize cart session if not set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Debugging - Check if session is working
if (!isset($_SESSION['cart'])) {
    die("Error: Session is not working properly. Please enable cookies.");
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add'])) {
        $product_id = intval($_POST['add']);

        // Fetch product details
        $product_query = $conn->query("SELECT * FROM products WHERE id = '$product_id'");
        if ($product_query->num_rows > 0) {
            $product = $product_query->fetch_assoc();

            // Check if product exists in cart, otherwise add it
            if (!isset($_SESSION['cart'][$product_id])) {
                $_SESSION['cart'][$product_id] = [
                    'name' => $product['name'],
                    'price' => $product['price'],
                    'image' => $product['image_url'],
                    'quantity' => 1
                ];
            } else {
                $_SESSION['cart'][$product_id]['quantity']++; // Increase quantity
            }
        }
    }

    // Remove a single quantity
    if (isset($_POST['remove'])) {
        $remove_id = intval($_POST['remove']);

        if (isset($_SESSION['cart'][$remove_id])) {
            if ($_SESSION['cart'][$remove_id]['quantity'] > 1) {
                $_SESSION['cart'][$remove_id]['quantity']--;
            } else {
                unset($_SESSION['cart'][$remove_id]); // Remove if quantity reaches 0
            }
        }
    }

    // Clear the cart
    if (isset($_POST['clear'])) {
        $_SESSION['cart'] = [];
    }

    // Redirect to prevent form resubmission issue
    header("Location: cart.php");
    exit();
}

$total_price = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .cart-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .cart-item img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
        }

        .btn-remove {
            background-color: #dc3545;
            border: none;
        }

        .btn-remove:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>

<div class="container my-4">
    <h2 class="text-center text-primary">🛒 Your Cart</h2>

    <div class="cart-container p-3">
        <?php if (!empty($_SESSION['cart'])): ?>
            <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr class="bg-light">
                            <th>Image</th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($_SESSION['cart'] as $id => $product): ?>
                            <?php $total_price += $product['price'] * $product['quantity']; ?>
                            <tr class="cart-item">
                                <td><img src="<?= $product['image']; ?>" alt="<?= $product['name']; ?>" class="img-fluid"></td>
                                <td><?= $product['name']; ?></td>
                                <td>₹<?= number_format($product['price'], 2); ?></td>
                                <td><?= $product['quantity']; ?></td>
                                <td>₹<?= number_format($product['price'] * $product['quantity'], 2); ?></td>
                                <td>
                                    <!-- Add/Remove Form -->
                                    <form method="POST" class="d-inline">
                                        <button type="submit" name="add" value="<?= $id; ?>" class="btn btn-success btn-sm">+</button>
                                    </form>
                                    <form method="POST" class="d-inline">
                                        <button type="submit" name="remove" value="<?= $id; ?>" class="btn btn-danger btn-sm">-</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <h4 class="text-end">Total: ₹<?= number_format($total_price, 2); ?></h4>
            <div class="d-flex justify-content-between flex-wrap gap-2">
                <a href="checkout.php" class="btn btn-success">Proceed to Checkout</a>
                <form method="POST">
                    <button type="submit" name="clear" class="btn btn-danger">Clear Cart</button>
                </form>
            </div>
        <?php else: ?>
            <p class="text-center text-danger">Your cart is empty! 🛒</p>
        <?php endif; ?>
    </div>
</div>

<script>
    // Force refresh when navigating back
    window.onpageshow = function(event) {
        if (event.persisted) {
            location.reload();
        }
    };
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<?php include 'partials/_footer.php'; ?>

</body>
</html>
