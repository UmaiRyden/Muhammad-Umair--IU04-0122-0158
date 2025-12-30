<?php
include "../auth/auth_check.php";
include "../db.php";

$raw = file_get_contents("php://input");
$data = json_decode($raw, true);

if (!$data) {
    echo json_encode(["success" => false, "error" => "No JSON data received"]);
    exit;
}

$name = $data["name"];
$email = $data["email"];
$phone = $data["phone"];
$company = $data["company"];
$rate = $data["hourlyRate"];
$notes = $data["notes"];

$sql = "INSERT INTO clients (name, email, phone, company, hourly_rate, notes)
        VALUES ('$name', '$email', '$phone', '$company', '$rate', '$notes')";

if (mysqli_query($conn, $sql)) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "error" => mysqli_error($conn)]);
}
?>
