<?php
require './interface/EmailServerInterface.php';
require './class/EmailSender.php';

$emailServer = new MyEmailServer();
$emailSender = new EmailSender($emailServer);
$emailSender->send("hiengiang1301@gmail.com", "Test Email", "This is a test email.");
