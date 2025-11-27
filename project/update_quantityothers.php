<?php
session_start();
include("connect.php");
mysqli_set_charset($conn, 'utf8');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $product_id = $_POST["product_id"];
    $new_quantity = $_POST["new_quantity"];

    // Update quantity in database
    $sql = "UPDATE others_quantity SET quantity = $new_quantity WHERE product_id = $product_id";
    if ($conn->query($sql) === TRUE) {
        echo "Quantity updated successfully.";
    } else {
        echo "Error updating quantity: " . $conn->error;
    }
}
$conn->close();