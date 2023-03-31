<?php

include "../../core/config.php";
if (!isLogged()) {
    header("location: ../../sign-in.php");
    exit;
}



?>
<!DOCTYPE html>
<html lang="zxx" class="js">

<head>

    <!--Start of Tawk.to Script-->

    <!--End of Tawk.to Script-->

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


    <div class="user-wraper">
        <div class="container">
            <div class="d-flex">
                <?php
                include "sidebar.php";

                ?>

                <div class="user-content">
                    <div class="user-panel">



                        <div class="row">
                            <div class="col-md-6">
                                <div class="tile-item tile-primary">
                                    <div class="tile-bubbles"></div>
                                    <h6 class="tile-title">Total Balance</h6>
                                    <h1 class="tile-info"><?= totalAdminBalance() ?> USD</h1>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="tile-item tile-light">
                                    <div class="tile-bubbles"></div>
                                    <h6 class="tile-title">Total Active Deposit</h6>
                                    <ul class="tile-info-list">
                                        <li><span><?= totalAdminDeposit() ?> USD</span>

                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="gaps-x"></div>
                        <h6>Your unique referral link</h6>
                        <div class="refferal-info">
                            <span class="refferal-copy-feedback copy-feedback"></span>
                            <em class="fas fa-link"></em>
                            <input type="text" class="refferal-address" value="https://Perfectfxoptiontrade.com/?ref=<?= $UserDetails->username ?>" disabled="">
                            <button class="refferal-copy copy-clipboard" data-clipboard-text="https://Perfectfxoptiontrade.com/ref=<?= $UserDetails->username ?>"><em class="ti ti-files"></em></button>
                        </div> -->




                        <div class="gaps-x"></div>
                        <h6>Account status</h6>
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td><span>Registration Date</span><?= $UserDetails->join_date ?></td>

                                    </tr>
                                    <tr>
                                        <td><span>Total Withdrawal</span>0.00000000 BTC</td>
                                        <td><span>Pending Withdrawal</span>0.00000000 BTC</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>




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