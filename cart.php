<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="icon" type="image/x-icon" href="moon.png">
    <title>Košík</title>
    <style>

    </style>
</head>
<body>
<div class="navbar">
    <a href="index.php"><img src="football.jpg" alt="Domů" style="width:40px;height:40px;"></a>
    <a href="index.php">Produkty</a>
    <a href="cart.php">Košík</a>
    <a href="about.php">O nás</a>
    <?php
    session_start();
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

<?php

include("connect.php");
mysqli_set_charset($conn, 'utf8');

if(!empty($_SESSION['cart'])) {
    echo "<table class='table'>";
    echo "<tr>";
    echo "<th>Produkt</th>";
    echo "<th>Velikost</th>";
    echo "<th>Cena</th>";
    echo "<th>Množství</th>";
    echo "<th>Celkem</th>";
    echo "<th>Akce</th>";
    echo "</tr>";
    $total = 0;
    foreach($_SESSION['cart'] as $key => $item) {
        echo "<tr>";
        echo "<td>".$item['name']."</td>";
        echo "<td>".$item['size']."</td>";
        echo "<td>$".$item['price']."</td>";
        echo "<td><form style='' method='post' action=''>
              <input type='hidden' name='key' value='".$key."'>
              <input type='number' name='quantity' min='1' value='".$item['quantity']."'>
              <input type='submit' name='update' value='Upravit'>
              </form></td>";
        echo "<td>$".$item['price'] * $item['quantity']."</td>";
        echo "<td><a href='cart.php?action=remove&id=".$key."'>Smazat</a></td>";
        echo "</tr>";
        $total += $item['price'] * $item['quantity'];
    }
    echo "<tr>";
    echo "<td colspan='3'>Celkem</td>";
    echo "<td>$".$total."</td>";
    echo "<td></td>";
    echo "</tr>";
    echo "</table>";
    echo "<a class='checkout' href='checkout.php'>K pokladně</a>";
} else {
    echo "<p class='empty'>Vypadá to tu prázdně.</p>";
    echo "<a style='font-size: 50px; text-align: center; display: block; color: white;' href='index.php'>Vrátit se?</a>";
}

if(isset($_POST['update'])) {
    $key = $_POST['key'];
    $quantity = $_POST['quantity'];
    if($quantity <= 0) {
        unset($_SESSION['cart'][$key]);
    } else {
        $_SESSION['cart'][$key]['quantity'] = $quantity;
    }
}


if(isset($_GET['action'])) {
    if($_GET['action'] == 'remove') {
        unset($_SESSION['cart'][$_GET['id']]);
    }
}
?>
</body>
</html>