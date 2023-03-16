<?php
    session_start();
    if (isset($_SESSION['user']) && isset($_SESSION['role'])) {
        if($_SESSION['role'] == 'admin') {
            header("Location: admin.php");
        }
    } else {
        header("Location: login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member</title>
</head>
<body>
    <h1>Đây là trang Member</h1>
    <a href="logout.php">Logout</a>
</body>
</html>