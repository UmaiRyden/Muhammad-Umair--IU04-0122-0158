<?php
header("Access-Control-Allow-Origin: http://localhost:3000"); // Saari API requests allow karne ke liye
header("Access-Control-Allow-Credentials: true"); // Credentials: "include"
header("Access-Control-Allow-Headers: Content-Type"); // Content-Type header allow karne ke liye
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS"); // GET, POST, PUT, DELETE, OPTIONS methods allow karne ke liye
header("Content-Type: application/json"); // Content-Type header set karne ke liye

// pre access confirm karne ke liye taake real data bhej sake 
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "freelancer_dashboard");

if (!$conn) {
    echo json_encode(["error" => "Database connection failed"]);
    exit;
}
?>
