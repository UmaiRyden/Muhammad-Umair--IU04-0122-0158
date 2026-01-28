<?php
include "db.php";
include "header.php";

$err = array("name" => "", "type" => "", "company" => "", "price" => "");

if (isset($_POST['submit'])) {
    $name = trim($_POST['name'] ?? "");
    $type = trim($_POST['type'] ?? "");
    $company = trim($_POST['company'] ?? "");
    $price = $_POST['price'] ?? "";

    $valid = true;

    if ($name === "") {
        $err["name"] = "Name is required.";
        $valid = false;
    } elseif (strlen($name) > 100) {
        $err["name"] = "Name must be at most 100 characters.";
        $valid = false;
    }

    if ($type === "") {
        $err["type"] = "Type is required.";
        $valid = false;
    } elseif (strlen($type) > 100) {
        $err["type"] = "Type must be at most 100 characters.";
        $valid = false;
    }

    if ($company === "") {
        $err["company"] = "Company is required.";
        $valid = false;
    } elseif (strlen($company) > 100) {
        $err["company"] = "Company must be at most 100 characters.";
        $valid = false;
    }

    if ($price === "" || $price === null) {
        $err["price"] = "Price is required.";
        $valid = false;
    } elseif (!is_numeric($price) || (float)$price < 0) {
        $err["price"] = "Price must be a valid number >= 0.";
        $valid = false;
    }

    if ($valid) {
        $stmt = mysqli_prepare($conn, "INSERT INTO products (Name, Type, Company, Price) VALUES (?, ?, ?, ?)");
        $priceVal = (float)$price;
        mysqli_stmt_bind_param($stmt, "sssd", $name, $type, $company, $priceVal);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("Location: product.php");
        exit;
    }
}
?>

<h2>Add Product</h2>

<form method="post" id="addForm">
    <label>Name:</label><br>
    <input type="text" name="name" id="name" maxlength="100" required
           value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>"><br>
    <span style="color:red; font-size:13px;"><?php echo $err["name"]; ?></span><br><br>

    <label>Type:</label><br>
    <input type="text" name="type" id="type" maxlength="100" required
           value="<?php echo htmlspecialchars($_POST['type'] ?? ''); ?>"><br>
    <span style="color:red; font-size:13px;"><?php echo $err["type"]; ?></span><br><br>

    <label>Company:</label><br>
    <input type="text" name="company" id="company" maxlength="100" required
           value="<?php echo htmlspecialchars($_POST['company'] ?? ''); ?>"><br>
    <span style="color:red; font-size:13px;"><?php echo $err["company"]; ?></span><br><br>

    <label>Price:</label><br>
    <input type="number" name="price" id="price" min="0" step="0.01" required
           value="<?php echo htmlspecialchars($_POST['price'] ?? ''); ?>"><br>
    <span style="color:red; font-size:13px;"><?php echo $err["price"]; ?></span><br><br>

    <button type="submit" name="submit">Add Product</button>
</form>

<script>
document.getElementById("addForm").onsubmit = function() {
    var name = document.getElementById("name").value.trim();
    var type = document.getElementById("type").value.trim();
    var company = document.getElementById("company").value.trim();
    var price = document.getElementById("price").value;
    if (name === "" || type === "" || company === "" || price === "") {
        alert("Please fill all fields.");
        return false;
    }
    if (isNaN(parseFloat(price)) || parseFloat(price) < 0) {
        alert("Price must be a valid number >= 0.");
        return false;
    }
    return true;
};
</script>

<?php include "footer.php"; ?>
