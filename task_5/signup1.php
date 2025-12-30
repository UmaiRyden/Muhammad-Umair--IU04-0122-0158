<?php
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

$conn = mysqli_connect('localhost', 'root', '', 'wpl');

$query = "INSERT INTO instagram_users(username,email,password) VALUES('$username','$email','$password')";

mysqli_query($conn, $query);

echo "Signup Successful!";
?>
