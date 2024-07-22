<?php include 'include/db_connect.php'; ?>
<?php include 'include/header.php'; ?>

<main>
    <?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $result = $conn->query("SELECT * FROM products WHERE id=$id");
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo "<div class='product-detail'>
                <img src='uploads/{$row['image']}' alt='{$row['name']}'>
                <h2>{$row['name']}</h2>
                <p>{$row['description']}</p>
                <p>\${$row['price']}</p>
                <button>Add to Cart</button>
            </div>";
        } else {
            echo "<p>Product not found.</p>";
        }
    }
    ?>
</main>

<?php include 'include/footer.php'; ?>
