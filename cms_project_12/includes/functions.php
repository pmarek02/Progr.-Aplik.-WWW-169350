
<?php
function addCategory($name, $parentId = 0) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO categories (name, parent_id) VALUES (?, ?)");
    $stmt->execute([$name, $parentId]);
}

function editCategory($id, $name, $parentId) {
    global $conn;
    $stmt = $conn->prepare("UPDATE categories SET name = ?, parent_id = ? WHERE id = ?");
    $stmt->execute([$name, $parentId, $id]);
}

function deleteCategory($id) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM categories WHERE id = ?");
    $stmt->execute([$id]);
}

function addPage($title, $content) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO pages (title, content) VALUES (?, ?)");
    $stmt->execute([$title, $content]);
}

function editPage($id, $title, $content) {
    global $conn;
    $stmt = $conn->prepare("UPDATE pages SET title = ?, content = ? WHERE id = ?");
    $stmt->execute([$title, $content, $id]);
}

function deletePage($id) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM pages WHERE id = ?");
    $stmt->execute([$id]);
}
?>
