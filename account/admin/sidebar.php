<div class="user-sidebar">
    <div class="user-sidebar-overlay"></div>
    <div class="user-box d-none d-lg-block">
        <div class="user-image">
            <img src="images/user-thumb-lg.png" alt="thumb">
        </div>
        <h6 class="user-name"><?= $UserDetails->full_name ?></h6>
        <div class="user-uid"><?= $UserDetails->username ?></div>

    </div><!-- .user-box -->
    <div class="gaps-1x"></div>
    <div class="d-lg-none" style="z-index:3;">
        <ul class="topbar-action-list">
            <li class="topbar-action-item topbar-action-link">
                <a href="https://timelineinvestment.fxnetwork.space"><em class="ti ti-home"></em> Home</a>
            </li><!-- .topbar-action-item -->
            <li class="dropup topbar-action-item topbar-action-language">
                <!--<a href="#" data-toggle="dropdown"><img src="images/BTC.svg">WALLET<em class="ti ti-angle-down"></em></a>-->
                <a href="#" data-toggle="dropdown">

                    <img src="images/BTC.svg">
                    WALLET <em class="ti ti-angle-down"></em>
                </a>

            </li><!-- .topbar-action-item -->
        </ul><!-- .topbar-action-list -->
        <div class="user-sidebar-sap"></div>
    </div>


    <ul class="user-icon-nav">
        <li class="active"><a href="index.php"><em class="ti ti-dashboard"></em>Dashboard</a></li>
        <?php

        if ($UserDetails->level == 1) {

        ?>
            <li><a href="../index.php"><em class="ti ti-user"></em>User Panel</a></li>
        <?php
        }
        ?>

        <li><a href="plan.php"><em class="ti ti-import"></em>Plans</a></li>
        <li><a href="userupload.php"><em class="ti ti-credit-card"></em>User ID card Upload</a></li>
        <li><a href="add-balance.php"><em class="ti ti-import"></em>Add Top Up</a></li>
        <li><a href="withdraw.php"><em class="ti ti-import"></em>User Withdraw</a></li>
        <li><a href="deposits.php"><em class="ti ti-import"></em>Users Investment</a></li>
        <li><a href="wallet.php"><em class="ti ti-credit-card"></em>Add Wallet</a></li>
        <!--  <li><a href="payout.php"><em class="ti ti-credit-card"></em>Add Payout</a></li>-->
        <li><a href="logout.php"><em class="ti ti-power-off"></em>Logout</a></li>
    </ul><!-- .user-icon-nav -->
    <div class="user-sidebar-sap"></div><!-- .user-sidebar-sap -->
    <ul class="user-nav">
        <li>Contact Support<span>support@timelineinvestment.uk</span></li>
    </ul><!-- .user-nav -->
</div><!-- .user-sidebar -->