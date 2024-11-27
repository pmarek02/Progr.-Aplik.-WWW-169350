<?php
include('cfg.php');

// Sprawdzenie, czy przekazano id lub alias
$page_id = isset($_GET['page_id']) ? intval($_GET['page_id']) : null;
$page_alias = isset($_GET['alias']) ? $conn->real_escape_string($_GET['alias']) : null;

if ($page_id !== null) {
    $sql = "SELECT page_title, page_content FROM page_list WHERE id = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $page_id);
} elseif ($page_alias !== null) {
    $sql = "SELECT page_title, page_content FROM page_list WHERE alias = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $page_alias);
} else {
    die("Nieprawidłowy parametr zapytania.");
}

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<h1>" . htmlspecialchars($row["page_title"]) . "</h1>";
        echo "<p>" . htmlspecialchars($row["page_content"]) . "</p>";
    }
} else {
    echo "Strona nie została znaleziona.";
}

$stmt->close();
$conn->close();
?>
