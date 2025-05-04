<?php
include('../utils/db.php');
include('../utils/auth.php');
redirectIfNotLoggedIn();

$id = $_GET['id'];
$sql = "SELECT * FROM items WHERE ID = $id";
$result = odbc_exec($conn, $sql);
$item = odbc_fetch_array($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Item</title>
    <link rel="stylesheet" href="edit.css">
</head>
<body>
<div class="edit-container">
  <h2>Edit Item</h2>
  <form action="../actions/update_item.php" method="post" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?= $item['ID'] ?>">
      <label>Item Name:
        <input type="text" name="ItemName" value="<?= $item['ItemName'] ?>">
      </label>
      <label>Quantity:
        <input type="number" name="Quantity" value="<?= $item['Quantity'] ?>">
      </label>
      <label>Price:
        <input type="text" name="Price" value="<?= $item['Price'] ?>">
      </label>
      <label>Description:
        <textarea name="Description"><?= $item['Description'] ?></textarea>
      </label>
      <label>Current Image:
        <img src="../images/<?= $item['Image'] ?>" alt="Item Image">
      </label>
      <label>Change Image:
        <input type="file" name="image">
      </label>
      <button type="submit">Update</button>
  </form>
</div>
</body>
</html>
