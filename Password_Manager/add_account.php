<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Forms/styles.css">
    <title>Document</title>
</head>

<body>
    <nav>
        <div>
            <h2>Password Manager</h2>
        </div>
        <div class="btn-container">
            <div>
                <a href="./account_info_view.php">Show Passwords</a>
            </div>
            <div>
                <a href="../Manage_User/logout.php">Logout</a>
            </div>
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

            <h3>Save Account Details</h3>

            <form action="./add_acc_details.php" method="POST">
                <div>
                    <label for="phoneNum">Phone Number</label>
                    <input type="text" id="phoneNum" name="phoneNum">
                </div>
                <div>
                    <label for="emailAddress">Email Address</label>
                    <input type="email" id="emailAddress" name="email_address">
                </div>
                <div>
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div>
                    <label for="desc">Description</label>
                    <input type="text" id="desc" name="desc" required>
                </div>
                <button type="submit" class="btn">Submit</button>
            </form>

        </div>
    </div>
    <script>
        <?php
            session_start();
            if (isset($_SESSION['msg']) && $_SESSION['msg'] == "insert_error") {
                echo 'alert("Something went wrong! Re-enter Info")';
                unset($_SESSION['msg']);
                session_destroy();
            }
        ?>
    </script>
</body>
</html>