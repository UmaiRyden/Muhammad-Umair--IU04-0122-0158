<?php
$conn = mysqli_connect('localhost', 'root', '', 'wpl');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $query = "DELETE FROM products WHERE id = $id";
    mysqli_query($conn, $query);
    
    header("Location: products.php");
    exit();
} else {
    header("Location: products.php");
    exit();
}
?>