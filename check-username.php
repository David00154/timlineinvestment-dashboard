<?php
include "core/config.php";


$username=$_POST['username'];

$check=$royaldb->query("SELECT * FROM user WHERE username='$username'") or die($royaldb->error);
if($check->num_rows>0){
    echo "false";
}
else{
    echo "true";
}

