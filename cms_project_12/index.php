<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php');
    exit;
}
include 'templates/header.php';
?>
<div class="container">
    <h1>Welcome to the CMS</h1>
    <p>Manage your categories and pages easily.</p>
    <nav>
        <ul>
            <li><a href="pages/categories.php">Manage Categories</a></li>
            <li><a href="pages/pages.php">Manage Pages</a></li>
        </ul>
    </nav>
</div>
<?php include 'templates/footer.php'; ?>
