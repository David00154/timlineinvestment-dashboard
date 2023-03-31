<div class="topbar">
    <div class="topbar-md d-lg-none">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between">
                <a href="#" class="toggle-nav">
                    <div class="toggle-icon">
                        <span class="toggle-line"></span>
                        <span class="toggle-line"></span>
                        <span class="toggle-line"></span>
                        <span class="toggle-line"></span>
                    </div>
                </a><!-- .toggle-nav -->

                <div class="site-logo">

                </div><!-- .site-logo -->

                <div class="dropdown topbar-action-item topbar-action-user">
                    <a href="#" data-toggle="dropdown"> <img class="icon" src="assets/images/user-thumb-sm.png" alt="thumb"> </a>

                </div>
                <!-- .toggle-action -->
            </div><!-- .container -->
        </div><!-- .container -->
    </div><!-- .topbar-md -->
    <div class="container">
        <div class="d-lg-flex align-items-center justify-content-between">
            <div class="topbar-lg d-none d-lg-block">
                <div class="site-logo">

                </div><!-- .site-logo -->
            </div><!-- .topbar-lg -->
            <div class="livePrice">1 BTC: <span class="BTCLive"></span></div>

            <div class="topbar-action d-none d-lg-block">
                <ul class="topbar-action-list">
                    <li class="topbar-action-item topbar-action-link">
                        <a href="/"><em class="ti ti-home"></em> Go to main site</a>
                    </li><!-- .topbar-action-item -->

                    <li class="dropdown topbar-action-item topbar-action-language">
                        <a href="#" data-toggle="dropdown">

                            <img src="images/BTC.svg">BTC
                            WALLET <em class="ti ti-angle-down"></em>
                        </a>


                    </li><!-- .topbar-action-item -->

                    <li class="dropdown topbar-action-item topbar-action-user">
                        <a href="#" data-toggle="dropdown"> <img class="icon" src="assets/images/user-thumb-sm.png" alt="thumb"> </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="user-dropdown">
                                <div class="user-dropdown-head">
                                    <h6 class="user-dropdown-name"><?= $UserDetails->full_name ?> <span>(<?= $UserDetails->username ?>)</span></h6>
                                    <span class="user-dropdown-email"><?= $UserDetails->email ?></span>
                                </div>
                                <div class="user-dropdown-balance">
                                    <h6>Balance</h6>
                                    <h3><?= $UserDetails->balance ?> USD</h3>
                                </div>
                                <ul class="user-dropdown-links">
                                    <li><a href=""><i class="ti ti-id-badge"></i>My Profile</a></li>
                                    <li><a href=""><i class="ti ti-lock"></i>Security</a></li>
                                </ul>
                                <ul class="user-dropdown-links">
                                    <li><a href="../logout.php"><i class="ti ti-power-off"></i>Logout</a></li>
                                </ul>
                            </div>
                        </div>
                    </li><!-- .topbar-action-item -->
                </ul><!-- .topbar-action-list -->
            </div><!-- .topbar-action -->
        </div><!-- .d-flex -->
    </div><!-- .container -->
</div>
<!-- TopBar End -->