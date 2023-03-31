<?php

include "../../core/config.php";
if (!isLogged()) {
    header("location: ../../sign-in.php");
    exit;
}
$mErr="";
if(isset($_POST['add'])){
    $amount=$_POST['amount'];
    $timew=$_POST['timew'];
    $tx=$_POST['tx'];
    $add=$royaldb->query("INSERT INTO payout SET amount='$amount', time='$timew', tx='$tx'") or die($royaldb->error);
    $mErr='<div class="alert-box alert-primary">
                            <div class="alert-txt"><em class="ti ti-ok"></em>Payout Added Successfully!</div>
                        </div>';
}
if(isset($_GET['del'])){
    $id=$_GET['del'];
    $del=$royaldb->query("DELETE FROM payout WHERE id=$id") or die($royaldb->error);
    $mErr='<div class="alert-box alert-danger">
                            <div class="alert-txt"><em class="ti ti-alert"></em>Payout Deleted Successfully!</div>
                        </div>';
}

$getw=$royaldb->query("SELECT * FROM payout WHERE id > 0 ORDER BY id DESC") or die($royaldb->error);
$getwi="";
if($getw->num_rows>0){
    $sn=1;
    while($loadw=$getw->fetch_object()){
    $getwi.="<tr><td>$sn</td><td>$loadw->amount</td><td>$loadw->time</td><td><a href='https://www.blockchain.com/btc/tx/$loadw->tx' class='btn btn-xs btn-primary' target='_blank'>Verify</a> </td><td><a class='btn btn-xs btn-primary' href='?del=$loadw->id'>Delete</a></td></tr>";
        $sn++;
    }
}
else{
    $getwi.=' <div class="alert-box alert-primary">
                            <div class="alert-txt"><em class="ti ti-alert"></em>No Payout Yet!</div>
                        </div>';
}


?>


<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    

<!--End of Tawk.to Script-->
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <link rel="shortcut icon" href="images/favicon.png">
    <title>TimeLine-Investment Trade</title>
    <link rel="stylesheet" href="assets/css/ac.vendor.bundle.css">
    <link rel="stylesheet" href="assets/css/ac.style.css">
   
    <!-- End of  Zendesk Widget script -->
</head>

<body class="user-dashboard">
    <?php
    
    include "header.php";
    ?>
    <!-- TopBar End -->


    <div class="user-wraper">
        <div class="container">
            <div class="d-flex">
                <?php
                include "sidebar.php";
                ?>

                <div class="user-content">
                    <div class="user-panel">

                        <h2 class="user-panel-title">Wallet</h2>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="tile-item title-item3 tile-primary">
                                    <div class="tile-bubbles"></div>
                                    <h6 class="tile-title">Total Invested</h6>
                                    <h1 class="tile-info"><?=totalAdminDeposit()?> BTC</h1>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="tile-item title-item3 tile-light">
                                    <div class="tile-bubbles"></div>
                                    <h6 class="tile-title">Total Profit</h6>
                                    <h1 class="tile-info" style="color:#4d54f6;"><?=$UserDetails->earnings?> BTC</h1>
                                </div>
                            </div>
                        </div>
                        <hr class="linie">



                        <div class="gaps-1x"></div>
                        <?=$mErr?>
                        <div class="gaps-1x"></div>

                        <form method=post onsubmit="return checkform()" name=editform>


                            <div class="row">
                                <div class="col-md-12">
                                    <div class="payment-from">
                                        <label for="txtAmount"><strong>Amount:</strong></label>
                                        <div class="payment-input">
                                            <input class="input-bordered" type="text" name="amount" placeholder="1.0008" required>
                                            <span class="payment-from-cur payment-cal-cur">BTC</span>
                                        </div>
                                    </div>
                                </div><!-- .col -->
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="payment-from">
                                        <label for="txtAmount"><strong>Time:</strong></label>
                                        <div class="payment-input">
                                            <input class="input-bordered" type="text" name="timew" placeholder="2020-02-13" required>
                                            <span class="payment-from-cur payment-cal-cur">TIME</span>
                                        </div>
                                    </div>
                                </div><!-- .col -->
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="payment-from">
                                        <label for="txtAmount"><strong>Tx:</strong></label>
                                        <div class="payment-input">
                                            <input class="input-bordered" type="text" name="tx" placeholder="a30bfc8b25e43effdcf224a202ad3f4accec6f0da4249c79f00d55d2ed577207" required>
                                            <span class="payment-from-cur payment-cal-cur">TX</span>
                                        </div>
                                    </div>
                                </div><!-- .col -->
                            </div>



                            <div class="gaps-3x"></div>
                            <button name="add" type="submit" class="btn btn-primary payment-btn">Add</button>



                        </form>
                        <div class="gaps-3x"></div>
                        <div class="srcbox">
                            <div class="row">
                                <div class="col-md-12">

                                    <table cellpadding="0" class="searchselect">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Amount</th>
                                                <th>Time</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>

                                        </thead>
                                        <tbody>
                                            <?=$getwi?>
                                        </tbody>

                                    </table>
                                </div>


                            </div>
                        </div>

                        <div class="gaps-2x"></div>


                    </div>
                </div><!-- .user-content -->
            </div><!-- .d-flex -->
        </div><!-- .container -->
    </div>
    <!-- UserWraper End -->

<div class="footer-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <span class="footer-copyright">Copyright &copy; 2020. All Rights Reserved</span>
                </div><!-- .col -->
                <div class="col-md-5 text-md-right">
                    <ul class="footer-links">
                        <li><a href="">Terms & Conditions</a></li>
                        <li><a href="">Privacy Policy</a></li>
                    </ul>
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .container -->
    </div>
    <!-- FooterBar End -->
    <script src="assets/js/ac.jquery.bundle.js"></script>
    <script src="assets/js/ac.script.js"></script>
</body>

</html>
