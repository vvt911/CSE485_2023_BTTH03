<?php
$db_host = 'localhost';
$db_name = 'mydatabase';
$db_user = 'myuser';
$db_pass = 'mypassword';

try {
    $db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
