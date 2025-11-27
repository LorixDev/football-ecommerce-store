<?php
session_start();
include("connect.php");
// Check if the product ID was provided in the URL
if (!isset($_GET['id'])) {
die("Product ID not provided.");
}

// Retrieve the product ID from the URL parameter
$id = $_GET['id'];

// Delete the product from the database
$sql = "DELETE FROM products WHERE id = $id";
if (mysqli_query($conn, $sql)) {
echo "Product deleted successfully.";
} else {
echo "Error deleting product: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>