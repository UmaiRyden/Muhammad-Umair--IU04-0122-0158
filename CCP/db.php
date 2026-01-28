<?php
$conn = mysqli_connect("localhost", "root", "", "wpl");

if (!$conn) {
    die("Database connection failed");
}

mysqli_set_charset($conn, "utf8");
?>
