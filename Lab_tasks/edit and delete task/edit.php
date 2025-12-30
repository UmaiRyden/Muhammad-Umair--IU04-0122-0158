<?php
$conn = mysqli_connect('localhost', 'root', '', 'wpl');

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $type = $_POST['type'];
    $company = $_POST['company'];
    $price = $_POST['price'];
    
    $query = "UPDATE products SET Name='$name', Type='$type', Company='$company', Price='$price' WHERE id=$id";
    mysqli_query($conn, $query);
    
    header("Location: products.php");
    exit();
}

$id = $_GET['id'];

$query = "SELECT * FROM products WHERE id = $id";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container" style="margin-top: 100px;">
        <h2>Edit Product</h2>
        <a href="products.php" class="btn btn-secondary">Back to Products</a><br><br>
        
        <form method="post" action="edit.php">
            <div class="form-group" style="margin: 10px;">
                <label>Product Name:</label>
                <input type="text" class="form-control" name="name" value="<?php echo $row['Name']; ?>" required>
            </div>
            
            <div class="form-group" style="margin: 10px;">
                <label>Product Type:</label>
                <input type="text" class="form-control" name="type" value="<?php echo $row['Type']; ?>" required>
            </div>
            
            <div class="form-group" style="margin: 10px;">
                <label>Company:</label>
                <input type="text" class="form-control" name="company" value="<?php echo $row['Company']; ?>" required>
            </div>
            
            <div class="form-group" style="margin: 10px;">
                <label>Price:</label>
                <input type="number" class="form-control" name="price" value="<?php echo $row['Price']; ?>" required>
            </div>
            
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            
            <button type="submit" class="btn btn-primary" style="margin: 10px;">Update Product</button>
        </form>
    </div>
</body>
</html>