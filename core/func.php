<?php
date_default_timezone_set("Africa/Lagos");
$time = time();
$getDay = date("M-d-Y", $time);
$home = 'http://' . $_SERVER['HTTP_HOST'];
define('root', $_SERVER['DOCUMENT_ROOT']);
define('home', 'http://' . $_SERVER['HTTP_HOST']);
define('thumbs_upload_dir', root . '/verifyimage');
define('card_upload_dir', root . '/uploads');
define('thumbs_max_size', 5242880);
$thumbs_allowed_extensions = ['jpg', 'gif', 'png', 'jpeg', 'pdf'];
function getpageurl()
{

    $url = basename($_SERVER['REQUEST_URI'], '.php');
    return $url;
}
function randomcolor()
{
    $values = array('info', 'warning', 'danger', 'success');
    return $values[array_rand($values)];
}
function generateVCode()
{
    $code = rand(100000, 999999);
    return $code;
}
function urlize($str)
{
    $edit = preg_replace("#([^a-zA-Z0-9\s]+)#is", "", $str);
    $edit2 = preg_replace("#([\s]+)#is", "-", $edit);
    return $edit2;
}
function generateWallet()
{
    global $royaldb;
    $stmt = $royaldb->query("SELECT * FROM wallet ORDER BY RAND() LIMIT 1") or die($royaldb->error);
    if ($stmt->num_rows > 0) {
        $loadw = $stmt->fetch_object();

        return $loadw->wallet;
    }
}
function getDateTime($str)
{
    return date("M j, Y G:i:s", $str);
}
function PassHash($str)
{
    $str = md5($str);
    $str = substr($str, 0, 10);
    $str = sha1($str);
    $str = substr($str, 0, 10);

    return $str;
}
function Deposittype($str)
{
    if ($str == "btc") {

        return "Bitcoin";
    } else if ($str == "pm") {

        return "Perfect Money";
    } else if ($str == "gift") {

        return "Gift Card";
    } else if ($str == "Btcash") {

        return "Bitcoin Cash";
    } else if ($str == "ltc") {

        return "Litecoin";
    } else if ($str == "cash") {

        return "Cash App";
    }
}

function isLogged()
{
    global $royaldb;
    if (isset($_COOKIE["coinlogin"])) {
        $s = base64_decode($_COOKIE["coinlogin"]);
        $splits = explode(":", $s);
        $username = $splits[0];
        $password = $splits[1];
        #check login
        $q = $royaldb->query("SELECT * FROM user WHERE username='$username' AND password='$password'") or die($royaldb->error);
        $_SESSION['logged'] = $username;
    }
    if (isset($_SESSION['logged'])) {
        return true;
    }
}
$UserDetails = "";
if (isLogged()) {
    $user = $_SESSION['logged'];
    $stmt = $royaldb->query("SELECT * FROM user WHERE username='$user'") or die($royaldb->error);
    if ($stmt->num_rows > 0) {
        $UserDetails = $stmt->fetch_object();
    }
}

function getUser($str, $str2)
{
    global $royaldb;

    $stmt = $royaldb->query("SELECT * FROM user WHERE id=$str") or die($royaldb->error);
    if ($stmt->num_rows > 0) {
        $getuser = $stmt->fetch_object();

        return $getuser->$str2;
    }
}

function getPlan($str, $str2)
{
    global $royaldb;

    $stmt = $royaldb->query("SELECT * FROM plans WHERE id=$str") or die($royaldb->error);
    if ($stmt->num_rows > 0) {
        $getuser = $stmt->fetch_object();

        return $getuser->$str2;
    }
}

function getDepo($str, $str2)
{
    global $royaldb;

    $stmt = $royaldb->query("SELECT * FROM deposit WHERE id=$str") or die($royaldb->error);
    if ($stmt->num_rows > 0) {
        $getuser = $stmt->fetch_object();

        return $getuser->$str2;
    }
}
function getWith($str, $str2)
{
    global $royaldb;

    $stmt = $royaldb->query("SELECT * FROM withdrawal WHERE id=$str") or die($royaldb->error);
    if ($stmt->num_rows > 0) {
        $getuser = $stmt->fetch_object();

        return $getuser->$str2;
    }
}
function generateTime($str)
{
    $pdate = new DateTime(); // For today/now, don't pass an arg.
    $pdate->modify($str);

    return strtotime($pdate->format("Y-m-d H:i:s"));
}
function sendMail($subject, $msg, $email)
{
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->SMTPDebug = 0;
    $mail->Debugoutput = 'html';
    $mail->Host = "mail.timelineinvestment.uk";
    $mail->Port = 26;
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = "tls";
    $mail->Username = "support@timelineinvestment.uk";
    $mail->Password = 'O7=y8.pA{s3f';
    $mail->setFrom('support@timelineinvestment.uk', 'Timeline-Investment');
    $mail->setFromName = 'Timeline-Investment';
    $mail->addReplyTo("support@timelineinvestment.uk");
    $mail->addAddress($email);
    $mail->Subject = $subject;
    $mail->msgHTML($msg);
    $mail->isHTML(true);
    // $mail->isSendmail();
    if ($mail->send()) {
        return true;
    }
    // } else {
    //     $_SESSION['alert'] = "<div class=\"callout callout-danger\"> <strong><i class=\"fa fa-info-circle\"></i></strong> &nbsp; $mail->ErrorInfo  </div>";
    //     header("location: verify.php");
    // }
}
function totalUserPendWIthdraw($str)
{
    global $royaldb;

    $stmt = $royaldb->query("SELECT * FROM withdrawal WHERE user_id=$str AND status=0") or die($royaldb->error);
    if ($stmt->num_rows > 0) {
        $to = 0;
        while ($row = $stmt->fetch_assoc()) {
            $to += $row['amount'];
        }
        return $to;
    } else {
        $bal = "0";
        return $bal;
    }
}
function lastWithdraw($str)
{
    global $royaldb;

    $stmt = $royaldb->query("SELECT * FROM withdrawal WHERE user_id=$str AND status=1 ORDER BY id DESC LIMIT 1") or die($royaldb->error);
    if ($stmt->num_rows > 0) {
        $load = $stmt->fetch_object();

        return $load->amount;
    } else {
        return 0;
    }
}
function totalUserWIthdraw($str)
{
    global $royaldb;

    $stmt = $royaldb->query("SELECT * FROM withdrawal WHERE user_id=$str AND status=1") or die($royaldb->error);
    if ($stmt->num_rows > 0) {
        $to = 0;
        while ($row = $stmt->fetch_assoc()) {
            $to += $row['amount'];
        }
        return $to;
    } else {
        $bal = "0";
        return $bal;
    }
}
function totalUserDeposit($str)
{
    global $royaldb;

    $stmt = $royaldb->query("SELECT * FROM deposit WHERE user_id=$str") or die($royaldb->error);
    if ($stmt->num_rows > 0) {
        $to = 0;
        while ($row = $stmt->fetch_assoc()) {
            $to += $row['amount'];
        }
        return $to;
    } else {
        $bal = "0";
        return $bal;
    }
}
function totalUserInvest($str)
{
    global $royaldb;

    $stmt = $royaldb->query("SELECT * FROM deposit WHERE user_id=$str AND status > 0") or die($royaldb->error);
    if ($stmt->num_rows > 0) {
        $to = 0;
        while ($row = $stmt->fetch_assoc()) {
            $to += $row['amount'];
        }
        return $to;
    } else {
        $bal = "0";
        return $bal;
    }
}
function totalUserEarn($str)
{
    global $royaldb;

    $stmt = $royaldb->query("SELECT * FROM deposit WHERE user_id=$str AND status=2") or die($royaldb->error);
    if ($stmt->num_rows > 0) {
        $to = 0;
        while ($row = $stmt->fetch_assoc()) {
            $to += $row['amount'] + $row['t_profit'];
        }
        return $to;
    } else {
        $bal = "0";
        return $bal;
    }
}
function totalAdminBalance()
{
    global $royaldb;

    $stmt = $royaldb->query("SELECT SUM(balance) FROM user") or die($royaldb->error);
    while ($row = $stmt->fetch_assoc()) {
        return $row['SUM(balance)'];
    }
}
function totalAdminDeposit()
{
    global $royaldb;

    $stmt = $royaldb->query("SELECT * FROM user WHERE status=1") or die($royaldb->error);
    if ($stmt->num_rows > 0) {
        $to = 0;
        while ($row = $stmt->fetch_assoc()) {
            $to += $row['deposit'];
        }
        return $to;
    } else {
        $bal = "0";
        return $bal;
    }
}
function getPayout()
{
    global $royaldb;
    $getw = $royaldb->query("SELECT * FROM payout WHERE id > 0 ORDER BY id DESC") or die($royaldb->error);
    $getwi = "";
    if ($getw->num_rows > 0) {

        while ($loadw = $getw->fetch_object()) {
            $getwi .= "<tr><td><div class='pm'><img src='/bitcoin (1).png'></div></td><td class='color-red'>$loadw->amount BTC</td><td>$loadw->time</td><td><div class='linkxa'><a href='https://www.blockchain.com/btc/tx/$loadw->tx' target='_blank'><span class='badge theme-grad badge-xs'><i class='fa fa-link'></i> Verify</span></a></div></td></tr>";
        }
    } else {
        $getwi .= ' <div class="alert-box alert-primary">
                            <div class="alert-txt"><em class="ti ti-alert"></em>No Payout Yet!</div>
                        </div>';
    }
    return $getwi;
}
