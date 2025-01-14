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
    $stmt = $conn->prepare("DELETE FROM categories WHERE id = ? OR parent_id = ?");
    $stmt->execute([$id, $id]);
}

function getCategoriesTree($parentId = 0, $level = 0) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM categories WHERE parent_id = ?");
    $stmt->execute([$parentId]);
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $tree = [];
    foreach ($categories as $category) {
        $tree[] = [
            'id' => $category['id'],
            'name' => str_repeat("--", $level) . " " . $category['name'],
            'children' => getCategoriesTree($category['id'], $level + 1)
        ];
    }
    return $tree;
}

function getCategories() {
    global $conn;
    $stmt = $conn->query("SELECT * FROM categories");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function addPage($title, $content) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO pages (title, content) VALUES (?, ?)");
    $stmt->execute([$title, $content]);
}

function getPages() {
    global $conn;
    $stmt = $conn->query("SELECT * FROM pages");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>