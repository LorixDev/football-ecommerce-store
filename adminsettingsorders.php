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
    <title>Správa objednávek</title>
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
<h1 style="color: white">Objednávky</h1>
<?php
if (isset($error_message)) {
    echo "<p style='color: red'>$error_message</p>";
}
if (isset($_POST["delete_order_id"])) {
    $delete_order_id = mysqli_real_escape_string($conn, $_POST["delete_order_id"]);
    $result = mysqli_query($conn, "DELETE FROM orders WHERE id = $delete_order_id");
    if (!$result) {
        $error_message = "Error deleting order: " . mysqli_error($conn);
    }
}

$result = mysqli_query($conn, "SELECT * FROM orders ORDER BY date_created DESC");

?>
<table style="color: white;">
    <tr>
        <th>ID</th>
        <th>Jméno</th>
        <th>Email</th>
        <th>Addresa</th>
        <th>Telefon</th>
        <th>Platba</th>
        <th>Doprava</th>
        <th>Celkem</th>
        <th>Datum objednání</th>
        <th>Akce</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?php echo $row["id"]; ?></td>
            <td><?php echo $row["name"]; ?></td>
            <td><?php echo $row["email"]; ?></td>
            <td><?php echo $row["address"]; ?></td>
            <td><?php echo $row["phone"]; ?></td>
            <td><?php echo $row["payment"]; ?></td>
            <td><?php echo $row["shipping"]; ?></td>
            <td><?php echo $row["total"]; ?></td>
            <td><?php echo $row["date_created"]; ?></td>
            <td>
                <form method="post" onsubmit="return confirm('Are you sure you want to delete this order?')">
                    <input type="hidden" name="delete_order_id" value="<?php echo $row["id"]; ?>">
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
        <tr>
            <td colspan="10">
                <table>
                    <tr>
                        <th>Produkt</th>
                        <th>Množství</th>
                        <th>Cena/ks</th>
                        <th>Celkem</th>
                    </tr>
                    <?php
                    $order_id = $row["id"];
                    $order_items_result = mysqli_query($conn, "SELECT * FROM order_items WHERE order_id = $order_id");
                    while ($order_item_row = mysqli_fetch_assoc($order_items_result)):
                        ?>
                        <tr>
                            <td><?php echo $order_item_row["product_name"]; ?></td>
                            <td><?php echo $order_item_row["quantity"]; ?></td>
                            <td><?php echo $order_item_row["price"]; ?></td>
                            <td><?php echo $order_item_row["price"] * $order_item_row["quantity"]; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            </td>
        </tr>
    <?php endwhile; ?>
</table>
</body>
</html>