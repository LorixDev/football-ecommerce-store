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
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the values from the form
    $id = $_POST["id"];
    $name = $_POST["name"];
    $category_id = $_POST["category_id"];
    $price = $_POST["price"];
    $image_path = $_POST["image_path"];
    $description = $_POST["description"];

    // Update the product in the database
    $sql = "UPDATE products SET name='$name', category_id='$category_id', price='$price', image_path='$image_path' WHERE id='$id'";
    if (mysqli_query($conn, $sql)) {
        // Update the description in the database
        $sql = "UPDATE descriptions SET description='$description' WHERE product_id='$id'";
        if (mysqli_query($conn, $sql)) {
            echo "Product updated successfully";
        } else {
            echo "Error updating description: " . mysqli_error($conn);
        }
    } else {
        echo "Error updating product: " . mysqli_error($conn);
    }
}

// Get the product ID from the URL parameter
$id = $_GET["id"];

// Fetch the product and description from the database
$sql = "SELECT p.*, d.description FROM products p LEFT JOIN descriptions d ON p.id=d.product_id WHERE p.id='$id'";
$result = mysqli_query($conn, $sql);
if (!$result) {
    die("Error fetching product: " . mysqli_error($conn));
}

// Display the product form
if ($row = mysqli_fetch_assoc($result)) {
    ?>
    <h1>Edit Product</h1>
    <form method="post">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    <label>Name:</label>
    <input type="text" name="name" value="<?php echo $row['name']; ?>"><br>
    <label>Category:</label>
    <select name="category_id">
        <?php
        // Fetch the categories from the database
        $sql = "SELECT * FROM categories";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            die("Error fetching categories: " . mysqli_error($conn));
        }

        // Display the categories in a dropdown
        while ($category = mysqli_fetch_assoc($result)) {
            $selected = ($category['id'] == $row['category_id']) ? 'selected' : '';
            echo "<option value='" . $category['id'] . "' " . $selected . ">" . $category['name'] . "</option>";
        }
        ?>
    </select><br>
    <label>Price:</label>
    <input type="text" name="price" value="<?php echo $row['price']; ?>"><br>
    <label>Image Path:</label>
    <input type="text" name="image_path" value="<?php echo $row['image_path']; ?>"><br>
    <label>Description:</label>
    <textarea name="description"><?php echo $row['description']; ?></textarea>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Save Changes</button>
            <a href="adminsettingsproducts.php" class="btn btn-default">Cancel</a>
        </div>
    </form>



    <?php
} else {
    echo "Product not found";
}

// Close the database connection
mysqli_close($conn);
?>
</body>
</html>