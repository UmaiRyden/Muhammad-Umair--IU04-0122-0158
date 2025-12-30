<?php
include "../header.php";

include "../db.php";

$id = $_GET["id"];

$sql = "SELECT invoices.*, 
        clients.name AS client_name, 
        clients.email AS client_email, 
        clients.phone AS client_phone, 
        clients.company AS client_company,
        projects.name AS project_name
        FROM invoices
        LEFT JOIN clients ON invoices.client_id = clients.id
        LEFT JOIN projects ON invoices.project_id = projects.id
        WHERE invoices.id = $id";

$result = mysqli_query($conn, $sql);
$invoice = mysqli_fetch_assoc($result);
?>

<div class="container mt-4 mb-4">
    <div class="card shadow-sm">
        <div class="card-body p-5">

            <div class="border-bottom pb-3 mb-4">
                <div class="row">
                    <div class="col-md-6">
                        <h2 class="mb-0">INVOICE</h2>
                        <p class="text-muted">Invoice #<?php echo $invoice["invoice_number"]; ?></p>
                    </div>
                    <div class="col-md-6 text-end">
                        <p><strong>Date:</strong> <?php echo $invoice["invoice_date"]; ?></p>
                        <p><strong>Due Date:</strong> <?php echo ($invoice["due_date"] ?: "-"); ?></p>
                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <h6 class="text-muted">Bill To</h6>
                    <p class="mb-1"><strong><?php echo $invoice["client_name"]; ?></strong></p>
                    <p class="mb-1"><?php echo $invoice["client_company"]; ?></p>
                    <p class="mb-1"><?php echo $invoice["client_email"]; ?></p>
                    <p class="mb-0"><?php echo $invoice["client_phone"]; ?></p>
                </div>

                <div class="col-md-6">
                    <h6 class="text-muted">Project</h6>
                    <p><?php echo $invoice["project_name"]; ?></p>
                </div>
            </div>

            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>Description</th>
                        <th class="text-end">Amount ($)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $invoice["description"]; ?></td>
                        <td class="text-end">
                            $<?php echo number_format($invoice["amount"], 2); ?>
                        </td>
                    </tr>
                </tbody>
                <tfoot class="table-light">
                    <tr>
                        <th class="text-end">Total</th>
                        <th class="text-end">
                            $<?php echo number_format($invoice["amount"], 2); ?>
                        </th>
                    </tr>
                </tfoot>
            </table>

            <div class="mt-4">
                <h6>Status</h6>
                <?php
                $statusClass = "secondary";
                if ($invoice["status"] == "Paid") $statusClass = "success";
                if ($invoice["status"] == "Pending") $statusClass = "warning";
                if ($invoice["status"] == "Overdue") $statusClass = "danger";
                ?>
                <span class="badge bg-<?php echo $statusClass; ?> px-3 py-2">
                    <?php echo $invoice["status"]; ?>
                </span>
            </div>

            <div class="mt-4 no-print">
                <button class="btn btn-primary" onclick="window.print()">
                    Print / Save as PDF
                </button>
            </div>

        </div>
    </div>
</div>

<?php
include "../footer.php";
?>
