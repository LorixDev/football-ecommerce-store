<?php
session_start();
include("connect.php");
mysqli_set_charset($conn, 'utf8');
if (isset($_GET['redirectedFrom']) && $_GET['redirectedFrom'] == 'logout') {
    echo "<script>alert('Úspěšně odhlášen!'); window.location = 'index.php';</script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset=UTF-8>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="icon" type="image/x-icon" href="moon.png">
    <title>Hlavní stránka</title>
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

<div class="nomaxwidth">
    <div class="filters">
        <div class="innerfilters">
            <form method="get">
                <input type="text" name="search" placeholder="Hledat produkty...">

                <label for="categories">Kategorie:</label>
                <?php
                $query = "SELECT * FROM `categories`";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                    $category_id = $row['id'];
                    $category_name = $row['name'];
                    $checked = '';
                    if (isset($_GET['categories']) && in_array($category_id, $_GET['categories'])) {
                        $checked = 'checked';
                    }
                    echo "<input type='checkbox' name='categories[]' value='$category_id' id='category_$category_id' $checked>";
                    echo "<label for='category_$category_id'>$category_name</label>";
                }
                ?>

                <button type="submit">Filtrovat</button>
            </form>
        </div>
    </div>


    <div class="product">
        <?php
        $where_conditions = array();

        // Check if categories are selected
        if (isset($_GET['categories']) && is_array($_GET['categories'])) {
            $category_ids = array_map('intval', $_GET['categories']);
            $category_conditions = array();
            foreach ($category_ids as $category_id) {
                $category_conditions[] = "`category_id` = $category_id";
            }
            $where_conditions[] = "(" . implode(' OR ', $category_conditions) . ")";
        }

        // Check if search keyword is present
        if (isset($_GET['search'])) {
            $search_keyword = mysqli_real_escape_string($conn, $_GET['search']);
            $where_conditions[] = "(`p`.`name` LIKE '%$search_keyword%')";
        }


        $where_clause = '';
        if (!empty($where_conditions)) {
            $where_clause = 'WHERE ' . implode(' AND ', $where_conditions);
        }

        $query = "SELECT `p`.`id`, `p`.`name`, `c`.`name` AS `category`, `p`.`price`, `p`.`image_path`
          FROM `products` `p`
          INNER JOIN `categories` `c` ON `p`.`category_id` = `c`.`id`
          $where_clause";

        $result = mysqli_query($conn, $query);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)): ?>
        <div class="product-item">
            <img src="<?= $row['image_path'] ?>" alt="<?= $row['name'] ?>">
            <h3><?= $row['name'] ?></h3>
            <p>Kategorie: <?= $row['category'] ?></p>
            <p>Cena: $<?= $row['price'] ?></p>
            <form style="margin: auto" method="get" action="product_details.php">
                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                <button type="submit" name="viewDetails">Zobrazit detaily</button>
            </form>
        </div>
    <?php endwhile;
} else {
    echo "Error executing query: " . mysqli_error($conn);
}
?>
    </div>
</div>



</body>
</html>
