<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Define the available menus
$menus = [
    'taro' => [
        'name' => 'Taro',
        'price' => 'Rp 26.000',
        'description' => 'Delicious taro-flavored drink, a creamy and sweet treat that combines the unique taste of taro root with a smooth, velvety texture',
        'image' => 'asset/taro.png'
    ],
    'matcha' => [
        'name' => 'Matcha',
        'price' => 'Rp 26.000',
        'description' => 'Refreshing matcha green tea, a revitalizing beverage made with finely ground green tea leaves, offering a rich, earthy flavor and vibrant green color',
        'image' => 'asset/matcha.png'
    ],
    'chocolate' => [
        'name' => 'Chocolate',
        'price' => 'Rp 26.000',
        'description' => 'Delicious chocolate-flavored drink, a rich and indulgent treat that combines the deep, decadent taste of chocolate with a creamy, smooth texture',
        'image' => 'asset/coklat.png'
    ],
    'lemon' => [
        'name' => 'Lemon Tea',
        'price' => 'Rp 20.000',
        'description' => 'Refreshing tea with lemon, a light and invigorating beverage that combines the crisp taste of tea with a zesty twist of fresh lemon.',
        'image' => 'asset/lemon tea.png'
    ],
    'lyche' => [
        'name' => 'Lyche Tea',
        'price' => 'Rp 25.000',
        'description' => 'Refreshing tea with lychee, a delightful blend of tea and the sweet, aromatic flavor of lychee fruit, perfect for a tropical escape in a cup',
        'image' => 'asset/lyche.png'
    ],
    'sunrise' => [
        'name' => 'Sunrise Lemoned',
        'price' => 'Rp 27.000',
        'description' => 'Sunrise lemonade, a vibrant and refreshing drink that captures the essence of a sunrise with its tangy lemon flavor and a hint of sweetness.',
        'image' => 'asset/sunrise.png'
    ],
    'bluesea' => [
        'name' => 'Blue Sea Lemoned',
        'price' => 'Rp 28.000',
        'description' => 'Blue Sea lemonade, a cool and refreshing drink with a unique blue hue and a crisp, citrusy flavor that will transport you to the seaside',
        'image' => 'asset/bluesea.png'
    ],
    'pinkladies' => [
        'name' => 'Pink Ladies',
        'price' => 'Rp 28.000',
        'description' => 'Delicious Pink-flavored drink',
        'image' => 'asset/pinkladies.png'
    ],
    // Menu Coffee
    'paletcofe' => [
        'name' => 'Pallet Coffee',
        'price' => 'Rp 25.000',
        'description' => '',
        'image' => 'asset/palletcoffe.png'
    ],
    'capucino' => [
        'name' => 'Cappuccino Latte',
        'price' => 'Rp 25.000',
        'description' => '',
        'image' => 'asset/capucin.png'
    ],
    'vanila' => [
        'name' => 'Vanilla Latte',
        'price' => 'Rp 27.000',
        'description' => '',
        'image' => 'asset/Vanila.png'
    ],
    'americano' => [
        'name' => 'Americano',
        'price' => 'Rp 18.000',
        'description' => '',
        'image' => 'asset/americano.png'
    ],
    'cofber' => [
        'name' => 'Coffee Berry',
        'price' => 'Rp 27.000',
        'description' => '',
        'image' => 'asset/cofber.png'
    ],
    'redlatte' => [
        'name' => 'Red Latte',
        'price' => 'Rp 27.000',
        'description' => '',
        'image' => 'asset/red late.png'
    ],

    /* MENU EATRY */
    'musrom' => [
        'name' => 'Chicken Mushroom',
        'price' => 'Rp 28.000',
        'description' => '',
        'image' => 'asset/steakmushrom.png'
    ],
    'taichan' => [
        'name' => 'Taichan',
        'price' => 'Rp28.000',
        'description' => '',
        'image' => 'asset/taichan.png'
    ],
    'nasgor' => [
        'name' => 'Nasi Goreng Jomblo',
        'price' => 'Rp20.000',
        'description' => '',
        'image' => 'asset/nasgorjomblo.png'
    ],
    'dimsum' => [
        'name' => 'Dimsum',
        'price' => 'Rp 20.000',
        'description' => '',
        'image' => 'asset/dimsum.png'
    ],
    'mixplater' => [
        'name' => 'Mixed Platter',
        'price' => 'Rp33.000',
        'description' => '',
        'image' => 'asset/mixed.png'
    ],
    
    'pisang' => [
        'name' => 'Pisang Bakar Coklat',
        'price' => 'Rp20.000',
        'description' => '',
        'image' => 'asset/pisangcoklat.png'
    ],
    'garlic' => [
        'name' => ' Nasi Goreng Garlic & beef',
        'price' => 'Rp33.000',
        'description' => '',
        'image' => 'asset/nasgorgarlic.png'
    ],
    'cireng' => [
        'name' => 'Cireng',
        'price' => 'Rp 20.000',
        'description' => '',
        'image' => 'asset/cireng.png'
    ],
];

// Get the selected menu from the query parameter
$menu = isset($_GET['menu']) ? $_GET['menu'] : 'default';
$selectedMenu = isset($menus[$menu]) ? $menus[$menu] : null;
?>


        <!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Menu Pallet Caffe</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="styles.css">
<style>
    body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
        }
        .container {
            background-color: white;
            padding: 20px;
            display: flex;
            flex-direction: column;
            margin: 20px auto;
            max-width: 800px;
        }
        .product-detail {
            display: flex;
            flex-direction: column;
            gap: 20px;
            color: black;
        }
        .product-image {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            max-width: 400px;
            height: auto;
            margin: 0 auto;
        }
        .product-info {
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            flex: 1;
        }
        .product-image img {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }
        .product-info h1 {
            font-size: 2rem;
            margin-bottom: 10px;
        }
        .product-info p {
            margin: 10px 0;
        }
        .quantity-input {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .quantity-input input {
            width: 60px;
            margin-right: 10px;
        }
        .full-screen-container {
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        .content {
            flex: 1;
            display: flex;
            flex-direction: column;
            padding: 20px;
        }
        .list-group {
            margin-bottom: 20px;
        }
        /* Responsive Design */
        @media (min-width: 768px) {
            .product-detail {
                flex-direction: row;
            }
            .product-image, .product-info {
                flex: 1;
            }
        }
        @media (max-width: 768px) {
            .product-image {
                max-width: 100%;
                height: auto;
            }
            .product-info h1 {
                font-size: 1.5rem;
            }
        }
        @media (max-width: 480px) {
            .product-info h1 {
                font-size: 1.2rem;
            }
            .product-info p {
                margin: 5px 0;
            }
        }
</style>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <img src="asset/logo.png" width="30" height="30" class="d-inline-block align-top" alt="Logo">
        Menu Pallet Caffe
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ms-auto">
          <a class="nav-link" href="Index.htm">Home</a>
          <a class="nav-link" href="halmenu.html">Menu</a>
          <a class="nav-link" href="aboutus.html">About us</a>
          <div class="nav-item cart-badge">
            <a class="nav-link" href="checkout.html">
              <img src="asset/cart.png" alt="Cart Image" class="link-image" id="cartImage">
              <span class="badge" id="cartBadge">0</span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </nav>

  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item"><a href="halmenu.html">Menu</a></li>
      <li class="breadcrumb-item active" aria-current="page">Page Detail</li>
    </ol>
  </nav>
  <div class="content">
    <ul class="list-group">
      <li class="list-group-item active" aria-current="true">Category menu</li>
      <li class="list-group-item"> <a href="halmenu.html"> All Menu </a> </li>
      <li class="list-group-item"> <a href="menu_coffe.html"> Coffe </a> </li>
      <li class="list-group-item"> <a href="menu_non_coffe.html"> Non Coffe </a></li>
      <li class="list-group-item"> <a href="menu_makanan.html"> Food </a></li>
    </ul>
  </div>

    <div class="container">
        <div class="product-detail">
            <?php if ($selectedMenu): ?>
                <div class="product-image">
                    <img src="<?php echo $selectedMenu['image']; ?>" alt="<?php echo $selectedMenu['name']; ?>">
                </div>
                <div class="product-info">
                    <h1><?php echo $selectedMenu['name']; ?></h1>
                    <p><?php echo $selectedMenu['description']; ?></p>
                    <p>Price: <?php echo $selectedMenu['price']; ?></p>
                    <div class="quantity-input">
                        <label for="quantity" class="form-label">Quantity:</label>
                        <input type="number" id="quantity" value="1" min="1" class="form-control">
                    </div>
                    
                    <button type="button" class="btn btn-primary" onclick="addToCart('<?php echo $selectedMenu['name']; ?>', '<?php echo $selectedMenu['price']; ?>', '<?php echo $selectedMenu['image']; ?>')">Add to Cart</button>
                </div>
            <?php else: ?>
                <p>Menu not found.</p>
            <?php endif; ?>
        </div>
    </div>

    <script>
        function addToCart(name, price, image) {
            const quantity = parseInt(document.getElementById('quantity').value);
            const cartItem = {
                name: name,
                price: price,
                image: image,
                quantity: quantity
            };

            let cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
            const existingItemIndex = cartItems.findIndex(item => item.name === cartItem.name);
            if (existingItemIndex > -1) {
                cartItems[existingItemIndex].quantity += quantity;
            } else {
                cartItems.push(cartItem);
            }
            localStorage.setItem('cartItems', JSON.stringify(cartItems));
            window.location.href = 'checkout.html';
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
