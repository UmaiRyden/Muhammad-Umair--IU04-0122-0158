<?php
include "../auth/auth_check.php";
include "../db.php";

// 1. Total Income (YTD)
$year = date("Y");
$incomeYTDQuery = "SELECT SUM(amount) AS income_ytd 
                   FROM invoices 
                   WHERE YEAR(invoice_date) = '$year' AND is_deleted = 0";
$incomeYTDResult = mysqli_query($conn, $incomeYTDQuery);
$incomeYTD = mysqli_fetch_assoc($incomeYTDResult);

// 2. Active Clients
$activeClientsQuery = "SELECT COUNT(DISTINCT client_id) AS active_clients 
                       FROM projects 
                       WHERE status = 'ongoing' AND is_deleted = 0";
$activeClientsResult = mysqli_query($conn, $activeClientsQuery);
$activeClients = mysqli_fetch_assoc($activeClientsResult);

// 3. Active Projects
$activeProjectsQuery = "SELECT COUNT(*) AS active_projects 
                        FROM projects 
                        WHERE status = 'ongoing' AND is_deleted = 0";
$activeProjectsResult = mysqli_query($conn, $activeProjectsQuery);
$activeProjects = mysqli_fetch_assoc($activeProjectsResult);

// 4. Average Monthly Income
$avgIncomeQuery = "SELECT AVG(amount) AS avg_income 
                   FROM invoices 
                   WHERE is_deleted = 0";
$avgIncomeResult = mysqli_query($conn, $avgIncomeQuery);
$avgIncome = mysqli_fetch_assoc($avgIncomeResult);

// 5. Yearly Income Trend (month totals)
$trendQuery = "SELECT MONTH(invoice_date) AS month, SUM(amount) AS total 
               FROM invoices 
               WHERE YEAR(invoice_date) = '$year' AND is_deleted = 0
               GROUP BY MONTH(invoice_date)
               ORDER BY MONTH(invoice_date)";
$trendResult = mysqli_query($conn, $trendQuery);

$incomeTrend = [];
while ($row = mysqli_fetch_assoc($trendResult)) {
    $incomeTrend[] = $row;
}

// 6. Completed vs Ongoing Projects
$completedQuery = "SELECT COUNT(*) AS completed 
                   FROM projects 
                   WHERE status = 'completed' AND is_deleted = 0";
$completedResult = mysqli_query($conn, $completedQuery);
$completed = mysqli_fetch_assoc($completedResult);

$ongoingQuery = "SELECT COUNT(*) AS ongoing 
                 FROM projects 
                 WHERE status = 'ongoing' AND is_deleted = 0";
$ongoingResult = mysqli_query($conn, $ongoingQuery);
$ongoing = mysqli_fetch_assoc($ongoingResult);

// 7. Client Performance Table
$clientListQuery = "SELECT id, name FROM clients WHERE is_deleted = 0";
$clientListResult = mysqli_query($conn, $clientListQuery);

$clientReport = [];

while ($client = mysqli_fetch_assoc($clientListResult)) {

    $clientId = $client["id"];

    $revQuery = "SELECT SUM(amount) AS revenue 
                 FROM invoices 
                 WHERE client_id = $clientId AND is_deleted = 0";
    $revResult = mysqli_query($conn, $revQuery);
    $revData = mysqli_fetch_assoc($revResult);

    $projQuery = "SELECT COUNT(*) AS proj_count 
                  FROM projects 
                  WHERE client_id = $clientId AND is_deleted = 0";
    $projResult = mysqli_query($conn, $projQuery);
    $projData = mysqli_fetch_assoc($projResult);

    $clientReport[] = [
        "client_name" => $client["name"],
        "total_revenue" => $revData["revenue"],
        "project_count" => $projData["proj_count"]
    ];
}

// 8. Hourly vs Fixed Income
$hourlyQuery = "SELECT SUM(hourly_rate) AS hourly_income 
                FROM projects 
                WHERE price_type = 'hourly' AND is_deleted = 0";
$hourlyResult = mysqli_query($conn, $hourlyQuery);
$hourlyIncome = mysqli_fetch_assoc($hourlyResult);

$fixedQuery = "SELECT SUM(fixed_price) AS fixed_income 
               FROM projects 
               WHERE price_type = 'fixed' AND is_deleted = 0";
$fixedResult = mysqli_query($conn, $fixedQuery);
$fixedIncome = mysqli_fetch_assoc($fixedResult);

// Return JSON
echo json_encode([
    "income_ytd" => $incomeYTD["income_ytd"],
    "active_clients" => $activeClients["active_clients"],
    "active_projects" => $activeProjects["active_projects"],
    "avg_monthly_income" => $avgIncome["avg_income"],
    "income_trend" => $incomeTrend,
    "completed_projects" => $completed["completed"],
    "ongoing_projects" => $ongoing["ongoing"],
    "client_performance" => $clientReport,
    "hourly_income" => $hourlyIncome["hourly_income"],
    "fixed_income" => $fixedIncome["fixed_income"]
]);
?>
