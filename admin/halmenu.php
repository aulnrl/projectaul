<?php
// Include database connection
include 'koneksi.php';

// Fetch menu items from the database
$sql = "SELECT * FROM menu";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - Menu Pallet Caffe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Menu Pallet Caffe</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="checkout.html">Checkout</a></li>
                    <li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <h1 class="mt-5">Menu</h1>
        <div class="row">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="<?php echo $row['image']; ?>" class="card-img-top" alt="<?php echo $row['name']; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['name']; ?></h5>
                            <p class="card-text"><?php echo $row['description']; ?></p>
                            <p class="card-text">Rp <?php echo number_format($row['price'], 2, ',', '.'); ?></p>
                            <button class="btn btn-primary addToCart" data-id="<?php echo $row['id']; ?>" data-name="<?php echo $row['name']; ?>" data-price="<?php echo $row['price']; ?>" data-image="<?php echo $row['image']; ?>">Add to Cart</button>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.addToCart').click(function() {
                let cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
                let item = {
                    id: $(this).data('id'),
                    name: $(this).data('name'),
                    price: $(this).data('price'),
                    image: $(this).data('image'),
                    quantity: 1
                };

                let exists = false;
                for (let i = 0; i < cartItems.length; i++) {
                    if (cartItems[i].id == item.id) {
                        cartItems[i].quantity++;
                        exists = true;
                        break;
                    }
                }

                if (!exists) {
                    cartItems.push(item);
                }

                localStorage.setItem('cartItems', JSON.stringify(cartItems));
                alert('Item added to cart');
            });
        });
    </script>
</body>
</html>
