<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-Up-Form</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <nav>
        <div>
            <h2>Password Manager</h2>
        </div>
        <div>
            <a href="./login.php">Login</a>
        </div>
    </nav>

    <div class="container flex-center">
        <div class="registration-form flex-center">
            <form action="../Manage_User/Register_User.php" method="POST">
                <h3>Register Here</h3>
                
                <div>
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div>
                    <label for="emailAddress">Email Address</label>
                    <input type="email" id="emailAddress" name="email_address" required>
                </div>
                <div>
                    <label for="createPassword">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div>
                    <label for="confirmPassword">Confirm Password</label>
                    <input type="password" id="confirmPassword" name="confirm_password" required>
                </div>
                <button type="submit" class="btn btn-dark">Create Account</button>
            </form>
        </div>
    </div>
    <script>
        <?php
            session_start();
            if (isset($_SESSION['msg']) && $_SESSION['msg'] == "password_mismatch") {
                    echo 'alert("Password not Matched")';
                    unset($_SESSION['msg']);
            }
            else if (isset($_SESSION['msg']) && $_SESSION['msg'] == "insert_error") {
                echo 'alert("Something went wrong! Re-enter Info")';
                unset($_SESSION['msg']);
                session_destroy();
            }
        ?>
    </script>
</body>
</html>
