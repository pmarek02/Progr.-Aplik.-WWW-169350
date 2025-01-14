
<?php
// Start session only if it is not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Function to add a product to the cart
function addToCart($productId, $productName, $price, $vat, $quantity) {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Calculate price with VAT
    $priceWithVat = $price * (1 + $vat / 100);  // Correct price calculation with VAT

    if (isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId]['quantity'] += $quantity;
    } else {
        $_SESSION['cart'][$productId] = [
            'name' => $productName,
            'price' => $price,
            'vat' => $vat,
            'quantity' => $quantity,
            'price_with_vat' => $priceWithVat
        ];
    }
}

// Function to remove a product from the cart
function removeFromCart($productId) {
    if (isset($_SESSION['cart'][$productId])) {
        unset($_SESSION['cart'][$productId]);
    }
}

// Function to show the cart
function showCart() {
    if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
        echo '<form method="post"><table class="table"><thead><tr><th>Name</th><th>Price</th><th>Quantity</th><th>Total</th><th>Action</th></tr></thead><tbody>';
        $totalPrice = 0;
        foreach ($_SESSION['cart'] as $productId => $product) {
            $total = $product['price_with_vat'] * $product['quantity'];
            $totalPrice += $total;
            echo "<tr><td>{$product['name']}</td><td>{$product['price']}</td><td><input type='number' name='quantity[$productId]' value='{$product['quantity']}' min='1' class='form-control' style='width: 60px;'></td><td>{$total}</td>";
            echo "<td><a href='?remove={$productId}' class='btn btn-danger'>Remove</a></td></tr>";
        }
        echo '</tbody></table>';
        echo "<h3>Total Price: {$totalPrice}</h3>";
        echo "<button type='submit' name='update_cart' class='btn btn-warning'>Update Cart</button>";
        echo '</form>';
    } else {
        echo '<p>Your cart is empty.</p>';
    }
}

// Function to update product quantity in the cart
if (isset($_POST['update_cart'])) {
    foreach ($_POST['quantity'] as $productId => $quantity) {
        updateQuantity($productId, $quantity);
    }
}

// Function to update quantity
function updateQuantity($productId, $quantity) {
    if (isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId]['quantity'] = $quantity;
    }
}

// Handle removing a product from the cart (when the link is clicked)
if (isset($_GET['remove'])) {
    $productId = $_GET['remove'];
    removeFromCart($productId);
}

?>
