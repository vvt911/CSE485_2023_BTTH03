<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        $conn = mysqli_connect('localhost', 'root', '', 'btth03_bai1');
    } catch (EXception $e) {
        echo $e->getMessage();
    }

    $select_sql = "SELECT * FROM users WHERE username = '$username' OR email = '$username'";
    $result_sql = mysqli_query($conn, $select_sql);

    if (mysqli_num_rows($result_sql) > 0) {
        $row = mysqli_fetch_assoc($result_sql);
        $password_saved = $row['password'];
        if (password_verify($password, $password_saved)) {
            if ($row['is_activated'] == 1) {
                session_start();
                $_SESSION['user'] = $username;
                $_SESSION['role'] = $row['role'];
                if ($_SESSION['role'] == 'admin') {
                    header("Location: admin.php");
                } else {
                    header("Location: member.php");
                }
            } else {
                echo "<p style='color:red'>Tài khoản chưa được kích hoạt vui lòng kích hoạt trong email của bạn</p>";
            }
        } else {
            echo "<p style='color:red'>Kiểm tra lại mật khẩu</p>";
        }
    } else {
        echo "<p style='color:red'>Tài khoản không tồn tại. Vui lòng kiểm tra lại</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form action="login.php" method="post">
        Username: <input type="text" name="username" id="username">
        Password: <input type="password" name="password" id="password">
        <button type="submit">Login</button>
    </form>
</body>
</html>