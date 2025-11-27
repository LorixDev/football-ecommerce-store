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
// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["product_id"])) {
    $product_id = $_POST["product_id"];
    $size_id = $_POST["size_id"];
    $quantity = $_POST["quantity"];

    $sql = "INSERT INTO clothing_sizes_quantity (product_id, size_id, quantity) VALUES ('$product_id', '$size_id', '$quantity')";
    if ($conn->query($sql) === TRUE) {
        echo "New shoe size and quantity added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$sql = "SELECT id, Velikost FROM size_obleceni";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Add New Clothes Size and Quantity</h2>";
    echo "<form method='post' action='insert_stockclothes.php'>";
    if (isset($_GET["product_id"])) {
        echo "<input type='hidden' name='product_id' value='" . $_GET["product_id"] . "' />";
    } else {
        echo "Product ID not found.";
    }


    echo "<label>Shoe Size:</label>";
    echo "<select name='size_id'>";
    while($row = $result->fetch_assoc()) {
        echo "<option value='" . $row["id"] . "'>" . $row["Velikost"] . "</option>";
    }
    echo "</select>";
    echo "<label>Quantity:</label>";
    echo "<input type='number' name='quantity' min='0' />";
    echo "<button type='submit'>Add</button>";
    echo "</form>";
}else {
    echo "No clothes sizes found. Please add clothes sizes first.";
}

$conn->close();
?>
</body>
</html>