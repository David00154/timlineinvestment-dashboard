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

$getplan = "";
$plan = $royaldb->query("SELECT * FROM plans WHERE id > 0 ORDER BY min ASC") or die($royaldb->error);
if ($plan->num_rows > 0) {
  while ($load = $plan->fetch_object()) {
    $getplan .= '<div class="col-lg-3">
              <div class="box text-center p-30 box-outline-' . randomcolor() . ' bg-hexagons-dark">
                <div class="box-body" style="padding: 0;">
                  <h5 class="text-uppercase">' . $load->plan_name . '</h5>
                  <br>
                  <h3 class="font-weight-100 font-size-60">$' . number_format($load->min) . ' - $' . number_format($load->max) . '</h3>

                  <hr>

                  <p><strong>24x7 Support</strong></p>
                  <p><strong>Professional Charts</strong></p>
                  <p><strong>Trading Alerts</strong></p>
                  <p><strong>Return On Investment: <br><span class="font-size-30">' . $load->return_percent . '%</span></strong></p>

                  <br><br>
                  <button type="button" class="btn btn-bold btn-block btn-' . randomcolor() . '" data-toggle="modal" data-target="#starter"> Choose this </button>
                  <!-- Modal -->
                    <div class="modal fade text-left" id="starter" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                          <h5 class="modal-title" id="myModalLabel1">Account Upgrade</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <p>To upgrade your TimeLine-Investment account to a higher plan, please contact our Live Chat agent to receive the appropriate payment details. Alternatively, you can contact your Account Manager to help you with the account upgrade.</p>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default float-right" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
              </div>
            </div>';
  }
} else {
  $getplan .= '<div class="box-body">
                  <div class="alert alert-info" style="margin: 20px;">No Plan Yet</div> 
              </div>';
}


include "header.php";
include "sidebar.php";

?>


<title>Upgrade | TimeLine-Investment </title>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div id="google_translate_element" class="text-center mb-2"></div>
    <h1>
      Our Plans
    </h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="breadcrumb-item active">Our Plans</li>
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
        <h6>Upgrade your trading account to a level that best fits your trading experience and have access to several trading benefits. <br></h6><br>
      </div>
      <?= $getplan ?>
    </div>
    <!-- /.row -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php
include "footer.php";
?>