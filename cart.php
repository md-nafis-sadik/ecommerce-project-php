<?php
session_start();
require_once 'classes/Product.php';
require_once 'classes/Cart.php';

$productObj = new Product();
$products = $productObj->getAllProducts();

$cartObj = new Cart();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['product_id'])) {
        // Add to cart
        $cartObj->addToCart($_POST['product_id']);
    } elseif (isset($_POST['remove_product_id'])) {
        // Remove from cart
        $cartObj->removeFromCart($_POST['remove_product_id']);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Your Cart</h1>
        <nav>
            <a href="index.php">Continue Shopping</a>
            <a href="checkout.php">Proceed to Checkout</a>
        </nav>
    </header>
    <main>
        <?php $cartObj->displayCart($products); ?>
    </main>
</body>
</html>
