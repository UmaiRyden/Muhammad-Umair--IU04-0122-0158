<?php
include "../auth/auth_check.php";
include "../db.php";

$id = $_GET["id"];

$sql = "UPDATE projects SET is_deleted = 1 WHERE id=$id";

if (mysqli_query($conn, $sql)) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "error" => mysqli_error($conn)]);
}
