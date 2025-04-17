<?php  
include 'partials/_header.php';
include 'partials/_db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize user input
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $address = $conn->real_escape_string($_POST['address']);

    if (!empty($_SESSION['cart'])) {
        $total_price = 0;

        foreach ($_SESSION['cart'] as &$cart_item) {
            $product_id = $cart_item['id']; 
            $quantity = $cart_item['quantity'];

            // Check for selected size/language from form
            $prod_alt = "";
            if (isset($_POST["size_$product_id"])) {
                $prod_alt = $conn->real_escape_string($_POST["size_$product_id"]);
            } elseif (isset($_POST["lang_$product_id"])) {
                $prod_alt = $conn->real_escape_string($_POST["lang_$product_id"]);
            }

            // Store prod_alt in session cart
            $cart_item['prod_alt'] = $prod_alt;

            // Fetch product details
            $result = $conn->query("SELECT name, category, price FROM products WHERE id = $product_id");
            if ($result && $row = $result->fetch_assoc()) {
                $product_name = $row['name'];
                $product_price = $row['price'] * $quantity;
                $total_price += $product_price;

                // Insert into orders table
                $sql = "INSERT INTO orders (product_id, name, email, phone, address, product_name, prod_alt, total_price) 
                        VALUES ('$product_id', '$name', '$email', '$phone', '$address', '$product_name', '$prod_alt', '$product_price')";

                if (!$conn->query($sql)) {
                    $_SESSION['order_error'] = "Error: " . $conn->error;
                    header("Location: checkout.php");
                    exit();
                }
            }
        }
        unset($cart_item); // Break reference to prevent issues

        $_SESSION['cart'] = []; // Clear cart after order
        $_SESSION['order_success'] = "Thank you, $name! Your order has been placed.<br>
        Sorry, delivery is not available yet. Collect from Madhusudan, Ulhasnagar-02.";
    } else {
        $_SESSION['order_error'] = "Your cart is empty!";
    }

    header("Location: checkout.php");
    exit();
}

// Show success/error messages
if (isset($_SESSION['order_success'])) {
    echo "<div class='alert alert-warning text-center'>" . $_SESSION['order_success'] . "</div>";
    unset($_SESSION['order_success']);
}
if (isset($_SESSION['order_error'])) {
    echo "<div class='alert alert-danger text-center'>" . $_SESSION['order_error'] . "</div>";
    unset($_SESSION['order_error']);
}
$username = $_SESSION['username'] ?? '';
?>

<div class="container mt-4">
    <h2 class="text-center">Checkout</h2>
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8 col-sm-12">
            <form method="POST" class="p-4 border rounded bg-light shadow">
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    
                    <input type="text" class="form-control" name="name" value="<?php echo htmlspecialchars($username); ?>" readonly>
                  
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Phone</label>
                    <input type="text" name="phone" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Address</label>
                    <textarea name="address" class="form-control" required></textarea>
                </div>

                <!-- Display Cart Products with Selection Options -->
                <h4 class="text-center my-3">Your Order</h4>
                <ul class="list-group mb-3">
                    <?php 
                    if (!empty($_SESSION['cart'])) {
                        foreach ($_SESSION['cart'] as $cart_item) {
                            $product_id = $cart_item['id'];
                            $quantity = $cart_item['quantity'];
                            $result = $conn->query("SELECT name, category, price FROM products WHERE id = $product_id");
                            if ($result && $row = $result->fetch_assoc()) {
                                $product_name = $row['name'];
                                $product_category = strtolower($row['category']);
                                ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <?= $product_name ?> (x<?= $quantity ?>)
                                    <span class="text-danger fw-bold">₹<?= number_format($row['price'] * $quantity, 2) ?></span>
                                </li>

                                <!-- Size Selection for Clothes -->
                                <?php if ($product_category == "clothes" || $product_category == "gopal"): ?>
                                    <div class="mb-3">
                                        <label class="form-label">Select Size for <?= $product_name ?>:</label>
                                        <select name="size_<?= $product_id ?>" class="form-select" required>
                                            <?php 
                                            if ($product_category == "clothes") {
                                                $sizes = [28, 32, 34, 38, 40, 44];
                                            } else {
                                                $sizes = [0, 1, 2, 3, 4, 5, 6];
                                            }
                                            foreach ($sizes as $size) {
                                                echo "<option value='$size'>$size</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                <?php endif; ?>

                                <!-- Language Selection for Books -->
                                <?php if ($product_category == "book"): ?>
                                    <div class="mb-3">
                                        <label class="form-label">Select Language for <?= $product_name ?>:</label>
                                        <select name="lang_<?= $product_id ?>" class="form-select" required>
                                            <option value="Hindi">Hindi</option>
                                            <option value="English">English</option>
                                            <option value="Marathi">Marathi</option>
                                            <option value="Gujarati">Gujarati</option>
                                        </select>
                                    </div>
                                <?php endif; ?>
                            <?php 
                            }
                        }
                    } else {
                        echo "<li class='list-group-item text-center text-muted'>Your cart is empty.</li>";
                    }
                    ?>
                </ul>

                <button type="submit" class="btn btn-success w-100">Confirm Order</button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<br><br>
<?php include 'partials/_footer.php'; ?>
</body>
</html>
