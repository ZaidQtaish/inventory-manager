<?php
include('../utils/auth.php');
redirectIfNotLoggedIn(); // Check login

if (isset($_GET['logout'])) { // Handle logout
    logout();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory</title>
    <link rel="stylesheet" href="inventory.css">
    <link href="https://fonts.cdnfonts.com/css/inter" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet">
</head>

<body>
    <h2 class='title'>Inventory Manager</h2>
    <main>
        <section class="cards">
        <!-- Read items table -->
        <?php
        include('../utils/db.php'); // Connect to DB
        
        // Test DB Query
        $sql = "SELECT * FROM items";
        $result = odbc_exec($conn, $sql);

        while ($row = odbc_fetch_array($result)) {
            echo "
            <div class='item-card'>
                <img src='../images/{$row['Image']}' class='item-img' />
                <h3>{$row['ItemName']}</h3>
                <p><strong>Qty:</strong> {$row['Quantity']}</p>
                <p><strong>Price:</strong> \${$row['Price']}</p>
                <p>{$row['Description']}</p>
                <a href='edit_item.php?id={$row['ID']}' class='edit-btn'><i class='fa-solid fa-pen'></i></a>
                <a href='../actions/delete_item.php?id={$row['ID']}' class='delete-btn'><i class='fa-solid fa-trash'></i></a>   
            </div>";
        }
        ?>
        </section>
        <section>
        <!-- Add items -->
        <h3>Add New Item</h3>
        <form action="../actions/add_item.php" method="POST" enctype="multipart/form-data">
            <input type="text" name="ItemName" placeholder="Item Name" required>
            <input type="number" name="Quantity" placeholder="Quantity" required>
            <input type="number" step="0.01" name="Price" placeholder="Price" required>
            <input type="text" name="Description" placeholder="Description">
            <input type="file" name="image" accept="image/*" />
            <button type="submit">Add Item</button>
        </form>
    </section>
    </main>
    <a class='logout' href="inventory.php?logout=true">Logout</a>
</body>

</html>