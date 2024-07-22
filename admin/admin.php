<?php
// Include database connection
include 'koneksi.php';

// Check if an order ID is provided for details
$orderId = isset($_GET['order_id']) ? (int)$_GET['order_id'] : 0;

// Fetch orders and order items if an order ID is provided
if ($orderId > 0) {
    // SQL query to get the details and total price for a specific order
    $sql = "
        SELECT o.order_id, o.table_number, o.order_date, i.menu_item, i.quantity, i.price,
               (i.quantity * i.price) AS total_item_price
        FROM orders o
        JOIN order_items i ON o.order_id = i.order_id
        WHERE o.order_id = ?
    ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $orderId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Calculate total order price
    $totalOrderPrice = 0;
    while ($row = $result->fetch_assoc()) {
        $totalOrderPrice += $row['total_item_price'];
    }
    // Reset result pointer
    $result->data_seek(0);
} else {
    $sqlOrders = "SELECT * FROM orders";
    $resultOrders = $conn->query($sqlOrders);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Menu Pallet Caffe</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Menu Pallet Caffe</a>
        <div class="collapse navbar-collapse">
            <div class="navbar-nav">
                <a class="nav-link" href="admin.php">Admin Dashboard</a>
                <a class="nav-link" href="index.html">Home</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h1>Admin Dashboard</h1>

        <?php if ($orderId > 0): ?>
            <h2>Order Details</h2>
            <?php if ($result->num_rows > 0): ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Order ID</th>
                            <th>Table Number</th>
                            <th>Order Date</th>
                            <th>Menu Item</th>
                            <th>Quantity</th>
                            <th>Price per Item</th>
                            <th>Total Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $counter = 1; // Initialize counter
                        while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $counter++; ?></td> <!-- Display counter -->
                                <td><?php echo $row['order_id']; ?></td>
                                <td><?php echo htmlspecialchars($row['table_number']); ?></td>
                                <td><?php echo $row['order_date']; ?></td>
                                <td><?php echo htmlspecialchars($row['menu_item']); ?></td>
                                <td><?php echo $row['quantity']; ?></td>
                                <td>Rp <?php echo number_format($row['price'], 2, ',', '.'); ?></td>
                                <td>Rp <?php echo number_format($row['total_item_price'], 2, ',', '.'); ?></td>
                            </tr>
                        <?php endwhile; ?>
                        <tr>
                            <td colspan="7" class="text-end"><strong>Total Price:</strong></td>
                            <td>Rp <?php echo number_format($totalOrderPrice, 2, ',', '.'); ?></td>
                        </tr>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No items found for this order.</p>
            <?php endif; ?>
        <?php else: ?>
            <h2>Orders</h2>
            <?php if ($resultOrders->num_rows > 0): ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Order ID</th>
                            <th>Table Number</th>
                            <th>Order Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $counter = 1; // Initialize counter
                        while ($order = $resultOrders->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $counter++; ?></td> <!-- Display counter -->
                                <td><?php echo $order['order_id']; ?></td>
                                <td><?php echo htmlspecialchars($order['table_number']); ?></td>
                                <td><?php echo $order['order_date']; ?></td>
                                <td><a href="admin.php?order_id=<?php echo $order['order_id']; ?>" class="btn btn-info btn-sm">View Details</a></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No orders found.</p>
            <?php endif; ?>
        <?php endif; ?>

        <?php
        // Close connection
        $conn->close();
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
