<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php
session_start();
//Include database connection details
include('connect.php');
// Start the session


// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();


// Redirect to the login page
header("Location: index.php?redirectedFrom=logout");
exit();
?>

</body>
</html>
