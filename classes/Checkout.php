<?php
class Checkout {
    public function processCheckout() {
        if (isset($_SESSION['user']) && isset($_SESSION['cart'])) {
            // Process the order
            unset($_SESSION['cart']);
            echo "<p>Order placed successfully!</p>";
        } else {
            echo "<p>Please log in and add items to your cart before checking out.</p>";
        }
    }
}
?>
