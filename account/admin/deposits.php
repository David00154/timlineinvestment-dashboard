<?php

include "../../core/config.php";
if (!isLogged()) {
    header("location: ../../sign-in.php");
    exit;
}


$getdeposit=$royaldb->query("SELECT * FROM user WHERE deposit > 0 ORDER BY id DESC") or die($royaldb->error);
$getdepo="";
if($getdeposit->num_rows>0){
    $sn=1;
    while($loaddepo=$getdeposit->fetch_object()){
        if($loaddepo->status==0){
            $status="Paused";
            $linkstatus="<a href='deposits.php?edit=$loaddepo->id&action=1' class='btn btn-xs btn-primary'>Activate</a>";
        }
        else if($loaddepo->status==1){
            $status="Active";
            $linkstatus="<a href='deposits.php?edit=$loaddepo->id&action=0' class='btn btn-xs btn-danger'>Pause</a>";
        }
        else{
            $status="Declined";
        }
        $user=$loaddepo->full_name;
        $totalp=$loaddepo->deposit + $loaddepo->earnings + ($loaddepo->interest * $loaddepo->profit_times);
        
    $getdepo.="<tr><td>$sn</td><td>$user</td><td>$loaddepo->deposit USD</td><td>$totalp</td><td>$status</td><td>$linkstatus</td></tr>";
        $sn++;
    }
}
else{
    $getdepo.=' <div class="alert-box alert-primary">
                            <div class="alert-txt"><em class="ti ti-alert"></em>No deposits from your users!</div>
                        </div>';
}
if(isset($_GET['edit'])){
    $id = (int) $_GET['edit'];
    $action = (int) $_GET['action'];
    
    $updatestatus=$royaldb->query("UPDATE user SET status=$action WHERE id=$id") or die($royaldb->error);
    $_SESSION["alert"]='<div class="alert-box alert-primary">
                            <div class="alert-txt"><em class="ti ti-ok"></em>User Status has been changed!</div>
                        </div>';
    header("location: deposits.php");
    exit;
    
}

?>


<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <link rel="shortcut icon" href="../../images/favicon.png">
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

                        <h2 class="user-panel-title">Users Deposits</h2>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="tile-item title-item3 tile-primary">
                                    <div class="tile-bubbles"></div>
                                    <h6 class="tile-title">Total Invested</h6>
                                    <h1 class="tile-info"><?=totalAdminDeposit()?> USD</h1>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="tile-item title-item3 tile-light">
                                    <div class="tile-bubbles"></div>
                                    <h6 class="tile-title">Total Profit</h6>
                                    <h1 class="tile-info" style="color:#4d54f6;"><?=$UserDetails->earnings?> USD</h1>
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
