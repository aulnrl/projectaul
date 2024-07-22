<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include database connection
include 'koneksi.php';

// Get table number from query parameters
$tableNumber = isset($_GET['table_number']) ? trim($_GET['table_number']) : '';

// Validate input
if (!empty($tableNumber)) {
    // Fetch order and order items for the given table number
    $sql = "SELECT o.id, o.table_number, oi.quantity, m.name as menu_item, m.price, m.image, o.created_at
            FROM orders o
            JOIN order_items oi ON o.id = oi.order_id
            JOIN menu m ON oi.menu_item_id = m.id
            WHERE o.table_number = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("s", $tableNumber);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Fetch all rows
            $orderItems = $result->fetch_all(MYSQLI_ASSOC);
            $order = $orderItems[0]; // Assuming all order items belong to the same order
        } else {
            $error = "No orders found for table number $tableNumber.";
        }

        $stmt->close();
    } else {
        $error = "Prepare failed: " . $conn->error;
    }
} else {
    $error = "Table number is required.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Invoice - Table <?php echo htmlspecialchars($tableNumber); ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>
<body>
  <div class="container mt-5">
    <h1 class="text-center">Invoice for Table <?php echo htmlspecialchars($tableNumber); ?></h1>
    <?php if (isset($error)): ?>
      <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
    <?php else: ?>
      <div class="card">
        <div class="card-header">
          <h2>Order Details</h2>
          <p>Order ID: <?php echo htmlspecialchars($order['id']); ?></p>
          <p>Order Date: <?php echo htmlspecialchars($order['created_at']); ?></p>
        </div>
        <div class="card-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Menu Item</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Image</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $grandTotal = 0;
              foreach ($orderItems as $item):
                $total = $item['quantity'] * $item['price'];
                $grandTotal += $total;
                $imagePath = 'path/to/images/' . $item['image']; // Update the path to the correct image directory
              ?>
                <tr>
                  <td><?php echo htmlspecialchars($item['menu_item']); ?></td>
                  <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                  <td><?php echo htmlspecialchars(number_format($item['price'], 2)); ?></td>
                  <td><img src="<?php echo htmlspecialchars($imagePath); ?>" alt="<?php echo htmlspecialchars($item['menu_item']); ?>" width="50"></td>
                  <td><?php echo htmlspecialchars(number_format($total, 2)); ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
            <tfoot>
              <tr>
                <th colspan="4" class="text-end">Grand Total</th>
                <th><?php echo htmlspecialchars(number_format($grandTotal, 2)); ?></th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    <?php endif; ?>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
