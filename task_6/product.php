<?php
include "db.php";
include "header.php"; 

$result = mysqli_query($conn, "SELECT * FROM products");
$data = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<h2>Products List</h2>

<table border="1" width="100%" style="text-align:center;">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Type</th>
        <th>Company</th>
        <th>Price</th>
    </tr>

    <?php foreach ($data as $row) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['Name']; ?></td>
            <td><?php echo $row['Type']; ?></td>
            <td><?php echo $row['Company']; ?></td>
            <td><?php echo $row['Price']; ?></td>
        </tr>
    <?php } ?>
</table>

<?php include "footer.php"; ?>
