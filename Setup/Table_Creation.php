<?php
function TableChecker($result) {
    global $count;
    if ($result) {
        $count++;
        echo "Table Created Successfully" . $count . "<br>";
    } else {
        echo "Sorry we failed to Create Table: " . mysqli_connect_error();
    }
}
$servername = "localhost";
$username = "root";
$password = "";
$database = "password_manager_db";
// Create a connection
$conn = mysqli_connect($servername, $username, $password, $database);
// Die if connection was not successful
if (!$conn) {
    die("Sorry we failed to connect: " . mysqli_connect_error());
} else {
    
    // Create Table Commands
    
    $sql = "CREATE TABLE `Users` (
        `Email` VARCHAR(256) PRIMARY KEY,
        `Name` VARCHAR(50) NOT NULL,
        `Secret` VARCHAR(256) NOT NULL,
        `Password` VARCHAR(256) NOT NULL,
        `Verified` BOOLEAN NOT NULL
    )";    
    $result = mysqli_query($conn, $sql);
    TableChecker($result);
    
    $sql = "CREATE TABLE `Passwords` (
        `ID` INT AUTO_INCREMENT PRIMARY KEY,
        `Email` VARCHAR(256),
        `AccountEmail` VARCHAR(256),
        `Password` VARCHAR(256) NOT NULL,
        `Phone` VARCHAR(256),
        `Description` VARCHAR(256),
        FOREIGN KEY (`Email`) REFERENCES `Users`(`Email`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
    );";
    $result = mysqli_query($conn, $sql);
    TableChecker($result);
    
    echo "All Tables Created Successfully";
}
?>
