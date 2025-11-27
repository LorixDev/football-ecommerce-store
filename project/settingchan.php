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
    <title>Změnit heslo</title>
    <style>
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 75vh;
            color: white;
        }
        .login-form {
            width: 15%;
            height: 450px;
            background-color: #424242;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 0px 4px #8a8a8a;
        }
        .login-form h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .login-form p {
            text-align: center;
            margin-bottom: 20px;
        }
        .error {
            color: red;
            margin-bottom: 20px;
        }
        .input-group {
            margin-bottom: 20px;
        }
        .input-group label {
            display: block;
            margin-bottom: 5px;
        }
        .input-group input {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .btn {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .btn:hover {
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
if(!isset($_SESSION['username'])) {
    header("location: login.php");
    exit();
}

$error = '';
$success = '';

if(isset($_POST['changePassword'])) {
    $currentPassword = mysqli_real_escape_string($conn, $_POST['currentPassword']);
    $newPassword = mysqli_real_escape_string($conn, $_POST['newPassword']);
    $confirmPassword = mysqli_real_escape_string($conn, $_POST['confirmPassword']);

    $userId = $_SESSION['id'];
    $query = "SELECT password FROM users WHERE id=$userId";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);
    $storedPassword = $user['password'];

    if(!password_verify($currentPassword, $storedPassword)) {
        $error = "Nesprávné stávající heslo.";
    } elseif($newPassword != $confirmPassword) {
        $error = "Nová hesla se neshodují.";
    } else {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $updateQuery = "UPDATE users SET password='$hashedPassword' WHERE id=$userId";
        if(mysqli_query($conn, $updateQuery)) {
            $success = "Heslo bylo úspěšně změněno.";
        } else {
            $error = "Nepodařilo se změnit heslo. Zkuste to prosím později.";
        }
    }
}
?>
<div class="container">
    <form method="post" action="" class="login-form">
        <h2>Změna hesla</h2>
        <?php if(!empty($error)){ ?>
            <div class="error"><?php echo $error; ?></div>
        <?php } ?>
        <?php if(!empty($success)){ ?>
            <div class="success"><?php echo $success; ?></div>
        <?php } ?>
        <div class="input-group">
            <label for="currentPassword">Aktuální heslo</label>
            <input type="password" name="currentPassword" id="currentPassword" required>
        </div>
        <div class="input-group">
            <label for="newPassword">Nové heslo</label>
            <input type="password" name="newPassword" id="newPassword" required>
        </div>
        <div class="input-group">
            <label for="confirmPassword">Potvrzení nového hesla</label>
            <input type="password" name="confirmPassword" id="confirmPassword" required>
        </div>
        <div class="input-group">
            <button type="submit" class="btn" name="changePassword">Změnit heslo</button>
        </div>
        <p><a href="index.php" style="color: #4CAF50">Zpět na úvodní stránku</a></p>
    </form>
</div>
</body>
</html>