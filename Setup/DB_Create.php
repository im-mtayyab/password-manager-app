<?php
$servername = "localhost";
$username = "root";
$password = "";
// Create a connection
$conn = mysqli_connect($servername, $username, $password);
// Die if connection was not successful
if (!$conn) {
    die("Sorry we failed to connect: " . mysqli_connect_error());
} else {
    $sql = "CREATE DATABASE `password_manager_db`";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "DataBase Created Successfully";
    } else {
        die("Sorry we failed to Create DataBase: " . mysqli_connect_error());
    }
}
?>