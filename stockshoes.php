<?php
session_start();
include("connect.php");
mysqli_set_charset($conn, 'utf8');
?>
    <!DOCTYPE html>
    <html lang="cs">
    <head>
        <meta charset=UTF-8>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="style.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link rel="icon" type="image/x-icon" href="moon.png">
        <title>Správa produktů</title>
    </head>
<body>
<div class="navbar">
    <a href="index.php"><img src="football.jpg" alt="Domů" style="width:40px;height:40px;"></a>
    <a href="index.php">Produkty</a>
    <a href="cart.php">Košík</a>
    <a href="about.php">O nás</a>
    <?php
    if(isset($_SESSION['username'])){
        echo '<a href="logout.php">Odhlásit se</a>';
        echo '<a href="setting.php"><img src="settings.png" alt="Nastavení" style="width:40px;height:40px;"></a>';
        echo "<p>Uživatel: " . $_SESSION['username'] . "</p>";
    }else{
        echo '<a href="login.php">Přihlásit</a>';
        echo '<a href="register.php">Registrovat</a>';
        echo "<p>Návštěvník</p>";
    }
    ?>
</div>

<div class="usernavbar">
    <a href="setting.php">Historie objednávek</a>
    <a href="settingchan.php">Změnit heslo</a>
    <?php
    if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1){
        echo '<a href="adminsettingsuser.php">Uživatelé</a>';
        echo '<a href="adminsettingsproducts.php">Produkty</a>';
        echo '<a href="adminsettingsorders.php">Objednávky</a>';
    }
    ?>
</div>
<?php
if (!isset($_SESSION['admin']) || $_SESSION['admin'] != 1) {
    header("location: login.php");
    exit();
}
?>
<?php
// Query database for products in specified category
$sql = "SELECT p.id, p.name, ss.Velikost, COALESCE(ssq.quantity, 0) AS available_stock, ssq.size_id
FROM products p
LEFT JOIN shoe_sizes_quantity ssq ON ssq.product_id = p.id
LEFT JOIN shoe_sizing ss ON ss.id = ssq.size_id
WHERE p.category_id = 1";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Display products and available stock
    while($row = $result->fetch_assoc()) {
        echo "<p class='white'>" . $row["name"] . " - " . $row["Velikost"] . " - " . $row["available_stock"] . "</p>";

        // Add form to update quantity
        echo "<form class='white' method='post' action='update_quantity.php'>";
        echo "<input type='hidden' name='product_id' value='" . $row["id"] . "' />";
        echo "<input type='hidden' name='size_id' value='" . $row["size_id"] . "' />";
        echo "<label>Update Quantity:</label>";
        echo "<input type='number' name='new_quantity' min='0' value='" . $row["available_stock"] . "' />";
        echo "<button type='submit'>Update</button>";
        echo "</form>";
        echo "<form method='get' action='insert_stockshoes.php'>";
        echo "<input type='hidden' name='product_id' value='" . $row["id"] . "' />";
        echo "<input type='hidden' name='size_id' value='" . $row["size_id"] . "' />";
        echo "<button type='submit'>Add Stock</button>";
        echo "</form>";

    }
} else {
    echo "No products found in this category.";
}

$conn->close();
?>

</body>
</html>
