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

$mError = "";
if (isset($_POST['reset'])) {
  $oldpassword = $_POST['current_password'];
  $newpassword = $_POST['new_password'];
  $renewpassword = $_POST['confirm_password'];
  $error = [];
  $pass = PassHash($oldpassword);
  $g = $royaldb->query("SELECT * FROM user WHERE username='$UserDetails->username' AND password!='$pass'") or die($royaldb->error);
  if ($g->num_rows > 0) {
    $error[] = "Incorrect Old Password";
  }
  if ($renewpassword != $newpassword) {
    $error[] = "New Password does not match";
  }
  if (count($error) > 0) {
    $_SESSION['alert'] = '<div class="alert alert-danger">
            <i class="fa fa-info-circle"></i> ' . $error[0] . '
      </div>';
    header("location: change-password.php");
    exit;
  } else {
    $newpass = PassHash($newpassword);
    $up = $royaldb->query("UPDATE user SET password='$newpass' WHERE email='$UserDetails->email'") or die($royaldb->error);
    $_SESSION['alert'] = '<div class="alert alert-success">
            <i class="fa fa-info-circle"></i> Password changed successfully 
      </div>';
    header("location: change-password.php");
    exit;
  }
}

include "header.php";
include "sidebar.php";

?>
<title>Change Password | TimeLine-Investment </title>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div id="google_translate_element" class="text-center mb-2"></div>
    <h1>
      Change Passowrd
    </h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="breadcrumb-item active">Change Passowrd</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-sm-12">
        <?php
        if (isset($_SESSION["alert"])) {
          echo $_SESSION["alert"];
          unset($_SESSION["alert"]);
        }
        ?>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="box box-solid bg-dark">
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-lock"></i> Reset Passowrd</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <form class="form" method="post" action="change-password.php">
              <input type="hidden" name="csrf_token" value="e84baf23a4f1fdf9e8824195ddfc63a3">
              <div class="form-group">
                <label for="current_password">Current Password</label>
                <input class="form-control" type="password" name="current_password" placeholder="Enter Current Password" required>
              </div>

              <div class="form-group">
                <label for="current_password">New Password</label>
                <input class="form-control" type="password" name="new_password" placeholder="Enter New Password" required>
              </div>

              <div class="form-group">
                <label for="acct_swift">Confirm Password</label>
                <input class="form-control" type="password" name="confirm_password" placeholder="Re-enter New Password" required>
              </div>

              <div class="form-group">
                <button name="reset" type="submit" class="btn btn-info"><i class="fa fa-check-square-o"></i> Reset Password</button>
              </div>
            </form>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- Col -->
      <!-- Row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<?php
include "footer.php";
?>