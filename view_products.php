<?php include 'include/db_connect.php'; ?>
<?php include 'include/header.php'; ?>

<main>
    <h2>All Products</h2>
    <div class="products">
        <?php
        $result = $conn->query("SELECT * FROM products");
        while ($row = $result->fetch_assoc()) {
            echo "<div class='product'>
                <img src='uploads/{$row['image']}' alt='{$row['name']}'>
                <h3>{$row['name']}</h3>
                <p>\${$row['price']}</p>
                <a href='view_product.php?id={$row['id']}'>View</a>
            </div>";
        }
        ?>
    </div>
</main>

<?php include 'include/footer.php'; ?>
