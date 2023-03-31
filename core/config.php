<?php

@session_start();
    @ob_start();
include "db.php";
require_once  __DIR__.'/phpmailer/PHPMailerAutoload.php';
include "func.php";
include "mailer.php";

?>
