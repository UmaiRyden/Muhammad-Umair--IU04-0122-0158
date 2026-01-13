<?php
include "db.php";

$id = $_GET['id'];
$query = "DELETE FROM products WHERE id=?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

header("Location: product.php");
exit();
?>
