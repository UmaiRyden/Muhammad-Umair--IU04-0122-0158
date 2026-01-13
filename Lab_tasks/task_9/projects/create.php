<?php
include "../auth/auth_check.php";
include "../db.php";

$data = json_decode(file_get_contents("php://input"), true);

$name = $data["name"];
$clientId = $data["clientId"];
$description = $data["description"];
$startDate = $data["startDate"];
$endDate = $data["endDate"];
$priceType = $data["priceType"];
$hourlyRate = $data["hourlyRate"];
$fixedPrice = $data["fixedPrice"];
$status = $data["status"];

$sql = "INSERT INTO projects (client_id, name, description, start_date, end_date, price_type, hourly_rate, fixed_price, status)
        VALUES ('$clientId', '$name', '$description', '$startDate', '$endDate', '$priceType', '$hourlyRate', '$fixedPrice', '$status')";

if (mysqli_query($conn, $sql)) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "error" => mysqli_error($conn)]);
}
