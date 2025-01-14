<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: ../login.php');
    exit;
}
include '../../includes/db.php';
include '../../includes/functions.php';
include '../../templates/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'add':
                addCategory($_POST['name'], $_POST['parent_id'] ?? 0);
                break;
            case 'edit':
                editCategory($_POST['id'], $_POST['name'], $_POST['parent_id']);
                break;
            case 'delete':
                deleteCategory($_POST['id']);
                break;
        }
    }
}

$categoriesTree = getCategoriesTree();
?>
<div class="container">
    <h1>Manage Categories</h1>

    <h2>Add New Category</h2>
    <form method="post">
        <input type="hidden" name="action" value="add">
        <label for="name">Category Name:</label>
        <input type="text" name="name" id="name" required>
        <label for="parent_id">Parent Category:</label>
        <select name="parent_id" id="parent_id">
            <option value="0">None</option>
            <?php foreach ($categoriesTree as $category): ?>
                <option value="<?php echo $category['id']; ?>"><?php echo htmlspecialchars($category['name']); ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Add Category</button>
    </form>

    <h2>Existing Categories</h2>
    <ul>
        <?php foreach ($categoriesTree as $category): ?>
            <li><?php echo htmlspecialchars($category['name']); ?></li>
        <?php endforeach; ?>
    </ul>
</div>
<?php include '../../templates/footer.php'; ?>
