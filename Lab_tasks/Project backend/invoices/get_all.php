<?php
include "../auth/auth_check.php";
include "../db.php";

$sql = "SELECT invoices.*, clients.name AS client_name, projects.name AS project_name
        FROM invoices
        LEFT JOIN clients ON invoices.client_id = clients.id
        LEFT JOIN projects ON invoices.project_id = projects.id
        WHERE invoices.is_deleted = 0
        ORDER BY invoices.id DESC";

$result = mysqli_query($conn, $sql);

$invoices = [];

while ($row = mysqli_fetch_assoc($result)) {
    $invoices[] = [
        "id" => $row["id"],
        "invoiceNumber" => $row["invoice_number"],
        "clientId" => $row["client_id"],
        "clientName" => $row["client_name"],
        "projectId" => $row["project_id"],
        "projectName" => $row["project_name"],
        "invoiceDate" => $row["invoice_date"],
        "dueDate" => $row["due_date"],
        "description" => $row["description"],
        "amount" => $row["amount"],
        "status" => $row["status"]
    ];
}

echo json_encode($invoices);
