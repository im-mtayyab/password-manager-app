<?php
session_start();
require './send_mail.php';

$otpNum = array(0, 0, 0, 0, 0, 0);

if (isset($_SESSION['email'])) {
  $email = $_SESSION['email'];
}

$otp = generateOTP();

$_SESSION['otp'] = $otp;
$_SESSION['otp_timestamp'] = time();
$result = sendOTP($email, $otp);

?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="author" content="CodeHim">
      <title> OTP Verify </title>
      <link rel="stylesheet" href="./css/style.css">
      <link rel="stylesheet" href="./css/demo.css">
      <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css'>
   </head>
   <body>
         <body class="container-fluid bg-body-tertiary d-block">
  <div class="row justify-content-center">
      <div class="col-12 col-md-6 col-lg-4" style="min-width: 500px;">
        <div class="card bg-white mb-5 mt-5 border-0" style="box-shadow: 0 12px 15px rgba(0, 0, 0, 0.02);">
          <div class="card-body p-5 text-center">
            <h2>Verify</h2>
            <?php
                echo '<p>An email with the verification code has been sent to <br>' . $email . '</p>';
            ?>

            <form action="./otp_verify.php" method="POST">
              <div class="otp-field mb-4">
                <input type="text" class="otp-input" name="otpNum[]" />
                <input type="text" class="otp-input" name="otpNum[]" disabled />
                <input type="text" class="otp-input" name="otpNum[]" disabled />
                <input type="text" class="otp-input" name="otpNum[]" disabled />
                <input type="text" class="otp-input" name="otpNum[]" disabled />
                <input type="text" class="otp-input" name="otpNum[]" disabled />
            </div>
            <button type="submit" class="btn btn-secondary btn-lg mb-3">
              Verify
            </button>
          </form>
          <p class="text-muted mb-0 fs-medium">
            Didn't receive code? <a href="otp_view.php" class="text-dark text-decoration-underline">Request again</a>
          </p>
          </div>
        </div>
      </div>
    </div>
    <script>
        <?php
            if (isset($_SESSION['msg']) && $_SESSION['msg'] == "set_2fa") {
                    echo 'alert("2FA not verified! Please verify your 2FA first.")';
                    unset($_SESSION['msg']);
            }
            if (isset($_SESSION['msg']) && $_SESSION['msg'] == "invalid_otp") {
              echo 'alert("Invalid OTP. OTP resent to you successfully.")';
              unset($_SESSION['msg']);
            }
            if (isset($_SESSION['msg']) && $_SESSION['msg'] == "otp_expired") {
              echo 'alert("OTP Expired. OTP resent to you successfully.")';
              unset($_SESSION['msg']);
            }
        ?>
    </script>
</body>
      <script src="./js/script.js"></script>
    </script>
   </body>
</html>