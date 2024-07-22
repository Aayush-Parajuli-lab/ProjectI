<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
}

include '../include/db_connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - View Products</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h2>View Products</h2>
    <a href="add_product.php">Add Product</a>
    <div class="products">
        <?php
        $result = $conn->query("SELECT * FROM products");
        while ($row = $result->fetch_assoc()) {
            echo "<div class='product'>
                <img src='../uploads/{$row['image']}' alt='{$row['name']}'>
                <h3>{$row['name']}</h3>
                <p>\${$row['price']}</p>
                <a href='update_product.php?id={$row['id']}'>Update</a>
                <a href='delete_product.php?id={$row['id']}'>Delete</a>
            </div>";
        }
        ?>
    </div>
</body>
</html>
