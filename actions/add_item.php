<?php
include('../utils/db.php');
include('../utils/auth.php');
redirectIfNotLoggedIn();

$name = $_POST['ItemName'];
$quantity = $_POST['Quantity'];
$price = $_POST['Price'];
$desc = $_POST['Description'];
$image = $_FILES['image']['name'];

$sql = "INSERT INTO items (ItemName, Quantity, Price, Description, image)
        VALUES ('$name', $quantity, $price, '$desc', '$image')";

$result = odbc_exec($conn, $sql);

move_uploaded_file($_FILES['image']['tmp_name'], '../images/' . $image); // Store image

$tmpName = $_FILES['image']['tmp_name'];
$targetPath = '../images/' . $image;

header('Location: ../views/inventory.php');
exit;
?>
