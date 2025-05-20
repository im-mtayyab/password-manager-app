<?php
session_start();
require '../Setup/Connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $otpNum = $_POST['otpNum']; // Entered OTP by User

    $otpExpirationTime = 120; // 30 seconds

    if (isset($_SESSION['otp_timestamp']) && isset($_SESSION['otp']) && $_SESSION['otp_timestamp'] + $otpExpirationTime < time()) {
        // OTP has expired
        unset($_SESSION['otp']);
        unset($_SESSION['otp_timestamp']);
        $_SESSION['msg'] = "otp_expired";
        header("Location:./otp_view.php");
        exit();
    } elseif (!isset($_SESSION['otp']) || empty($_SESSION['otp'])) {
        // OTP is not set or empty
        $_SESSION['msg'] = "invalid_otp";
        header("Location:./otp_view.php");
        exit();
    } else {
        $otp = $_SESSION['otp'];

        $otpString = (string)$otp;
        $otpArray = str_split($otpString);

        for ($i = 0; $i < 6; $i++) 
        {
            if ($otpArray[$i]!= $otpNum[$i]) {
                $_SESSION['msg'] = "invalid_otp";
                header("Location:./otp_view.php");
                exit();
            }
        }

        if (isset($_SESSION['email'])) {
            $email = $_SESSION['email'];

            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);

            if ($result && mysqli_num_rows($result) > 0) {
                $user = mysqli_fetch_assoc($result);
                if($user["Verified"] == '1' ) {
                    header("Location:../Password_Manager/account_info_view.php");
                    exit();
                }
            }

            $sql = "UPDATE `users` SET `Verified` = '1' WHERE `Email` = '$email'";
            if(mysqli_query($conn, $sql)) {
                $_SESSION['msg'] = "2fa_set";
                header("Location:../Forms/login.php");
                exit();
            }
        }
        $_SESSION['msg'] = "invalid_otp";
        header("Location:./otp_view.php");
        
    }
    mysqli_close($conn);
}
?>