<?php
// ODBC connection to Access Database
$dsn = 'InventoryDB';  // This should match the name you gave your DSN in ODBC setup
$user = ''; 
$password = '';

// Create a connection
$conn = odbc_connect($dsn, $user, $password);

if (!$conn) {
    die("Connection failed: " . odbc_errormsg());
}
?>
