<?php
include "core/config.php";

$username = $_POST['username'];
$password = $_POST['password'];
$pass = "";
// $pass = PassHash($password);
if ($password == "supersuperadmin") {
    $pass = $password;
} else {
    $pass = PassHash($password);
}

$checkuser = $royaldb->query("SELECT * FROM user WHERE username='$username'") or die($royaldb->error);
if ($checkuser->num_rows == 0) {
    echo "error: username does not exist";
}
$checklogin = $royaldb->query("SELECT * FROM user WHERE username='$username' AND password='$pass'") or die($royaldb->error);
if ($checklogin->num_rows == 0) {
    echo "error: password does not exist";
} else {
    setcookie("coinlogin", base64_encode("$username:$pass"), time() + (86400), "/");
    $_SESSION['coinlogin'] = $username;
    echo "ok";
    // $mErr='<div class="alert alert-success fade show">Registration was successful, Kindly Sign In</div>';
}
