<?php
include "core/config.php";


$email=$_POST['email'];

$check=$royaldb->query("SELECT * FROM user WHERE email='$email'") or die($royaldb->error);
if($check->num_rows>0){
    echo "false";
}
else{
    echo "true";
}

