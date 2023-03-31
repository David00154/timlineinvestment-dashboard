<?php

include "../../core/config.php";
if (!isLogged()) {
    header("location: ../../sign-in.php");
    exit;
}
$mErr="";
if(isset($_POST['add'])){
    $planname=$_POST['plan_name'];
    $maxamount=$_POST['max_amount'];
    $minamount=$_POST['min_amount'];
    $planreturn=$_POST['daily_return'];
    $planrange=$_POST['planrange'];
    $type=$_POST['type'];
    $add=$royaldb->query("INSERT INTO plans SET plan_name='$planname', min='$minamount', max='$maxamount', return_percent='$planreturn', planrange='$planrange', type='$type'") or die($royaldb->error);
    $mErr='<div class="alert-box alert-primary">
                            <div class="alert-txt"><em class="ti ti-ok"></em>Plan Added Successfully!</div>
                        </div>';
}
if(isset($_GET['del'])){
    $id=$_GET['del'];
    $del=$royaldb->query("DELETE FROM plans WHERE id=$id") or die($royaldb->error);
    $mErr='<div class="alert-box alert-danger">
                            <div class="alert-txt"><em class="ti ti-alert"></em>Plan Deleted Successfully!</div>
                        </div>';
}

$getw=$royaldb->query("SELECT * FROM plans WHERE id > 0 ORDER BY min ASC") or die($royaldb->error);
$getwi="";
if($getw->num_rows>0){
    $sn=1;
    while($loadw=$getw->fetch_object()){
        
    $getwi.="<tr><td>$sn</td><td>$loadw->plan_name</td><td>$$loadw->min</td><td>$$loadw->max</td><td>$loadw->return_percent%</td><td>$loadw->planrange $loadw->type</td><td><a class='btn btn-xs btn-primary' href='?del=$loadw->id'>Delete</a></td></tr>";
        $sn++;
    }
}
else{
    $getwi.=' <div class="alert-box alert-primary">
                            <div class="alert-txt"><em class="ti ti-alert"></em>No Plan Yet!</div>
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
                        if (document.editform.plan_name.value == '') {
                            alert("Input your plan name!");
                            document.editform.plan_name.focus();
                            return false;
                        }
                    }

                </script>
                <div class="user-content">
                    <div class="user-panel">

                        <h2 class="user-panel-title">Plan</h2>
                       
                        <hr class="linie">



                        <div class="gaps-1x"></div>
                        <?=$mErr?>
                        <div class="gaps-1x"></div>

                        <form method=post onsubmit="return checkform()" name=editform>


                            <div class="row">
                                <div class="col-md-4">
                                    <div class="payment-from">
                                        <label for="txtAmount"><strong>Plan Name</strong></label>
                                        <div class="payment-input">
                                            <input class="input-bordered" type="text" name="plan_name">

                                        </div>
                                    </div>
                                </div><!-- .col -->
                                <div class="col-md-4">
                                    <div class="payment-from">
                                        <label for="txtAmount"><strong>Max Amount</strong></label>
                                        <div class="payment-input">
                                            <input class="input-bordered" type="number" name="max_amount" required>
                                            <span class="payment-from-cur payment-cal-cur">$</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="payment-from">
                                        <label for="txtAmount"><strong>Min Amount</strong></label>
                                        <div class="payment-input">
                                            <input class="input-bordered" type="number" name="min_amount" required>
                                            <span class="payment-from-cur payment-cal-cur">$</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="payment-from">
                                    <label for="txtAmount"><strong>Daily Return(%)</strong></label>
                                    <div class="payment-input">
                                        <input class="input-bordered" type="text" name="daily_return" placeholder="1.2" required>
                                        <span class="payment-from-cur payment-cal-cur">%</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="payment-from">
                                    <label for="txtAmount"><strong>Plan Type</strong></label>
                                    <div class="payment-input">
                                        <select class="input-bordered" name="type" required>
                                            <option value="">--SELECT Plan Type--</option>
                                            <option value="hours">Hours</option>
                                            <option value="days">Days</option>
                                        </select>
                                        <span class="payment-from-cur payment-cal-cur">type</span>
                                    </div>
                                </div>
                            </div>
                            
                            
                            <div class="col-md-12">
                                <div class="payment-from">
                                    <label for="txtAmount"><strong>Plan Range</strong></label>
                                    <div class="payment-input">
                                        <input class="input-bordered" type="number" name="planrange" placeholder="5" required>
                                        <span class="payment-from-cur payment-cal-cur">range</span>
                                    </div>
                                </div>
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
                                                <th>Plan Name</th>
                                                <th>Min Amount</th>
                                                <th>Max Amount</th>
                                                <th>Percent(%)</th>
                                                <th>Return</th>
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
