<!DOCTYPE html>
<html lang="cs">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="icon" type="image/x-icon" href="moon.png">
    <title>Pokladna</title>
    <style>
        .table {
            width: 40%;
            margin: 50px auto;
            border-collapse: collapse;
            color: white;
        }
        .table th, td {
            text-align: left;
            padding: 10px;
            border-bottom: 1px solid #e0e0e0;
        }
        .table th {
            background-color: #0040ab;
        }
        .table tr:hover {
            transition: background-color 0.3s ease-in-out;
            background-color: #4883f6;
        }

        .empty {
            text-align: center;
            font-size: 24px;
            color: #03a87d;
        }
        .error {
            text-align: center;
            font-size: 16px;
            color: red;
        }
        .success {
            text-align: center;
            font-size: 24px;
            color: #21ff00;
        }
        form {
            color: white;
            display: flex;
            flex-direction: column;
            gap: 1rem;
            max-width: 400px;
            margin: 0 auto;
        }

        h2 {
            text-align: center;
            font-size: 1.5rem;
            font-weight: bold;
            margin-top: 2rem;
        }

        label {
            font-size: 1.2rem;
            font-weight: bold;
        }

        input[type='text'],
        input[type='email'],
        input[type='tel'],
        textarea {
            padding: 0.5rem;
            border: 2px solid #ccc;
            border-radius: 5px;
            font-size: 1.1rem;
            width: 100%;
        }

        select {
            padding: 0.5rem;
            border: 2px solid #ccc;
            border-radius: 5px;
            font-size: 1.1rem;
            width: 100%;
            appearance: none;
            background-color: #fff;
            background-image: url('data:image/svg+xml;utf8,<svg viewBox="0 0 10 5" xmlns="http://www.w3.org/2000/svg"><polygon points="5,0 0,5 10,5"/></svg>');
            background-repeat: no-repeat;
            background-position: right 0.5rem top 50%;
            background-size: 10px 5px;
        }

        input[type='submit'] {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 0.5rem 1rem;
            font-size: 1.2rem;
            cursor: pointer;
        }

        input[type='submit']:hover {
            background-color: #3e8e41;
        }

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
    echo "</tr>";
    $total = 0;
    foreach($_SESSION['cart'] as $key => $item) {
        echo "<tr>";
        echo "<td>".$item['name']."</td>";
        echo "<td>".$item['size']."</td>";
        echo "<td>$".$item['price']."</td>";
        echo "<td>".$item['quantity']."</td>";
        echo "<td>$".$item['price'] * $item['quantity']."</td>";
        echo "</tr>";
        $total += $item['price'] * $item['quantity'];
    }
    echo "<tr>";
    echo "<td colspan='3'>Celkem</td>";
    echo "<td></td>";
    echo "<td>$".$total."</td>";
    echo "</tr>";
    echo "</table>";

    // Display the checkout form
    echo "<form method='post' action=''>";
    echo "<h2>Fakturační údaje</h2>";
    echo "<label for='name'>Jméno a příjmení:</label>";
    echo "<input type='text' id='name' name='name' required>";
    echo "<label for='email'>Email:</label>";
    echo "<input type='email' id='email' name='email' required>";
    echo "<label for='address'>Adresa:</label>";
    echo "<textarea id='address' name='address' required></textarea>";
    echo "<label for='phone'>Telefon:</label>";
    echo "<input type='tel' id='phone' name='phone' required>";
    echo "<h2>Platba a doprava</h2>";
    echo "<label for='payment'>Způsob platby:</label>";
    echo "<select id='payment' name='payment' required>";
    echo "<option value='card'>Kartou</option>";
    echo "<option value='cash'>Hotově při převzetí</option>";
    echo "</select>";
    echo "<label for='shipping'>Způsob dopravy:</label>";
    echo "<select id='shipping' name='shipping' required>";
    echo "<option value='post'>Česká pošta</option>";
    echo "<option value='courier'>Kurýrem</option>";
    echo "</select>";
    echo "<input type='submit' name='submit' value='Objednat'>";
    echo "</form>";}
else {
    echo "<p class='empty'>Vypadá to tu prázdně.</p>";
    echo "<a style='font-size: 50px; text-align: center; display: block; color: white;' href='index.php'></a>";
}

if(isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $payment = $_POST['payment'];
    $shipping = $_POST['shipping'];

    $sql = "INSERT INTO orders (name, email, address, phone, payment, shipping, total) VALUES ('$name', '$email', '$address', '$phone', '$payment', '$shipping', '$total')";
    $result = mysqli_query($conn, $sql);

    if($result) {
        // Get the order ID
        $order_id = mysqli_insert_id($conn);

        // Insert the item details into the order_items table
        foreach($_SESSION['cart'] as $key => $item) {
            $product_name = $item['name'];
            $product_size = $item['size'];
            $product_price = $item['price'];
            $product_quantity = $item['quantity'];
            $sql = "INSERT INTO order_items (order_id, product_name, size, price, quantity) VALUES ('$order_id', '$product_name', '$product_size', '$product_price', '$product_quantity')";
            mysqli_query($conn, $sql);
        }

        echo "<p class='success'>Vaše objednávka byla úspěšně odeslána.</p>";
    } else {
        echo "<p class='error'>Nastala chyba při odesílání objednávky. Zkuste to prosím znovu později.</p>";
    }

    unset($_SESSION['cart']);
    $total = 0;
}


mysqli_close($conn);
?>
</body>
</html>