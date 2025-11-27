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
    <style>
        form {
            display: block;
            justify-content: center;
            align-items: center;
            max-width: 500px;
            margin: auto;
            padding: 20px;
            background-color: #f7f7f7;
            border-radius: 5px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        select,
        textarea {
            width: 100%;
            padding: 8px;
            border: none;
            border-radius: 5px;
            background-color: #fff;
            box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.1);
            font-size: 16px;
            font-family: inherit;
            line-height: 1.5;
        }

        input[type="number"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #fff;
            box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.1);
            font-size: 16px;
            font-family: inherit;
            line-height: 1.5;
        }

        textarea {
            height: 100px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            text-decoration: none;
            color: #fff;
            background-color: #007bff;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-default {
            background-color: #ddd;
            color: #555;
        }

        .btn-primary:hover {
            background-color: #0069d9;
        }

        .btn-default:hover {
            background-color: #ccc;
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

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Gather the form data
    $name = mysqli_real_escape_string($conn, $_POST['pname']);
    $category_id = mysqli_real_escape_string($conn, $_POST['category_id']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $image_path = mysqli_real_escape_string($conn, $_POST['image_path']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    // Insert the new product into the database
    $sql1 = "INSERT INTO products (name, category_id, price, image_path) VALUES ('$name', $category_id, $price, '$image_path')";
    mysqli_query($conn, $sql1);

    $product_id = mysqli_insert_id($conn);

    // Insert the description into the database
    $sql = "INSERT INTO descriptions (product_id, description) VALUES ($product_id, '$description')";
    mysqli_query($conn, $sql);

}

// Fetch the categories from the database
$sql2 = "SELECT id, name FROM categories";
$result = mysqli_query($conn, $sql2);

// Check if any categories were found
if (mysqli_num_rows($result) === 0) {
    die("No categories found in the database");
}

?>


<form  method="post">
    <h1>Add New Product</h1>
    <div class="form-group">
        <label>Name:</label>
        <input type="text" name="pname" required>
    </div>

    <div class="form-group">
        <label>Category:</label>
        <select name="category_id" required>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
            <?php } ?>
        </select>
    </div>

    <div class="form-group">
        <label>Price:</label>
        <input type="number" name="price" step="0.01" required>
    </div>

    <div class="form-group">
        <label>Image Path:</label>
        <input type="text" name="image_path" required>
    </div>

    <div class="form-group">
        <label>Description:</label>
        <textarea name="description" required></textarea>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary">Add Product</button>
        <a href="adminsettingsproducts.php" class="btn btn-default">Cancel</a>
    </div>
</form>
</body>
</html>