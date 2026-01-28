<?php
include "db.php";
include "header.php";

$err = array("name" => "", "type" => "", "company" => "", "price" => "");
$row = null;

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
    header("Location: product.php");
    exit;
}

$stmt = mysqli_prepare($conn, "SELECT * FROM products WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($res);
mysqli_stmt_close($stmt);

if (!$row) {
    header("Location: product.php");
    exit;
}

if (isset($_POST['update'])) {
    $name = trim($_POST['name'] ?? "");
    $type = trim($_POST['type'] ?? "");
    $company = trim($_POST['company'] ?? "");
    $price = $_POST['price'] ?? "";
    $pid = (int)($_POST['id'] ?? 0);

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

    if ($valid && $pid === $id) {
        $stmt = mysqli_prepare($conn, "UPDATE products SET Name = ?, Type = ?, Company = ?, Price = ? WHERE id = ?");
        $priceVal = (float)$price;
        mysqli_stmt_bind_param($stmt, "sssdi", $name, $type, $company, $priceVal, $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("Location: product.php");
        exit;
    }

    $row['Name'] = $name;
    $row['Type'] = $type;
    $row['Company'] = $company;
    $row['Price'] = $price;
}
?>

<h2>Edit Product</h2>

<form method="post" action="edit.php?id=<?php echo $id; ?>" id="editForm">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    
    <table border="1" width="100%">
        <tr>
            <td>Name:</td>
            <td>
                <input type="text" name="name" id="name" maxlength="100" required
                       value="<?php echo htmlspecialchars($row['Name']); ?>"><br>
                <span style="color:red; font-size:13px;"><?php echo $err["name"]; ?></span>
            </td>
        </tr>
        <tr>
            <td>Type:</td>
            <td>
                <input type="text" name="type" id="type" maxlength="100" required
                       value="<?php echo htmlspecialchars($row['Type']); ?>"><br>
                <span style="color:red; font-size:13px;"><?php echo $err["type"]; ?></span>
            </td>
        </tr>
        <tr>
            <td>Company:</td>
            <td>
                <input type="text" name="company" id="company" maxlength="100" required
                       value="<?php echo htmlspecialchars($row['Company']); ?>"><br>
                <span style="color:red; font-size:13px;"><?php echo $err["company"]; ?></span>
            </td>
        </tr>
        <tr>
            <td>Price:</td>
            <td>
                <input type="number" name="price" id="price" min="0" step="0.01" required
                       value="<?php echo htmlspecialchars($row['Price']); ?>"><br>
                <span style="color:red; font-size:13px;"><?php echo $err["price"]; ?></span>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="text-align:center;">
                <input type="submit" name="update" value="Update">
                <a href="product.php">Cancel</a>
            </td>
        </tr>
    </table>
</form>

<script>
document.getElementById("editForm").onsubmit = function() {
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
