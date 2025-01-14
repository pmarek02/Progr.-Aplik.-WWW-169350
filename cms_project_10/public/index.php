<?php
include '../includes/db.php';
include '../includes/functions.php';
include '../templates/header.php';

$categories = getCategories();
$pages = getPages();
?>
<div class="container">
    <h1>Welcome to Our Website</h1>
    <h2>Categories</h2>
    <ul>
        <?php foreach ($categories as $category): ?>
            <li><?php echo htmlspecialchars($category['name']); ?></li>
        <?php endforeach; ?>
    </ul>
    <h2>Pages</h2>
    <ul>
        <?php foreach ($pages as $page): ?>
            <li><a href="page.php?id=<?php echo $page['id']; ?>"><?php echo htmlspecialchars($page['title']); ?></a></li>
        <?php endforeach; ?>
    </ul>
</div>
<?php include '../templates/footer.php'; ?>
