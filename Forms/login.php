<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login-Form</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav>
        <div>
            <h2>Password Manager</h2>
        </div>
        <div>
            <a href="./register.php">Register</a>
        </div>
    </nav>

    <div class="container flex-between">
        <div class="data-lines margin-left">
            <ul type="" >
                <li>Save all of your Passwords in one place</li>
                <li>Keeps your Passwords Safe</li>
                <li>Cannot be decrypted without your Passkey</li>
            </ul>
        </div>

        <div class="registration-form flex-end margin-right">

            <h3>Please Login to continue</h3>

            <form action="../Manage_User/Authenticate_User.php" method="POST">
                <div>
                    <label for="emailAddress">Email Address</label>
                    <input type="email" id="emailAddress" name="email_address" required>
                </div>
                <div>
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" class="btn">Submit</button>
            </form>

        </div>
    </div>
    <script>
        <?php
            session_start();
            if (isset($_SESSION['msg']) && $_SESSION['msg'] == "invalid_credentials") {
                    echo 'alert("Invalid Credentials")';
                    unset($_SESSION['msg']);
            }
            else if (isset($_SESSION['msg']) && $_SESSION['msg'] == "user_exists") {
                echo 'alert("This email already exists! Login Instead")';
                unset($_SESSION['msg']);
            } 
            else if (isset($_SESSION['msg']) && $_SESSION['msg'] == "2fa_set") {
                echo 'alert("Email is set as 2FA! Login now")';
                unset($_SESSION['msg']);
                session_destroy();
            }
        ?>
    </script>
</body>
</html>
