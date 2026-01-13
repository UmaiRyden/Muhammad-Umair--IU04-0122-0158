<?php
include "../auth/auth_check.php";
include "../db.php";

$data = json_decode(file_get_contents("php://input"), true);

$invoiceNumber = $data["invoiceNumber"];
$clientId = $data["clientId"];
$projectId = $data["projectId"] ? $data["projectId"] : "NULL";
$invoiceDate = $data["invoiceDate"];
$dueDate = $data["dueDate"] ? "'" . $data["dueDate"] . "'" : "NULL";
$description = $data["description"];
$amount = $data["amount"];
$status = $data["status"];

$sql = "INSERT INTO invoices (invoice_number, client_id, project_id, invoice_date, due_date, description, amount, status)
VALUES ('$invoiceNumber', $clientId, $projectId, '$invoiceDate', $dueDate, '$description', $amount, '$status')";

if (mysqli_query($conn, $sql)) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false]);
}
