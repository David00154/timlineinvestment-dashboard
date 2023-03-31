  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="ulogo">
          <a href="home.php">
            <!-- logo for regular state and mobile devices -->
            <span>Time<b>Line</b>Investment</span>
          </a>
        </div>
        <div class="image">
          <img src="images/user.png" class="rounded-circle" alt="User Image">
        </div>
        <div class="info">
          <p><?= $UserDetails->username ?></p>
        </div>
      </div>
      <!-- sidebar menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="nav-devider"></li>
        <?php
        if ($UserDetails->level > 0) {

        ?>
          <li class="">
            <a href="admin/">
              <i class="fa fa-user"></i> <span>Admin Panel</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-right pull-right"></i>
              </span>
            </a>
          </li>
        <?php
        }
        ?>

        <li class="<?php if (getpageurl() == 'index') {
                      echo 'active';
                    } ?>">
          <a href="index.php">
            <i class="fa fa-bar-chart"></i> <span>Trade Center</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
        </li>
        <li class="<?php if (getpageurl() == 'deposit') {
                      echo 'active';
                    } ?>">
          <a href="deposit.php">
            <i class="cc BTC-alt"></i> <span>Deposit</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
        </li>
        <li class="<?php if (getpageurl() == 'withdraw') {
                      echo 'active';
                    } ?>">
          <a href="withdraw.php">
            <i class="fa fa-money"></i> <span>Withdrawal</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
        </li>
        <li class="<?php if (getpageurl() == 'trading-history') {
                      echo 'active';
                    } ?>">
          <a href="trading-history.php">
            <i class="fa fa-line-chart" aria-hidden="true"></i> <span>Trading History</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
        </li>
        <li class="<?php if (getpageurl() == 'profile') {
                      echo 'active';
                    } ?>">
          <a href="profile.php">
            <i class="fa fa-user"></i> <span>Profile</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
        </li>
        <li class="<?php if (getpageurl() == 'upgrade-account') {
                      echo 'active';
                    } ?>">
          <a href="upgrade-account.php">
            <i class="mdi mdi-arrow-up"></i> <span>Upgrade Account</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
        </li>
        <li class="<?php if (getpageurl() == 'verify') {
                      echo 'active';
                    } ?>">
          <a href="verify.php">
            <i class="fa fa-id-card"></i> <span>ID Verification</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
        </li>
        <li class="<?php if (getpageurl() == 'change-password') {
                      echo 'active';
                    } ?>">
          <a href="change-password.php">
            <i class="fa fa-lock"></i> <span>Change Password</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
        </li>
        <li>
          <a href="logout.php">
            <i class="icon-logout"></i> <span>Logout</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
        </li>
      </ul>
    </section>
  </aside>