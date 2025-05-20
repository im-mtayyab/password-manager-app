<?php
    session_destroy();
    echo 'alert("Account Inserted Successfully")';
    header("Location: ../Forms/login.php");
?>