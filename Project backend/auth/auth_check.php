<?php
include "../db.php";

session_start();

if (!isset($_SESSION["user_id"])) {
    echo json_encode(["success" => false, "error" => "Unauthorized"]);
    exit;
}
?>

