<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "accessiomart1";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Basic username validation
    if (!preg_match("/^[a-zA-Z][a-zA-Z0-9]*[0-9]$/", $username)) {
        $error = "Username must start with a letter and end with a number.";
    } else {
        // Check if username or email already exists
        $sql_check = "SELECT * FROM users WHERE username='$username' OR email='$email'";
        $result_check = $conn->query($sql_check);
        if ($result_check->num_rows > 0) {
            $error = "Username or email already exists.";
        } else {
            $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
            if ($conn->query($sql) === TRUE) {
                // Redirect to index.php after successful signup
                header("Location: index.php");
                exit();
            } else {
                $error = "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
}

$conn->close();
?>