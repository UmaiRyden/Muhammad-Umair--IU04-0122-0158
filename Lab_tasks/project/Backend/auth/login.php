<?php
include "../db.php";
session_start();

$data = json_decode(file_get_contents("php://input"), true);

$email = $data["email"];
$password = $data["password"];

$query = "SELECT * FROM users WHERE email='$email' AND password='$password' LIMIT 1";
$result = mysqli_query($conn, $query);

$user = mysqli_fetch_assoc($result);

if (!$user) {
    echo json_encode([
        "success" => false,
        "error" => "Invalid credentials"
    ]);
    exit;
}

$_SESSION["user_id"] = $user["id"];

echo json_encode([
    "success" => true,
    "user" => [
        "id" => $user["id"],
        "name" => $user["name"],
        "email" => $user["email"]
    ]
]);
