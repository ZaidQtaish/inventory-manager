<?php
include('../utils/db.php');

if (isset($_POST['register'])) {
  $username = trim($_POST['username']);
  $password = $_POST['password'];
  $confirm = $_POST['confirmPassword'];

  if ($password !== $confirm) {
    echo "<script>alert('Passwords do not match');</script>";
  } else {
    // Hash password
    $hashedPassword = hash('md5', $password);

    global $conn; // use DB connection from db.php

    $sql = "INSERT INTO users ('username', 'password') VALUES('$username', '$password')";

    if (odbc_exec($conn, $sql)) {
      header("Location: ../index.php");
      exit();
    } else {
      echo "<script>alert('Registration failed');</script>";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Register</title>
  <link rel="stylesheet" href="../index.css">
</head>

<body>
  <fieldset>
    <legend>Register</legend>
    <form action="register.php" method="POST">
      <input type="text" name="username" placeholder="Username" required>
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required>
      <input type="password" name="confirmPassword" placeholder="Confirm Password" required>
      <button type="submit" name="register">Register</button>
    </form>
    <p style="text-align: center; margin-top: 10px;">
      Already have an account? <a href="login.php">Login</a>
    </p>
  </fieldset>
</body>

</html>