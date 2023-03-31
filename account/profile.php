<?php
include "../core/config.php";

if (!isLogged()) {
  header("location: ../sign-in.php");
  exit;
}
if ($UserDetails->verify > 0) {
  header("location: verify.php");
  exit;
}

include "header.php";
include "sidebar.php";

?>
<title>Profile | TimeLine-Investment </title>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div id="google_translate_element" class="text-center mb-2"></div>
    <h1>
      My Profile
    </h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="breadcrumb-item active">My Profile</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-sm-12">
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <!-- Widget: user widget style 1 -->
        <div class="box box-widget widget-user">
          <!-- Add the bg color to the header using any of the bg-* classes -->
          <div class="widget-user-header bg-black" style="background: url('images/22.png') center center;">
            <h3 class="widget-user-username"><?= $UserDetails->username ?></h3>
          </div>
          <div class="widget-user-image">
            <img class="rounded-circle" src="images/user.png" alt="User Avatar">
          </div>

        </div>
        <!-- /.widget-user -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
      <div class="col-lg-6">
        <div class="box box-solid">
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-user"></i> Personal Information</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="list-group list-group-flush">
              <p class="list-group-item text-info"><i class="fa fa-user"></i> Username: &nbsp;&nbsp; <strong><?= $UserDetails->username ?></strong> </p>
              <p class="list-group-item text-info"><i class="fa fa-user"></i> Fullname: &nbsp;&nbsp; <strong><?= $UserDetails->full_name ?></strong> </p>
              <p class="list-group-item text-info"> <i class="fa fa-envelope"></i> Email: &nbsp;&nbsp; <strong><?= $UserDetails->email ?></strong> </p>
              <p class="list-group-item text-info"><i class="fa fa-phone"></i> Phone: &nbsp;&nbsp; <strong><?= $UserDetails->phone_number ?></strong> </p>
              <p class="list-group-item text-info"><i class="fa fa-venus-double"></i> Gender: &nbsp;&nbsp; <strong><?= $UserDetails->gender ?></strong> </p>
              <p class="list-group-item text-info"><i class="fa fa-map-marker"></i> Country of Residence: &nbsp;&nbsp; <strong><?= $UserDetails->country ?></strong> </p>
            </div>
          </div>
          <!-- /.box-body -->

        </div>
        <!-- /.box -->
      </div>
      <!-- Col -->

      <div class="col-lg-6">
        <div class="box box-solid">
          <div class="box-header with-border">
            <h3 class="box-title"><i class="icon-wallet"></i> Account Information</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="list-group list-group-flush">
              <p class="list-group-item text-info"><i class="fa fa-money"></i> Available Balance: &nbsp;&nbsp; <strong> $<?= number_format($UserDetails->balance) ?></strong></p>
              <p class="list-group-item text-info"><i class="fa fa-cogs"></i> Account Status: &nbsp;&nbsp; <strong>Active</strong> </p>
              <p class="list-group-item text-info"><i class="fa fa-dashboard"></i> Account Type: &nbsp;&nbsp; <strong>Live Trading Account</strong> </p>
              <p class="list-group-item text-info"><i class="fa fa-bar-chart"></i> Trading Status: &nbsp;&nbsp; <strong><?php if ($UserDetails->status == 1) {
                                                                                                                          echo "Active";
                                                                                                                        } else {
                                                                                                                          echo "No Active Trade";
                                                                                                                        } ?></strong> </p>
            </div>
          </div>
          <!-- /.box-body -->

        </div>
        <!-- /.box -->
      </div>
      <!-- Col -->
    </div>
    <!-- Row -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->



<?php
include "footer.php";

?>