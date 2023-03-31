<?php
$dbhost = "aws.connect.psdb.cloud";
$dbuser = "runojp99hqkbk371zvrk";
$dbpass = "pscale_pw_mKt8Z8TIhwUqm64LN1omgMqxE30Wjdrcj1FO6c85SDT";
$dbname = "timlineinvestment-db";

$royaldb=mysqli_init();
if (!$royaldb)
  {
  die("mysqli_init failed");
  }

mysqli_ssl_set($royaldb, NULL, NULL,"/etc/ssl/cert.pem",NULL,NULL); 

if (!mysqli_real_connect($royaldb,$dbhost, $dbuser, $dbpass, $dbname))
  {
  die("Connect Error: " . mysqli_connect_error());
  }
