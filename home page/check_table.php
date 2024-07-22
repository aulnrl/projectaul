<?php
// Include database connection
include 'koneksi.php';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tableNumber = $_POST['tableNumber'];
    $orderItems = $_POST['orderItems'];

    // Insert order into database
    $stmt = $conn->prepare("INSERT INTO orders (table_number, order_date) VALUES (?, NOW())");
    $stmt->bind_param("s", $tableNumber);
    $stmt->execute();
    $orderId = $stmt->insert_id;

    // Insert order items into database
    $stmt = $conn->prepare("INSERT INTO order_items (order_id, menu_item, quantity, price) VALUES (?, ?, ?, ?)");
    foreach ($orderItems as $item) {
        $stmt->bind_param("isid", $orderId, $item['menu_item'], $item['quantity'], $item['price']);
        $stmt->execute();
    }

    // Close statement
    $stmt->close();
    $conn->close();

    // Redirect to admin page
    header("Location: admin.php");
    exit();
}
?>
