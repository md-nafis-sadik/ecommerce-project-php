<?php
session_start();
require_once 'classes/Checkout.php';

$checkoutObj = new Checkout();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Checkout</h1>
        <nav>
            <a href="index.php">Continue Shopping</a>
            <a href="cart.php">View Cart</a>
        </nav>
    </header>
    <main>
        <?php $checkoutObj->processCheckout(); ?>
    </main>
</body>
</html>
