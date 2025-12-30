<?php
include "../auth/auth_check.php";
include "../db.php";

$id = $_GET["id"];
$data = json_decode(file_get_contents("php://input"), true);

$name = $data["name"];
$email = $data["email"];
$phone = $data["phone"];
$company = $data["company"];
$rate = $data["hourlyRate"];
$notes = $data["notes"];

$sql = "UPDATE clients 
        SET name='$name', email='$email', phone='$phone',
            company='$company', hourly_rate='$rate', notes='$notes'
        WHERE id=$id";

if (mysqli_query($conn, $sql)) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "error" => mysqli_error($conn)]);
}
?>
