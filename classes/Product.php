<?php
class Product {
    private $products;

    public function __construct() {
        $this->products = json_decode(file_get_contents('data/products.json'), true);
    }

    public function getAllProducts() {
        return $this->products;
    }

    public function displayProducts() {
        foreach ($this->products as $product) {
            echo "<div class='product'>
                    <img src='{$product['image']}' alt='{$product['name']}'>
                    <h2>{$product['name']}</h2>
                    <p>{$product['description']}</p>
                    <p>\${$product['price']}</p>
                    <form method='post' action='cart.php'>
                        <input type='hidden' name='product_id' value='{$product['id']}'>
                        <button type='submit'>Add to Cart</button>
                    </form>
                  </div>";
        }
    }

    public function getProductById($id) {
        foreach ($this->products as $product) {
            if ($product['id'] == $id) {
                return $product;
            }
        }
        return null; // Return null if the product is not found
    }
}
?>
