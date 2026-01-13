<?php
include "../db.php";

$data = json_decode(file_get_contents("php://input"), true);

$name = $data["name"];
$email = $data["email"];
$password = $data["password"];

$check = "SELECT id FROM users WHERE email='$email' LIMIT 1";
$result = mysqli_query($conn, $check);

if (mysqli_num_rows($result) > 0) {
    echo json_encode(["success" => false, "error" => "Email already registered"]);
    exit;
}

$query = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
mysqli_query($conn, $query);

echo json_encode(["success" => true]);
?>
