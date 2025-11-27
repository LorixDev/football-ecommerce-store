<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="icon" type="image/x-icon" href="moon.png">
    <title>Registrace</title>
    <style>
        #container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 75vh;
            color: white;
        }
        .register-form {
            width: 17%;
            height: 450px;
            background-color: #424242;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 0px 4px #8a8a8a;
        }
        .register-form h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .register-form p {
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
include('connect.php');

if(isset($_POST['submit'])){

    $username = mysqli_real_escape_string($conn,$_POST['username']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $password = mysqli_real_escape_string($conn,$_POST['password']);
    $admin = mysqli_real_escape_string($conn,$_POST['admin']);

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";

    if(mysqli_query($conn,$query)){
        session_regenerate_id();
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        $_SESSION['admin'] = $admin;
        $_SESSION['id'] = mysqli_insert_id($conn);
        session_write_close();
        header("location: index.php");
        exit();
    }else{
        $error = "Registrace zelhala, zkuste to zachvíli.";
    }
}
?>
<div id="container">
    <form method="post" action="" class="register-form">
        <h2>Registrace</h2>
        <p>Pro vytvoření účtu prosím vyplňte tyto údaje.</p>
        <?php if(isset($error)){ ?>
            <div class="error"><?php echo $error; ?></div>
        <?php } ?>
        <div class="input-group">
            <label>Username</label>
            <input type="text" name="username">
        </div>
        <div class="input-group">
            <label>Email</label>
            <input type="email" name="email">
        </div>
        <div class="input-group">
            <label>Heslo</label>
            <input type="password" name="password">
        </div>
        <div class="input-group">
            <button type="submit" class="btn" name="submit">Registrovat se</button>
        </div>
        <p>Už máte účet? <a href="login.php" style="color: #4CAF50">Přihlašte se zde</a>.</p>
    </form>
</div>
</body>
</html>
