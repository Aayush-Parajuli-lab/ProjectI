<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include '../include/db_connect.php';

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['cid'])) {
    $cid = (int)$_GET['cid']; // Cast to integer to ensure it's numeric

    // Prepare and execute the delete query
    $deleteQuery = "DELETE FROM categories WHERE cid = ?";
    $stmt = $conn->prepare($deleteQuery);

    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("i", $cid);

    if ($stmt->execute()) {
        $stmt->close();
        // Redirect to view categories page
        header("Location: view_categories.php");
        exit();
    } else {
        die("Execute failed: " . $stmt->error);
    }
} else {
    // Redirect or handle the error if no ID is provided
    header("Location: view_categories.php");
    exit();
}

// Close database connection
$conn->close();
?>
