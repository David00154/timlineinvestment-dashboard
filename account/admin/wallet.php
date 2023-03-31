<?php

include "../../core/config.php";
if (!isLogged()) {
    header("location: ../../sign-in.php");
    exit;
}
$mErr="";
if(isset($_POST['add'])){
    $wallet=$_POST['wallet'];
    $add=$royaldb->query("INSERT INTO wallet SET wallet='$wallet'") or die($royaldb->error);
    $mErr='<div class="alert-box alert-primary">
                            <div class="alert-txt"><em class="ti ti-ok"></em>Wallet Added Successfully!</div>
                        </div>';
}
if(isset($_GET['del'])){
    $id=$_GET['del'];
    $del=$royaldb->query("DELETE FROM wallet WHERE id=$id") or die($royaldb->error);
    $mErr='<div class="alert-box alert-danger">
                            <div class="alert-txt"><em class="ti ti-alert"></em>Wallet Deleted Successfully!</div>
                        </div>';
}

$getw=$royaldb->query("SELECT * FROM wallet WHERE id > 0 ORDER BY id DESC") or die($royaldb->error);
$getwi="";
if($getw->num_rows>0){
    $sn=1;
    while($loadw=$getw->fetch_object()){
    $getwi.="<tr><td>$sn</td><td>$loadw->wallet</td><td><a class='btn btn-xs btn-primary' href='?del=$loadw->id'>Delete</a></td></tr>";
        $sn++;
    }
}
else{
    $getwi.=' <div class="alert-box alert-primary">
                            <div class="alert-txt"><em class="ti ti-alert"></em>No Wallet Yet!</div>
                        </div>';
}


?>


<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <link rel="shortcut icon" href="images/favicon.png">
    <title>TimeLine-Investment Trade</title>
    <link rel="stylesheet" href="assets/css/ac.vendor.bundle.css">
    <link rel="stylesheet" href="assets/css/ac.style.css">
    <!-- Start of  Zendesk Widget script -->
    
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
                <script>
                    function checkform() {
                        if (document.editform.wallet.value == '') {
                            alert("Input your wallet!");
                            document.editform.wallet.focus();
                            return false;
                        }
                    }

                </script>
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
                                        <label for="txtAmount"><strong>Add Wallet</strong></label>
                                        <div class="payment-input">
                                            <input class="input-bordered" type="text" name="wallet">
                                            <span class="payment-from-cur payment-cal-cur">BTC WALLET</span>
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
                                                <th>BTC WALLET</th>
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
