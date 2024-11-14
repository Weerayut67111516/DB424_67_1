<?php
session_start();
unset($_SESSION['user']);
header('location: <lap7/signin.html');
exit();
?>