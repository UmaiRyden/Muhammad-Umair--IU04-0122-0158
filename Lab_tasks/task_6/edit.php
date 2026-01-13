<?php
include "db.php";
include "header.php";

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $type = $_POST['type'];
    $company = $_POST['company'];
    $price = $_POST['price'];
    
    $query = "UPDATE products SET Name='$name', Type='$type', Company='$company', Price='$price' WHERE id='$id'";
    mysqli_query($conn, $query);
    
    header("Location: product.php");
    exit();
}

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM products WHERE id='$id'");
$row = mysqli_fetch_assoc($result);
?>

<h2>Edit Product</h2>

<form method="POST" action="edit.php">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    
    <table border="1" width="100%">
        <tr>
            <td>Name:</td>
            <td><input type="text" name="name" value="<?php echo $row['Name']; ?>" required></td>
        </tr>
        <tr>
            <td>Type:</td>
            <td><input type="text" name="type" value="<?php echo $row['Type']; ?>" required></td>
        </tr>
        <tr>
            <td>Company:</td>
            <td><input type="text" name="company" value="<?php echo $row['Company']; ?>" required></td>
        </tr>
        <tr>
            <td>Price:</td>
            <td><input type="text" name="price" value="<?php echo $row['Price']; ?>" required></td>
        </tr>
        <tr>
            <td colspan="2" style="text-align:center;">
                <input type="submit" name="update" value="Update">
                <a href="product.php">Cancel</a>
            </td>
        </tr>
    </table>
</form>

<?php include "footer.php"; ?>
