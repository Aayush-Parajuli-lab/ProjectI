<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
}

include '../include/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category_id = $_POST['category_id'];

    if ($_FILES['image']['name']) {
        $image = $_FILES['image']['name'];
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($image);
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
        $conn->query("UPDATE products SET name='$name', description='$description', price='$price', category_id='$category_id', image='$image' WHERE id='$id'");
    } else {
        $conn->query("UPDATE products SET name='$name', description='$description', price='$price', category_id='$category_id' WHERE id='$id'");
    }

    header("Location: view_products.php");
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM products WHERE id=$id");
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        header("Location: view_products.php");
    }
} else {
    header("Location: view_products.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Update Product</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h2>Update Product</h2>
    <form method="POST" action="update_product.php" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <label for="name">Product Name</label>
        <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>" required>
        <label for="description">Description</label>
        <textarea id="description" name="description" required><?php echo $row['description']; ?></textarea>
        <label for="price">Price</label>
        <input type="number" id="price" name="price" value="<?php echo $row['price']; ?>" required>
        <label for="category_id">Category</label>
        <select id="category_id" name="category_id" required>
            <?php
            $categories = $conn->query("SELECT * FROM categories");
            while ($cat = $categories->fetch_assoc()) {
                $selected = ($cat['id'] == $row['category_id']) ? "selected" : "";
                echo "<option value='{$cat['id']}' $selected>{$cat['name']}</option>";
            }
            ?>
        </select>
        <label for="image">Image</label>
        <input type="file" id="image" name="image">
        <button type="submit">Update Product</button>
    </form>
</body>
</html>
