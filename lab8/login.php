<?php
session_start();
include('cfg.php'); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    
    $query = "SELECT * FROM users WHERE username = ? AND password = ? LIMIT 1";
    $stmt = $conn->prepare($query);

    
    if (!$stmt) {
        die("Database query preparation failed: " . $conn->error);
    }

    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $_SESSION['loggedin'] = true;
        header('Location: admin.php');
        exit;
    } else {
        echo '<p style="color: red;">Invalid login credentials. Please try again.</p>';
    }
}


if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_destroy();
    header('Location: login.php');
    exit;
}
?>

<h1>Login</h1>
<form method="post" action="login.php">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required><br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br>
    <button type="submit">Login</button>
</form>