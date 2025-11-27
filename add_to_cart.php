<?php
session_start();
include('connect.php');

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

if (isset($_POST['productId'])) {
    $product_id = $_POST['productId'];
    $product = getProduct($product_id);


    if ($product) {
        addToCart($product);
    }
}

function getProduct($product_id) {
    include('connect.php');
    $query = "SELECT * FROM products WHERE id = $product_id";
    $result = mysqli_query($conn, $query);
    $product = mysqli_fetch_assoc($result);
    mysqli_close($conn);
    return $product;
}

function addToCart($product) {
    include('connect.php');
    $size = isset($_POST['size']) ? $_POST['size'] : null;
    $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;

    if ($size !== null) {
        $item = array(
            'id' => $product['id'],
            'name' => $product['name'],
            'price' => $product['price'],
            'size' => $size,
            'quantity' => $quantity
        );

        $cart_key = $product['id'] . '_' . $size;

        if (isset($_SESSION['cart'][$cart_key])) {

            $_SESSION['cart'][$cart_key]['quantity'] += $quantity;

        } else {

            $_SESSION['cart'][$cart_key] = $item;

        }
    } else {
        $item = array(
            'id' => $product['id'],
            'name' => $product['name'],
            'price' => $product['price'],
            'quantity' => $quantity
        );

        if (isset($_SESSION['cart'][$product['id']])) {

            $_SESSION['cart'][$product['id']]['quantity'] += $quantity;

        } else {

            $_SESSION['cart'][$product['id']] = $item;

        }
    }

    header('Location: index.php');
    exit;
}
?>
