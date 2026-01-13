<?php
include "../auth/auth_check.php";
include "../db.php";

$sql = "SELECT projects.*, clients.name AS client_name
        FROM projects
        JOIN clients ON projects.client_id = clients.id
        WHERE projects.is_deleted = 0 AND clients.is_deleted = 0
        ORDER BY projects.id DESC";

$result = mysqli_query($conn, $sql);

$projects = [];

while ($row = mysqli_fetch_assoc($result)) {
    $projects[] = [
        "id" => $row["id"],
        "clientId" => $row["client_id"],
        "clientName" => $row["client_name"],
        "name" => $row["name"],
        "description" => $row["description"],
        "startDate" => $row["start_date"],
        "endDate" => $row["end_date"],
        "priceType" => $row["price_type"],
        "hourlyRate" => $row["hourly_rate"],
        "fixedPrice" => $row["fixed_price"],
        "status" => $row["status"],
    ];
}

echo json_encode($projects);
