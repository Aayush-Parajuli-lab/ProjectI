<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
}

include '../include/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category_id = $_POST['category_id'];
    $image = $_FILES['image']['name'];

    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($image);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    $conn->query("INSERT INTO products (name, description, price, category_id, image) VALUES ('$name', '$description', '$price', '$category_id', '$image')");
    header("Location: view_products.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Add Product</title>
    <link rel="stylesheet" href="css/add.css">
</head>
<body>
    <h2>Add Product</h2>
    <form method="POST" action="add_product.php" enctype="multipart/form-data">
        <label for="name">Product Name</label>
        <input type="text" id="name" name="name" required>
        <label for="description">Description</label>
        <textarea id="description" name="description" required></textarea>
        <label for="price">Price</label>
        <input type="number" id="price" name="price" required>
        <label for="category_id">Category</label>
        <select id="category_id" name="category_id" required>
            <?php
            $result = $conn->query("SELECT * FROM categories");
            while ($row = $result->fetch_assoc()) {
                echo "<option value='{$row['category_id']}'>{$row['category_name']}</option>";
            }
            ?>
        </select>
        <label for="image">Image</label>
        <input type="file" id="image" name="image" required>
        <button type="submit">Add Product</button>
    </form>
</body>
</html>
