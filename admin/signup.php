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
    $inputUsername = $conn->real_escape_string($_POST['username']);
    $inputPassword = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    // Check if passwords match
    if ($inputPassword !== $confirmPassword) {
        $error = "Passwords do not match.";
    } else {
        // Check if username already exists
        $sql_check = "SELECT * FROM admins WHERE username='$inputUsername'";
        $result_check = $conn->query($sql_check);

        if ($result_check->num_rows > 0) {
            $error = "Username already exists.";
        } else {
            // Hash the password
            $hashedPassword = password_hash($inputPassword, PASSWORD_DEFAULT);

            // Insert new admin user into the database
            $sql = "INSERT INTO admins (username, password) VALUES ('$inputUsername', '$hashedPassword')";
            if ($conn->query($sql) === TRUE) {
                // Redirect to login page after successful signup
                header("Location: login.php");
                exit();
            } else {
                $error = "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Signup</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <form method="POST" action="signup.php">
        <h2>Admin Signup</h2>
        <label for="username">Username</label>
        <input type="text" id="username" name="username" required>
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
        <label for="confirm_password">Confirm Password</label>
        <input type="password" id="confirm_password" name="confirm_password" required>
        <button type="submit">Signup</button>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
    </form>
</body>
</html>
