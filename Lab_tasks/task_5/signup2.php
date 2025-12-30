<?php

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$password = $_POST['password'];

$conn = mysqli_connect('localhost', 'root', '', 'wpl');

$query = "INSERT INTO facebook_users(fname, lname, email, password) 
          VALUES('$fname', '$lname', '$email', '$password')";

mysqli_query($conn, $query);

echo "Signup Successful!";

?>
