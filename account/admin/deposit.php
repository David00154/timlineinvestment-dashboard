<?php

include "../../core/config.php";
if (!isLogged()) {
    header("location: ../../sign-in.php");
    exit;
}


$getdeposit=$royaldb->query("SELECT * FROM deposit WHERE id > 0 ORDER BY id DESC") or die($royaldb->error);
$getdepo="";
if($getdeposit->num_rows>0){
    $sn=1;
    while($loaddepo=$getdeposit->fetch_object()){
        if($loaddepo->status==0){
            $status="Pending";
        }
        else if($loaddepo->status==1){
            $status="Approved";
        }
        else{
            $status="Declined";
        }
        $user=getUser($loaddepo->user_id, "full_name");
        $plantype="5Days";
    $getdepo.="<tr><td>$sn</td><td>$user</td><td>$loaddepo->amount USD</td><td>$plantype</td><td>$loaddepo->t_profit</td><td>$status</td><td><a href='view-deposit.php?id=$loaddepo->id' class='btn btn-xs btn-primary'>View</a></td></tr>";
        $sn++;
    }
}
else{
    $getdepo.=' <div class="alert-box alert-primary">
                            <div class="alert-txt"><em class="ti ti-alert"></em>No deposits from your users!</div>
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
    <script id="ze-snippet" src="https://static.zdassets.com/ekr/snippet.js?key=f95b77b4-a453-49d0-889f-50591aba3dab"></script>
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

                        <h2 class="user-panel-title">Users Deposits</h2>
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
                        <?php 
						    if(isset($_SESSION["alert"])){
						    	echo $_SESSION["alert"];
			                    unset($_SESSION["alert"]);
			            	} 
			            ?>

                        <div class="srcbox">
                            <div class="row">
                                <div class="col-md-12">

                                    <table cellpadding="0" class="searchselect">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>User</th>
                                                <th>Amount</th>
                                                <th>Plan Type</th>
                                                <th>Profit</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>

                                        </thead>
                                        <tbody>
                                            <?=$getdepo?>
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
                    <span class="footer-copyright">Copyright &copy; 2020 <a href="https://coincompany.biz">CoinWallet.biz</a>. All Rights Reserved</span>
                </div><!-- .col -->
                <div class="col-md-5 text-md-right">
                    <ul class="footer-links">
                        <li><a href="../terms">Terms & Conditions</a></li>
                        <li><a href="../privacy">Privacy Policy</a></li>
                    </ul>
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .container -->
    </div>
    <!-- FooterBar End -->
    <script src="assets/js/ac.jquery.bundle.js"></script>
    <script src="assets/js/ac.script.js"></script>


    <script>
        (function() {
            $(".responsive-nav").click(function() {
                return $(".responsive-nav").addClass("cross");
            });
            $(".st-pusher").click(function() {
                $('.responsive-nav').removeClass('cross');
            });
            $.get("https://api.coinmarketcap.com/v1/ticker/?limit=100", function(data) {
                for (var i = 0; i < data.length; i++) {
                    if (data[i].id == "bitcoin") {
                        $(".BTCLive").text(parseFloat(data[i].price_usd).toFixed(2) + " USD");
                    } else if (data[i].id == "ethereum") {
                        $(".ETHLive").text(parseFloat(data[i].price_usd).toFixed(2) + " USD");
                    } else if (data[i].id == "litecoin") {
                        $(".LTCLive").text(parseFloat(data[i].price_usd).toFixed(2) + " USD");
                    } else if (data[i].id == "bitcoin-cash") {
                        $(".BCHLive").text(parseFloat(data[i].price_usd).toFixed(2) + " USD");
                    } else if (data[i].id == "dash") {
                        $(".DASHLive").text(parseFloat(data[i].price_usd).toFixed(2) + " USD");
                    } else if (data[i].id == "dogecoin") {
                        $(".DOGELive").text(parseFloat(data[i].price_usd).toFixed(6) + " USD");
                    }
                }
            });
        }).call(this);

    </script>
</body>

</html>
