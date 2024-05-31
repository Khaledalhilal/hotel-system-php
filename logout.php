<?php
session_start();
// var_dump($_SESSION);exit;
unset($_SESSION['user_id']);
unset($_SESSION['email']);
unset($_SESSION['login']);
session_destroy();
echo "<script>window.location.href = 'signin.php';</script>";
exit;
