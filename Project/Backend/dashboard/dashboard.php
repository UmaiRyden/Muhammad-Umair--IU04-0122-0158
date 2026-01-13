<?php
include "../auth/auth_check.php";
include "../db.php";

$clientsQuery = "SELECT COUNT(*) AS total_clients FROM clients WHERE is_deleted = 0";
$clientsResult = mysqli_query($conn, $clientsQuery);
$clientsRow = mysqli_fetch_assoc($clientsResult);
$total_clients = $clientsRow["total_clients"];

$projectsQuery = "SELECT COUNT(*) AS total_projects FROM projects WHERE is_deleted = 0";
$projectsResult = mysqli_query($conn, $projectsQuery);
$projectsRow = mysqli_fetch_assoc($projectsResult);
$total_projects = $projectsRow["total_projects"];

$completedQuery = "SELECT COUNT(*) AS completed_projects FROM projects WHERE status = 'completed' AND is_deleted = 0";
$completedResult = mysqli_query($conn, $completedQuery);
$completedRow = mysqli_fetch_assoc($completedResult);
$completed_projects = $completedRow["completed_projects"];

$ongoingQuery = "SELECT COUNT(*) AS ongoing_projects FROM projects WHERE status = 'ongoing' AND is_deleted = 0";
$ongoingResult = mysqli_query($conn, $ongoingQuery);
$ongoingRow = mysqli_fetch_assoc($ongoingResult);
$ongoing_projects = $ongoingRow["ongoing_projects"];

$invoicesQuery = "SELECT COUNT(*) AS total_invoices FROM invoices WHERE is_deleted = 0";
$invoicesResult = mysqli_query($conn, $invoicesQuery);
$invoicesRow = mysqli_fetch_assoc($invoicesResult);
$total_invoices = $invoicesRow["total_invoices"];

$incomeQuery = "SELECT SUM(amount) AS total_income FROM invoices WHERE is_deleted = 0";
$incomeResult = mysqli_query($conn, $incomeQuery);
$incomeRow = mysqli_fetch_assoc($incomeResult);
$total_income = $incomeRow["total_income"];

echo json_encode([
  "total_clients" => $total_clients,
  "total_projects" => $total_projects,
  "completed_projects" => $completed_projects,
  "ongoing_projects" => $ongoing_projects,
  "total_invoices" => $total_invoices,
  "total_income" => $total_income,
]);
?>

