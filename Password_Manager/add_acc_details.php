<?php
session_start();
require '../Setup/Connection.php';
require '../Security/Encryption.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $phone = $_POST['phoneNum'];
    $AccEmail = $_POST['email_address'];
    $password = $_POST['password'];
    $desc = $_POST['desc'];

    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email'];
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            $storedSecret = $user["Secret"];
            $password = encryption($storedSecret, $password);
 
            $sql = "INSERT INTO passwords (email, accountemail, password, phone, description) VALUES ('$email', '$AccEmail', '$password', '$phone', '$desc')";

            if (mysqli_query($conn, $sql)) {
                unset($_SESSION['msg']);
                $_SESSION['msg'] = "inserted_account";
                header("Location: ./account_info_view.php");
                exit();
            } else {
                $_SESSION['msg'] = "insert_error";
                header("Location: ./add_account.php");
                exit();
            }
        }
    }

    mysqli_close($conn);
}
else {
    $_SESSION['msg'] = "insert_error";
    header("Location: ./add_account.php");
    exit();
}
?>
