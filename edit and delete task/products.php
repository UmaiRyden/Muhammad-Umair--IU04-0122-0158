<?php
// $name = $_POST['name'];
// $type = $_POST['type'];
// $company = $_POST['company'];
// $price = $_POST['price'];

$conn = mysqli_connect('localhost', 'root', '', 'wpl');

// $query = "INSERT INTO products(name,type,company,price) VALUES('$name','$type','$company','$price')";

// mysqli_query($conn, $query);


$result= mysqli_query($conn, "SELECT * FROM products");

$row= mysqli_fetch_all($result, mode: MYSQLI_ASSOC);


echo "Product added succesfully!";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table border="1" width="100%" style="text-align: center;" action="products.php" method="get">
        <thead>
            <th>name</th>
            <th>type</th>
            <th>company</th>
            <th>price</th>
            <th colspan="2">Actions</th>
        </thead>
        <tbody>
            <?php 
            for ($i=0; $i < count($row); $i++) { 
                ?>
            <tr>
                <td><?php echo $row[$i]['id']; ?></td>
                <td><?php echo $row[$i]['Name']; ?></td>
                <td><?php echo $row[$i]['Type']; ?></td>
                <td><?php echo $row[$i]['Company']; ?></td>
                <td><?php echo $row[$i]['Price']; ?></td>
                <td><a href="edit.php?id=<?php echo $row[$i]['id']; ?>">Edit</a></td>
                <td><a href="delete.php?id=<?php echo $row[$i]['id']; ?>">Delete</a></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>


