<?php
class Cart {
    public function addToCart($productId) {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        $_SESSION['cart'][] = $productId;
    }

    public function getCartItems() {
        return $_SESSION['cart'] ?? [];
    }

    public function removeFromCart($productId) {
        if (isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array_filter($_SESSION['cart'], fn($id) => $id != $productId);
        }
    }

    public function displayCart($products) {
        $cartItems = $this->getCartItems();
        if (empty($cartItems)) {
            echo "<p>Your cart is empty.</p>";
            return;
        }

        $totalAmount = 0;
        $productCounts = array_count_values($cartItems); // Counting each product's occurrences

        echo '<form method="post" action="">'; // Wraping in form to handle delete requests
        echo '<table>';
        echo '<thead><tr><th>Image</th><th>Product</th><th>Price</th><th>Quantity</th><th>Total</th><th>Action</th></tr></thead>';
        echo '<tbody>';

        foreach ($products as $product) {
            if (isset($productCounts[$product['id']])) {
                $quantity = $productCounts[$product['id']];
                $productTotal = $product['price'] * $quantity;
                $totalAmount += $productTotal;

                echo '<tr>';
                echo '<td><img src="' . htmlspecialchars($product['image']) . '" alt="' . htmlspecialchars($product['name']) . '" style="max-width: 200px; height: 100px;"></td>';
                echo '<td>' . htmlspecialchars($product['name']) . '</td>';
                echo '<td>$' . number_format($product['price'], 2) . '</td>';
                echo '<td>' . htmlspecialchars($quantity) . '</td>';
                echo '<td>$' . number_format($productTotal, 2) . '</td>';
                echo '<td><form method="post" action=""><input type="hidden" name="remove_product_id" value="' . htmlspecialchars($product['id']) . '"><button type="submit">Delete</button></form></td>';
                echo '</tr>';
            }
        }

        echo '</tbody>';
        echo '</table>';
        echo '<p class="total">Total Amount: $' . number_format($totalAmount, 2) . '</p>';
        echo '</form>';
    }
}
?>
