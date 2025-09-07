<?php
// Database connection
$con = mysqli_connect("localhost", "root", "", "myshop");

// Check connection
if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>
