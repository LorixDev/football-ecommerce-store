<?php
session_start();
include('connect.php');
if (isset($_POST["id"])) {
    // Sanitize the input to prevent SQL injection attacks
    $id = mysqli_real_escape_string($conn, $_POST["id"]);

// Delete the user from the database
    $result = mysqli_query($conn, "DELETE FROM users WHERE id = '$id'");
    if (!$result) {
        // There was an error deleting the user
        echo "Error: " . mysqli_error($conn);
    } else {
        echo "User deleted successfully!";
    }

    echo "User deleted successfully!";
}
?>
