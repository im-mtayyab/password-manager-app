<?php
session_start();
require '../Setup/Connection.php';
require '../Security/RandomSecretKey.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email_address'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    if ($password !== $confirmPassword) {
        $_SESSION['msg'] = "password_mismatch";
        header("Location: ../Forms/register.php");
        exit();
    }
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $_SESSION['msg'] = "user_exists";
        header("Location: ../Forms/login.php");
        exit();
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // user-1 hash cal -> generate hash 123+12 = verify hash 123+12  for user 2 ->123+14=123+14 
    $secret = generateSecretKey(); 

    $sql = "INSERT INTO users (name, email, password, verified, secret) VALUES ('$name', '$email', '$hashedPassword', false, '$secret')";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['email'] = $email;
        header("Location: ../OTP/otp_view.php");
        exit();
    } else {
        $_SESSION['msg'] = "insert_error";
        header("Location: ../Forms/register.php");
        exit();
    }
    mysqli_close($conn);
}
else {
    $_SESSION['msg'] = "insert_error";
    header("Location: ../Forms/register.php");
    exit();
}
?>
