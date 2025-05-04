<?php
session_start();
include('../utils/db.php');
include('../utils/auth.php');
redirectIfNotLoggedIn();

$id = $_GET['id'];

$sql = "DELETE FROM items WHERE ID = $id";
$result = odbc_exec($conn, $sql);

header('Location: ../views/inventory.php');
exit;
?>