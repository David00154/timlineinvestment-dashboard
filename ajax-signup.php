<?php
include "core/config.php";
//$response = array();
if(isset($_POST['fullname'])){
$fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $phonenumber = $_POST['phone'];
    $country = $_POST['country'];
    $gender=$_POST['gender'];
    //$error = [];
    $vcode = generateVCode();

    
        $pass= PassHash($password);
        $usr = new Royaltechinc\Mailer;
        $usr->mailUserReg($email, $fullname, $username, $vcode);
        $usr->mailAdminReg("support@timelineinvestment.uk", $email, $fullname, $username, $password, $phonenumber, $vcode);
        $save=$royaldb->query("INSERT INTO user SET full_name='$fullname', username='$username', password='$pass', email='$email', phone_number='$phonenumber', gender='$gender', country='$country', join_date='$getDay', vcode='$vcode'") or die($royaldb->error);
if($save){
    $response['status']="success";
}
else{
    $response['status']="error";
    $response['message']="Sorry registration was not completed";
}
}
else{
$response['status']="error";
    $response['message']="Invalid Parameters";
        
}
echo json_encode($response);

      
/*

$data = json_decode(file_get_contents("php://input"), true);

$response['status']="success";



echo json_encode($response);

//echo  $data["fullname"]
*/
