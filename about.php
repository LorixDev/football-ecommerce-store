<?php
session_start();
include("connect.php");
mysqli_set_charset($conn, 'utf8');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="icon" type="image/x-icon" href="moon.png">
    <title>O nás</title>
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
<div class="container_about">
    <div class="about-me">
        <h1>O nás</h1>
        <p>Vítám vás na stránce! Jmenuji se Štěpán a jsem studentem a vývojářem této webové aplikace. Tento projekt je součástí mého školního maturitního projektu a zaměřuje se na fotbalový e-shop a nakupování v něm.</p>
        <p>Mým cílem bylo vytvořit uživatelsky přívětivou a intuitivní aplikaci, která usnadní nakupování v tomto e-shopu. Snažil jsem se přemýšlet o každém detailu, aby uživatelé mohli co nejlépe využít možností, které tato aplikace nabízí.</p>
        <p>Pokud máte nějaké dotazy nebo připomínky k aplikaci, neváhejte mě kontaktovat. Rád vám odpovím a pomohu vám s čímkoliv, co bude potřeba.</p>
        <p>Stránka soustředí své produkty na mužské hráče.</p>
        <p>Děkuji vám za návštěvu a těším se na vaši zpětnou vazbu!</p>
    </div>
</div>
</body>
</html>
