
<?php
session_start();
include '../includes/cart_functions.php';
include '../templates/header.php';
?>

<div class="container"><a href="order.php" class="btn btn-primary mb-3">Przejdź do zamówienia</a>
    <h1>Twój koszyk</h1>
    <?php showCart(); ?>
</div>

<?php include '../templates/footer.php'; ?>
