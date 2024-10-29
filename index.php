<?php
session_start();
require_once 'classes/Product.php';

$productObj = new Product();
$products = $productObj->getAllProducts();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <h1>E-Commerce WebSite</h1>
    <nav>
        <a href="index.php">Home</a>
        <a href="cart.php">View Cart</a>
        <?php if (isset($_SESSION['user'])): ?>
            <a href="logout.php">Logout</a>
        <?php else: ?>
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
        <?php endif; ?>
    </nav>
</header>

    <main>
        <?php $productObj->displayProducts(); ?>
    </main>
</body>
</html>
