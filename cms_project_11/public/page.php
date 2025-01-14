<?php
include '../includes/db.php';
include '../includes/functions.php';
include '../templates/header.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$stmt = $conn->prepare("SELECT * FROM pages WHERE id = ?");
$stmt->execute([$id]);
$page = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$page) {
    echo "<div class='container'><p>Page not found!</p></div>";
} else {
    ?>
    <div class="container">
        <h1><?php echo htmlspecialchars($page['title']); ?></h1>
        <div><?php echo nl2br(htmlspecialchars($page['content'])); ?></div>
    </div>
    <?php
}
include '../templates/footer.php';
?>
