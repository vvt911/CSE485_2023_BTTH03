<?php
if (isset($_GET['user']) && isset($_GET['code'])) {
    $user = $_GET['user'];
    $code = $_GET['code'];

    try {
        $conn = mysqli_connect('localhost', 'root', '', 'btth03_bai1');
    } catch (Exception $e) {
        echo $e->getMessage();
    }

    $select_sql = "SELECT * FROM users WHERE username = '$user' AND  activation_code='$code'";
    $result_sql = mysqli_query($conn, $select_sql);
    if (mysqli_num_rows($result_sql) > 0) {
        $update_sql = "UPDATE users SET is_activated=1 WHERE username='$user'";
        if (mysqli_query($conn, $update_sql)) {
            echo "<p style='color:green'>Tài khoản được kích hoạt thành công<br>Đăng nhập lại để sử dụng</p>";
            echo "<a href='./login.php'>Đăng nhập tại đây</a>";
        } else {
            echo "<p style='color:red'>Liên kết không hợp lệ</p>";
        }
    } else {
        echo "<p style='color:red'>Liên kết không hợp lệ</p>";
    }
}
