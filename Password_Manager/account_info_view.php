<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="../Forms/styles.css">
<!-- Smart tables Links -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#example').DataTable({
            scrollY: "450px",
            scrollX: true,
            paging: true,
            dom: '<"top"f>rt<"bottom"lp><"clear">',
            autoWidth: true
        });
    });
</script>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <nav>
        <div>
            <h2>Password Manager</h2>
        </div>
        <div style="{{ display: 'flex' }}">
            <div>
                <a href="./add_account.php">Add Account</a>
            </div>
            <div>
                <a href="../Manage_User/logout.php">Logout</a>
            </div>
        </div>
    </nav>
    <table id="example" class="display" style="width: 100%">
        <thead>
            <tr>
                <th>S.No</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Password</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            session_start();
            require '../Setup/Connection.php';
            require '../Security/Decryption.php';

            if (isset($_SESSION['email'])) {
                $email = $_SESSION['email'];
            }
            $sql = "SELECT * FROM `users` where email = '$email'";
            $result = mysqli_query($conn, $sql);
            if ($result && mysqli_num_rows($result) > 0) {
                $user = mysqli_fetch_assoc($result);
                $storedSecret = $user["Secret"];
                $sql = "SELECT * FROM `passwords` where email = '$email'";
                $result = mysqli_query($conn, $sql);
                $sno = 0;
                while($row = mysqli_fetch_assoc($result)){
                    $sno = $sno + 1;
                    echo "<tr>
                        <td>". $sno . "</td>
                        <td>". $row['Phone'] . "</td>
                        <td>". $row['AccountEmail'] . "</td>
                        <td>". decryption($row['Password'], $storedSecret) . "</td>
                        <td>". $row['Description'] . "</td>
                    </tr>";
                } 
            }
            ?>
        </tbody>
    </table>
    <script>
        <?php
            if (isset($_SESSION['msg']) && $_SESSION['msg'] == "inserted_account") {
                    echo 'alert("Account Inserted Successfully")';
                    unset($_SESSION['msg']);
            }
        ?>
    </script>
</body>
</html>