<?php
session_start();
if (!isset($_SESSION['admin'])) {
    // Redirect to the login page if not logged in
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h2>Admin Dashboard</h2>
    <nav>
        <a href="view_products.php">View Products</a>
        <a href="view_categories.php">View Categories</a>
        <a href="logout.php">Logout</a>
    </nav>
</body>
</html>
