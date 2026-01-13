<?php
include "../auth/auth_check.php";
include "../db.php";

$data = json_decode(file_get_contents("php://input"), true); //frontend ka data json se PHP array me convert karne ke liye, kio ke react Typescript se data bhejta he tu $_POST se nahi bhej sakta, isliye using JSON

$id = $data["id"];
$name = $data["name"];
$clientId = $data["clientId"];
$description = $data["description"];
$startDate = $data["startDate"];
$endDate = $data["endDate"];
$priceType = $data["priceType"];
$hourlyRate = $data["hourlyRate"];
$fixedPrice = $data["fixedPrice"];
$status = $data["status"];

$sql = "UPDATE projects SET
        client_id='$clientId',
        name='$name',
        description='$description',
        start_date='$startDate',
        end_date='$endDate',
        price_type='$priceType',
        hourly_rate='$hourlyRate',
        fixed_price='$fixedPrice',
        status='$status'
        WHERE id=$id";

if (mysqli_query($conn, $sql)) { 
    echo json_encode(["success" => true]); //success message backend se frontend me convert karne ke liye
} else {
    echo json_encode(["success" => false, "error" => mysqli_error($conn)]);
}
