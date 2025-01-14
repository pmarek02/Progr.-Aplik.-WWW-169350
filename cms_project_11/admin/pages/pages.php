
<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: ../login.php');
    exit;
}

include '../../includes/db.php';
include '../../templates/header.php';
?>

<div class="container">
    <h1>CMS Management</h1>
    <p>Panel zarządzania podstronami został wyłączony.</p>
</div>

<?php include '../../templates/footer.php'; ?>
