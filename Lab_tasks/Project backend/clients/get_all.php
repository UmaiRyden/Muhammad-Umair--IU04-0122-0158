<?php
include "../auth/auth_check.php";
include '../db.php';

$sql = "SELECT * FROM clients WHERE is_deleted = 0 ORDER BY id DESC";
$result = mysqli_query($conn, $sql);

$clients = [];

while ($row = mysqli_fetch_assoc($result)) {
    $clients[] = $row;
}

echo json_encode($clients);
?>
