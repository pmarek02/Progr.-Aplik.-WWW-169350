
<?php
// Start session
session_start();

// Include the database connection
include '../includes/db.php';

// Check if the cart is not empty
if (empty($_SESSION['cart'])) {
    echo '<p>Your cart is empty.</p>';
    exit;
}

// Handle the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Gather form data
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $total_price = $_POST['total_price'];  // Total price of the order

    // Insert the order into the orders table
    $stmt = $conn->prepare("INSERT INTO orders (name, address, phone, email, total_price) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$name, $address, $phone, $email, $total_price]);

    // Get the last inserted order ID
    $order_id = $conn->lastInsertId();

    // Insert each item from the cart into the order_items table
    foreach ($_SESSION['cart'] as $productId => $product) {
        $item_total_price = $product['price_with_vat'] * $product['quantity'];
        $stmt = $conn->prepare("INSERT INTO order_items (order_id, product_id, quantity, total_price) VALUES (?, ?, ?, ?)");
        $stmt->execute([$order_id, $productId, $product['quantity'], $item_total_price]);
    }

    // Clear the cart after the order is placed
    unset($_SESSION['cart']);

    // Confirmation message for the user
    echo '<p>Your order has been placed successfully! Thank you for your purchase.</p>';
}
?>

<!-- Order form -->
<div class="container">
   <style>/* Styl dla formularza zamówień */
.container {
    max-width: 600px;
    margin: 50px auto;
    padding: 20px;
    background: #ffffff;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    font-family: Arial, sans-serif;
}

.container h1 {
    text-align: center;
    margin-bottom: 20px;
    color: #0077b6;
    font-size: 24px;
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
    color: #333;
}

.form-control {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
}

.form-control:focus {
    border-color: #0077b6;
    outline: none;
    box-shadow: 0 0 5px rgba(0, 119, 182, 0.5);
}

textarea.form-control {
    resize: vertical;
    min-height: 100px;
}

.btn {
    display: inline-block;
    background: #0077b6;
    color: #fff;
    border: none;
    padding: 10px 20px;
    text-align: center;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    transition: background 0.3s ease;
    text-decoration: none;
}

.btn:hover {
    background: #005f8a;
}

.btn-success {
    background: #28a745;
    border-color: #28a745;
}

.btn-success:hover {
    background: #218838;
}
</style>
    <h1>Order Form</h1>
    <form action="order.php" method="POST">
        <div class="form-group">
            <label for="name">Full Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="address">Shipping Address</label>
            <textarea name="address" id="address" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="tel" name="phone" id="phone" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <input type="hidden" name="total_price" value="<?= $_POST['total_price'] ?? '0' ?>">

        <button type="submit" class="btn btn-success">Place Order</button>
    </form>
</div>
