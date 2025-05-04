<?php
include('../utils/db.php');
include('../utils/auth.php');
redirectIfNotLoggedIn();

$id = $_POST['id'];
$name = $_POST['ItemName'];
$quantity = $_POST['Quantity'];
$price = $_POST['Price'];
$desc = $_POST['Description'];

$image = $_FILES['image']['name'];
$imagePath = '';

if ($image) {
    // If a new image was uploaded, move it to the 'images' folder
    $imagePath = $image;
    move_uploaded_file($_FILES['image']['tmp_name'], '../images/' . $imagePath);
} else {
    // Keep the current image if no new one is uploaded
    // Fetch current image from the database
    $sql = "SELECT image FROM items WHERE ID = $id";
    $result = odbc_exec($conn, $sql);
    $item = odbc_fetch_array($result);
    $imagePath = $item['image'];
}

// Update the item in the database
$sql = "UPDATE items SET 
        ItemName = '$name', 
        Quantity = $quantity, 
        Price = $price, 
        Description = '$desc', 
        image = '$imagePath' 
        WHERE ID = $id";

if (odbc_exec($conn, $sql)) {
    header('Location: ../views/inventory.php');  // Redirect to inventory page after success
} else {
    echo "Error updating item.";
}
exit;
?>
