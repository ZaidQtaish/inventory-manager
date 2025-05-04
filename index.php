<?php
include('./utils/auth.php');

// Redirect to inventory if already logged in
if (isset($_SESSION['username'])) {
    header("Location: views/inventory.php");
    exit();
}

// Handle login when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input
    $input_username = $_POST['username'];
    $input_password = $_POST['password'];

    // Authenticate user with the database
    if (authenticateUser($input_username, $input_password)) {
        header("Location: views/inventory.php");  // Redirect to inventory page
        exit();
    } else {
        $error = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <link href="https://fonts.cdnfonts.com/css/inter" rel="stylesheet">
    <title>Login</title>
</head>
<body>
    <fieldset class='login-field'>
    <legend>Login</legend>
    
    <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>

    <form method="POST" action="index.php">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <input type="submit" value="Login">
    </form>
</fieldset>
</body>
</html>
