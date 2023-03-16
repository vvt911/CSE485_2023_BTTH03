<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];
    if ($username == '' || $email == '' || $password1 == '' || $password2 == '') {
        echo "<p style='color:red'>Vui lòng nhập đầy đủ thông tin</p>";
    } else {
        if ($password1 != $password2) {
            echo "<p style='color:red'>Mật khẩu không khớp</p>";
        } else {
            try {
                $conn = mysqli_connect('localhost', 'root', '', 'btth03_bai1');
            } catch (Exception $e) {
                echo $e->getMessage();
            }

            $select_sql = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
            $result_sql = mysqli_query($conn, $select_sql);

            if (mysqli_num_rows($result_sql) > 0) {
                echo "<p style='color:red'>Tên đăng nhập hoặc email đã được sử dụng</p>";
            } else {
                $pass_hash = password_hash($password1, PASSWORD_DEFAULT);
                $code_hash = md5(random_bytes(20));
                $insert_sql = "INSERT INTO users (username, email, password, activation_code)
                        VALUES ('$username', '$email', '$pass_hash', '$code_hash')";
                if (mysqli_query($conn, $insert_sql)) {
                    echo "<p style='color:green'>Đăng kí thành công, vui lòng check Email để kích hoạt tài khoản</p>";
                    include("./classes/EmailSender.php");
                    include("./classes/MyEmailServer.php");

                    $path = "http://localhost/btth3/bai1";

                    $emailServer = new MyEmailServer();
                    $emailSender = new EmailSender($emailServer);
                    $to = $email;
                    $subject = "[Kích hoạt tài khoản]";
                    $message = "Kích hoạt tài khoản <a href='$path/activate.php?user=$username&code=$code_hash'>Tại đây.</a>";
                    $active = $emailSender->send($to, $subject, $message);
                    if ($active) {
                        echo "<p style='color:green'>Đã gửi mail kích hoạt, vui lòng vào mail kích hoạt</p>";
                    } else {
                        echo "<p style='color:red'>Gửi mail kích hoạt không thành công</p>";
                    }
                } else {
                    echo "<p style='color:red'>Đăng ký không thành công</p>";
                }
                // echo "<p style='color:green'>Tài khoản hợp lệ</p>";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
</head>

<body>
    <form action="register.php" method="post">
        Username: <input type="text" name="username" id="username">
        Email: <input type="text" name="email" id="email">
        Password: <input type="password" name="password1" id="password1">
        Re-Password: <input type="password" name="password2" id="password2">
        <button type="submit">Sign up</button>
    </form>
</body>

</html>