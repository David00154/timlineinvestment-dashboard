<?php
session_start();

session_destroy();
setcookie('coinlogin', '', time()-(86400), '/');

header("location: ../sign-in.php");
exit;
?>
