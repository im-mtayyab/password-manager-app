<?php
session_start(); 
require '../Setup/Connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email_address'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $storedHashedPassword = $user["Password"]; 

        if (password_verify($password, $storedHashedPassword)) {
            $_SESSION['email'] = $user['Email']; 
            if($user["Verified"] == false) {
                $_SESSION['msg'] = "set_2fa";
            }
            header("Location: ../OTP/otp_view.php");
            exit();
        } else {
            $_SESSION['msg'] = "invalid_credentials";
            header("Location: ../Forms/login.php");
            exit();
        }
    } else {
        $_SESSION['msg'] = "invalid_credentials";
        header("Location: ../Forms/login.php");
        exit();
    }
} else {
    $_SESSION['msg'] = "invalid_credentials";
    header("Location: ../Forms/login.php");
    exit();
}

mysqli_close($conn);
?>
