<?php
include 'partials/_header.php';
include 'partials/_db.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    echo '<div class="container text-center my-5">
            <h3 class="text-danger">⚠ Login to continue</h3>
            <a href="../login.php" class="btn btn-primary mt-3">Login Now</a>
          </div>';
    include 'partials/_footer.php';
    exit(); // Stop execution if not logged in
}

// Ensure the session contains the correct name (change this if needed)
$user_name = $_SESSION['username'] ?? ''; 

// Fetch orders from the database using the name column
$sql = "SELECT product_name, prod_alt, total_price, order_date FROM orders WHERE name = ? ORDER BY order_date DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user_name);
$stmt->execute();
$result = $stmt->get_result();
?>

<div class="container mt-4">
    <h2 class="text-center">Your Order History</h2>

    <?php if ($result->num_rows > 0): ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Product Name</th>
                        <th>Size/Language</th>
                        <th>Total Price (₹)</th>
                        <th>Order Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['product_name']) ?></td>
                            <td><?= !empty($row['prod_alt']) ? htmlspecialchars($row['prod_alt']) : 'N/A' ?></td>
                            <td><?= number_format($row['total_price'], 2) ?></td>
                            <td><?= date("d-M-Y h:i A", strtotime($row['order_date'])) ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="alert alert-warning text-center">No past orders found.</div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<br><br>
<?php include 'partials/_footer.php'; ?>
</body>
</html>
