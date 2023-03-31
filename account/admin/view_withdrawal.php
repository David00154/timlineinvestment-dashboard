<?php

include "../../core/config.php";
if (!isLogged()) {
    header("location: ../../sign-in.php");
    exit;
}

if(isset($_GET['id'])){
    $depo=$_GET['id'];
    $response=json_decode(getWith($depo, "receiver"), true);
}

if(isset($_POST['deposit'])){
    $amount=getWith($depo, "amount");
    
    $updateDepo=$royaldb->query("UPDATE withdrawal SET status=1 WHERE id=$depo");
    $usr = new Royaltechinc\Mailer;
    $usr->mailUserWithdrawal(getUser(getWith($depo, "user_id"), "email"), getUser(getWith($depo, "user_id"), "full_name"), $amount, getWith($depo, "method"));
    $_SESSION["alert"]='<div class="alert-box alert-primary">
                            <div class="alert-txt"><em class="ti ti-ok"></em>Deposit Successful!</div>
                        </div>';
    header("location: withdraw.php");
    exit;
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

                <div class="user-content">
                    <div class="user-panel">

                        <h2 class="user-panel-title">User Withdrawal</h2>
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

                        <form method=post name="spendform">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="payment-from">
                                        <label for="txtAmount"><strong>Deposit Amount</strong></label>
                                        <div class="payment-input">
                                            <input class="input-bordered" type="text" id="txtAmount" name="amount" value='<?=getWith($depo, "amount")?>' readonly>
                                            <span class="payment-from-cur payment-cal-cur">BTC</span>
                                        </div>
                                    </div>
                                </div><!-- .col -->
                            </div>

                            <div class="gaps-2x"></div>
                            <?php
    if(getWith($depo, "method")=="Bitcoin") {
        ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="payment-from">
                                        <label for="txtAmount"><strong>Paid Wallet</strong></label>
                                        <div class="payment-input">
                                            <input class="input-bordered" type="text" id="txtAmount" value='<?=getWith($depo, "receiver")?>' readonly>
                                            <span class="payment-from-cur payment-cal-cur">BTC WALLET</span>
                                        </div>
                                    </div>
                                </div><!-- .col -->
                            </div>
                            <?php
    }
                                        else if(getWith($depo, "method")=="Paypal") {
        ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="payment-from">
                                        <label for="txtAmount"><strong>Paypal Email</strong></label>
                                        <div class="payment-input">
                                            <input class="input-bordered" type="text" id="txtAmount" value='<?=getWith($depo, "receiver")?>' readonly>
                                            <span class="payment-from-cur payment-cal-cur">PAYPAL</span>
                                        </div>
                                    </div>
                                </div><!-- .col -->
                            </div>
                            <?php
    }
                                        else{
                                        ?>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="payment-from">
                                        <label for="txtAmount"><strong>Bank Name</strong></label>
                                        <div class="payment-input">
                                            <input class="input-bordered" type="text" value='<?=$response["bankname"]?>' readonly>

                                        </div>
                                    </div>
                                </div><!-- .col -->
                                <div class="col-md-4">
                                    <div class="payment-from">
                                        <label for="txtAmount"><strong>Account Name</strong></label>
                                        <div class="payment-input">
                                            <input class="input-bordered" type="text" value='<?=$response["acct_name"]?>' readonly>

                                        </div>
                                    </div>
                                </div><!-- .col -->
                                <div class="col-md-4">
                                    <div class="payment-from">
                                        <label for="txtAmount"><strong>Account No</strong></label>
                                        <div class="payment-input">
                                            <input class="input-bordered" type="text" value='<?=$response["acct_no"]?>' readonly>

                                        </div>
                                    </div>
                                </div><!-- .col -->
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="payment-from">
                                        <label for="txtAmount"><strong>Swift code/Routing number</strong></label>
                                        <div class="payment-input">
                                            <input class="input-bordered" type="text" value='<?=$response["bank_code"]?>' readonly>

                                        </div>
                                    </div>
                                </div><!-- .col -->

                               
                            </div>

                            <?php
    }
                                        ?>
                            <div class="gaps-2x"></div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="payment-from">
                                        <label for="txtAmount"><strong>User Details</strong></label>
                                        <div class="payment-input">
                                            <input class="input-bordered" type="text" id="txtAmount" name="amount" value='<?=getUser(getWith($depo, "user_id"), "full_name")?>' readonly>

                                        </div>
                                    </div>
                                </div><!-- .col -->
                            </div>

                            <div class="gaps-3x"></div>
                            <button name="deposit" type="submit" class="btn btn-primary payment-btn">Approve</button>



                        </form>



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
                    <span class="footer-copyright">Copyright &copy; 2020 <a href="https://stockpulsetrade">CryptoCapital Trader</a>. All Rights Reserved</span>
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
