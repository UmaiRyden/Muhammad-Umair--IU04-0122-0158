<?php
include "db.php";
include "header.php";

$stmt = mysqli_prepare($conn, "SELECT * FROM products");
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_stmt_close($stmt);
?>

<h2>Products List</h2>

<table border="1" width="100%" style="text-align:center;">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Type</th>
        <th>Company</th>
        <th>Price</th>
        <th>Actions</th>
    </tr>
    
    <?php foreach ($data as $row) { ?>
        <tr>
            <td><?php echo htmlspecialchars($row['id']); ?></td>
            <td><?php echo htmlspecialchars($row['Name']); ?></td>
            <td><?php echo htmlspecialchars($row['Type']); ?></td>
            <td><?php echo htmlspecialchars($row['Company']); ?></td>
            <td><?php echo htmlspecialchars($row['Price']); ?></td>
            <td>
                <a href="edit.php?id=<?php echo (int)$row['id']; ?>">Edit</a> | 
                <a href="delete.php?id=<?php echo (int)$row['id']; ?>" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
            </td>
        </tr>
    <?php } ?>
</table>

<?php include "footer.php"; ?>
