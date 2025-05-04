<?php
session_start();
include('db.php');

function redirectIfNotLoggedIn()
{
    if (!isset($_SESSION['username'])) {
        header("Location: ../index.php"); // Redirect to login page if not logged in
        exit();
    }
}

function logout()
{
    session_start();
    session_unset();
    session_destroy();
    header("Location: ../index.php"); // Redirect to login page after logout
    exit();
}

function authenticateUser($username, $password)
{
    global $conn; // use DB connection from db.php

    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = odbc_exec($conn, $sql);

    // Hash password
    $hashedPassword = hash('md5', $password);

    // Check if user exists and the password matches
    if ($row = odbc_fetch_array($result)) {
        if ($hashedPassword == $row['password']) {
            $_SESSION['username'] = $username;
            return true;
        }
    }
    return false; // Invalid login
}
?>