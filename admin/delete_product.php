<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
}

include '../include/db_connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $conn->query("DELETE FROM products WHERE id=$id");
}

header("Location: view_products.php");
?>
