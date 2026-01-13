<?php
include "../auth/auth_check.php";
include "../db.php";

$data = json_decode(file_get_contents("php://input"), true);

$id = $data["id"];
$invoiceNumber = $data["invoiceNumber"];
$clientId = $data["clientId"];
$projectId = $data["projectId"] ? $data["projectId"] : "NULL";
$invoiceDate = $data["invoiceDate"];
$dueDate = $data["dueDate"] ? "'" . $data["dueDate"] . "'" : "NULL";
$description = $data["description"];
$amount = $data["amount"];
$status = $data["status"];

$sql = "UPDATE invoices SET 
    invoice_number='$invoiceNumber',
    client_id=$clientId,
    project_id=$projectId,
    invoice_date='$invoiceDate',
    due_date=$dueDate,
    description='$description',
    amount=$amount,
    status='$status'
    WHERE id=$id";

if (mysqli_query($conn, $sql)) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false]);
}
