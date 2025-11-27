<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="icon" type="image/x-icon" href="moon.png">
    <title>Produkt</title>
    <style>
        .product {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .product-item {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin: 20px;
            padding: 20px;
            border: 1px solid black;
        }
        .product-item img {
            max-width: 100%;
            max-height: 200px;
            margin-bottom: 10px;
        }
        .product-item form {
            margin-top: 10px;
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


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Retrieve the product details from the database
    $query = "SELECT `p`.`id`, `p`.`name`, `c`.`name` AS `category`, `d`.`description`, `p`.`price`, `p`.`image_path`, `p`.`category_id`
    FROM `products` `p`
    INNER JOIN `categories` `c` ON `p`.`category_id` = `c`.`id`
    INNER JOIN `descriptions` `d` ON `p`.`id` = `d`.`product_id`
    WHERE `p`.`id` = $id";
    $result = mysqli_query($conn, $query);
    $product = mysqli_fetch_assoc($result);

    if ($product['category_id'] == 1) {
        $sizeTable = "shoe_sizing";
        $quantityTable = "shoe_sizes_quantity";
    } else if (in_array($product['category_id'], array(2, 3, 4, 7))) {
        $sizeTable = "size_obleceni";
        $quantityTable = "clothing_sizes_quantity";
    } else if (in_array($product['category_id'], array(5, 6, 8))) {
        $quantityTable = "others_quantity";
    }
}else {
    header("Location: products.php");
    exit();
}
?>

<div class="product">
    <div class="product-item">
        <img src="<?= $product['image_path'] ?>" alt="<?= $product['name'] ?>">
        <h1><?= $product['name'] ?></h1>
        <p>Kategorie: <?= $product['category'] ?></p>
        <p>Cena: $<?= $product['price'] ?></p>
        <p>Popis: <?= $product['description'] ?></p>
            <form style="margin: auto" method="post" action="add_to_cart.php">
                <input type="hidden" name="productId" value="<?= $product['id'] ?>">
                <label for="size">Velikost:</label>
                <select id="size" name="size">
                    <option value="none"></option>
                    <?php
                    $query = "SELECT `size_id`, `quantity` FROM `$quantityTable` WHERE `product_id` = $id";
                    $result = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $sizeId = $row['size_id'];
                        $quantity = $row['quantity'];
                        $sizeQuery = "SELECT `Velikost` FROM `$sizeTable` WHERE `id` = $sizeId";
                        $sizeResult = mysqli_query($conn, $sizeQuery);
                        $size = mysqli_fetch_assoc($sizeResult)['Velikost'];
                        if ($quantity > 0) {
                            echo "<option value='$size'>$size ($quantity)</option>";
                        }
                    }
                    ?>
                </select>
                <input type="hidden" id="selectedSize" name="size" value="">
                <label for="quantity">Množství:</label>
                <input type="number" name="quantity" id="quantity" min="1" max="10" value="1" required>
                <button style="width: 100%" type="submit" name="addToCart">Přidat do koše</button>
            </form>
</div>
</div>
<script>
    const sizeSelect = document.getElementById('size');
    const selectedSizeInput = document.getElementById('selectedSize');
    sizeSelect.addEventListener('change', (event) => {
        selectedSizeInput.value = event.target.value;
    });
</script>
</body>
</html>
