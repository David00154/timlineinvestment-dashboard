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
$getdepo = "";
$depo = $royaldb->query("SELECT * FROM deposit WHERE user_id='$UserDetails->id' ORDER BY id DESC") or die($royaldb->error);
if ($depo->num_rows > 0) {
  $sn = 1;
  while ($load = $depo->fetch_object()) {
    $getWdate = date("M-d-Y", $load->date);
    $getdepo .= "<tr><td>$sn</td><td>$" . number_format($load->amount) . "</td><td>$" . number_format($load->t_profit) . "</td><td>$getWdate</td></tr>";
    $sn++;
  }
}






include "header.php";
include "sidebar.php";


?>

<title>Trading History | TimeLine-Investment </title>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div id="google_translate_element" class="text-center mb-2"></div>
    <h1>
      Trading History
    </h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="breadcrumb-item active">Trading History</li>
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
        <div class="box box-solid">
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-line-chart"></i> Trading History Summary</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
          </div>
          <?php
          if ($depo->num_rows > 0) {

          ?>

            <div class="box-body table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Amount</th>
                    <th>Interest Amount</th>
                    <th>Date</th>
                  </tr>
                </thead>
                <tbody>
                  <?= $getdepo ?>

                </tbody>
              </table>
            </div>

          <?php
          } else {
          ?>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="alert alert-info" style="margin: 20px;">You do not have an active trade. Click trade now to start trading</div>
            </div>
          <?php }
          ?>
          <br>
        </div>
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<?php
include "footer.php";

?>