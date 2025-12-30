<?php
$username = $_POST['ps_username'];
$email = $_POST['ps_email'];
$password = $_POST['ps_password'];

$conn = mysqli_connect('localhost', 'root', '', 'wpl');

$query = "INSERT INTO playstation_users(username, email, password) 
          VALUES('$username', '$email', '$password')";

mysqli_query($conn, $query);

echo "Signup Successful!";
?>
