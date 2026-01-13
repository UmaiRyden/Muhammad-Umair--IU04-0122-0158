<?php
include "db.php";
include "header.php";

if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $type = $_POST['type'];
    $company = $_POST['company'];
    $price = $_POST['price'];

    $query = "INSERT INTO products (Name, Type, Company, Price)
              VALUES ('$name', '$type', '$company', '$price')";

    mysqli_query($conn, $query);

    header("Location: product.php");
    exit;

}
?>

<h2>Add Product</h2>

<form method="post">
    <label>Name:</label><br>
    <input type="text" name="name" required><br><br>

    <label>Type:</label><br>
    <input type="text" name="type" required><br><br>

    <label>Company:</label><br>
    <input type="text" name="company" required><br><br>

    <label>Price:</label><br>
    <input type="number" name="price" required><br><br>

    <button type="submit" name="submit">Add Product</button>
</form>

<?php include "footer.php"; ?>
