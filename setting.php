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
    <link rel="icon" type="image/x-icon" href="moon.png">
    <title>Historie objednávek</title>
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
    if(isset($_SESSION['admin']) && $_SESSION['admin'] == 1){
        echo '<a href="adminsettingsuser.php">Uživatelé</a>';
        echo '<a href="adminsettingsproducts.php">Produkty</a>';
        echo '<a href="adminsettingsorders.php">Objednávky</a>';
    }
    ?>
</div>

<div class="user_history">
    <h2>Historie objednávek</h2>
    <table class="user_history_table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Jméno</th>
            <th>Email</th>
            <th>Adresa</th>
            <th>Telefon</th>
            <th>Platba</th>
            <th>Doprava</th>
            <th>Datum</th>
            <th>Celkem</th>
            <th>Produkty</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if(isset($_SESSION['email'])){
            $email = $_SESSION['email'];
        } else {
        }
        $sql = "SELECT * FROM orders WHERE email='$email'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["name"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["address"] . "</td>";
                echo "<td>" . $row["phone"] . "</td>";
                echo "<td>" . $row["payment"] . "</td>";
                echo "<td>" . $row["shipping"] . "</td>";
                echo "<td>" . $row["date_created"] . "</td>";
                echo "<td>" . $row["total"] . "</td>";

                $order_id = $row["id"];

                $items_sql = "SELECT * FROM order_items WHERE order_id='$order_id'";
                $items_result = mysqli_query($conn, $items_sql);

                // Display the ordered items
                echo "<td>";
                while($item_row = mysqli_fetch_assoc($items_result)) {
                    echo $item_row["product_name"] . " (" . $item_row["size"] . ") (Quantity: " . $item_row["quantity"] . "), ";
                }
                echo "</td>";

                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>Zatím nemáte žádnou historii.</td></tr>";
        }

        ?>
        </tbody>
    </table>
</div>

</body>
</html>