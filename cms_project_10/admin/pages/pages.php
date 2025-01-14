<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: ../login.php');
    exit;
}
include '../../includes/db.php';
include '../../includes/functions.php';
include '../../templates/header.php';

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'add':
                addPage($_POST['title'], $_POST['content']);
                break;
            case 'edit':
                editPage($_POST['id'], $_POST['title'], $_POST['content']);
                break;
            case 'delete':
                deletePage($_POST['id']);
                break;
        }
    }
}

// Fetch all pages
$pages = getPages();
?>
<div class="container">
    <h1>Manage Pages</h1>

    <h2>Add New Page</h2>
    <form method="post">
        <input type="hidden" name="action" value="add">
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" required>
        <label for="content">Content:</label>
        <textarea name="content" id="content" rows="5" required></textarea>
        <button type="submit">Add Page</button>
    </form>

    <h2>Existing Pages</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pages as $page): ?>
                <tr>
                    <td><?php echo $page['id']; ?></td>
                    <td><?php echo htmlspecialchars($page['title']); ?></td>
                    <td>
                        <form method="post" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $page['id']; ?>">
                            <input type="hidden" name="action" value="delete">
                            <button type="submit">Delete</button>
                        </form>
                        <form method="post" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $page['id']; ?>">
                            <input type="hidden" name="action" value="edit">
                            <label for="title-<?php echo $page['id']; ?>">Edit Title:</label>
                            <input type="text" name="title" id="title-<?php echo $page['id']; ?>" value="<?php echo htmlspecialchars($page['title']); ?>" required>
                            <label for="content-<?php echo $page['id']; ?>">Edit Content:</label>
                            <textarea name="content" id="content-<?php echo $page['id']; ?>" rows="2" required><?php echo htmlspecialchars($page['content']); ?></textarea>
                            <button type="submit">Save</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php include '../../templates/footer.php'; ?>
