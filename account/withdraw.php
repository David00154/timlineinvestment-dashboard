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
$depo = $royaldb->query("SELECT * FROM withdrawal WHERE user_id='$UserDetails->id' ORDER BY id DESC") or die($royaldb->error);
if ($depo->num_rows > 0) {
  $sn = 1;
  while ($load = $depo->fetch_object()) {
    $getWdate = date("M-d-Y", $load->date);
    if ($load->status == 0) {
      $status = "Pending";
    } else {
      $status = "Approved";
    }
    $getdepo .= "<tr><td>$sn</td><td>$" . number_format($load->amount) . "</td><td>$load->method</td><td>$status</td><td>$getWdate</td></tr>";
    $sn++;
  }
}

if (isset($_POST['withdraw'])) {
  $amount = $_POST['amount'];
  $withdrawal_method = $_POST['withdrawal_method'];
  if ($amount == $UserDetails->balance) {
    $bal = "0";
  } else {
    $bal = $UserDetails->balance - $amount;
  }
  if ($withdrawal_method == "Bitcoin") {
    $btc_address = $_POST['btc_address'];
    $w = $royaldb->query("UPDATE user SET balance=$bal WHERE id=$UserDetails->id") or die($royaldb->error);
    $wu = $royaldb->query("INSERT INTO withdrawal SET amount=$amount, user_id=$UserDetails->id, receiver='$btc_address', date=$time") or die($royaldb->error);
  } else if ($withdrawal_method == "PayPal") {
    $paypal_email = $_POST['paypal_email'];
    $w = $royaldb->query("UPDATE user SET balance=$bal WHERE id=$UserDetails->id") or die($royaldb->error);
    $wu = $royaldb->query("INSERT INTO withdrawal SET amount=$amount, method='PayPal', user_id=$UserDetails->id, receiver='$paypal_email', date=$time") or die($royaldb->error);
  } else {
    $bank_name = $_POST['bank_name'];
    $acct_name = $_POST['acct_name'];
    $acct_no = $_POST['acct_no'];
    $swift_code = $_POST['swift_code'];
    $bank = array(
      'bankname' => $bank_name,
      'acct_name' => $acct_name,
      'acct_no' => $acct_no,
      'bank_code' => $swift_code
    );

    $response = json_encode($bank);
    $nmethod = "Bank Transfer";
    $w = $royaldb->query("UPDATE user SET balance=$bal WHERE id=$UserDetails->id") or die($royaldb->error);
    $wu = $royaldb->query("INSERT INTO withdrawal SET amount=$amount, user_id=$UserDetails->id, method='$nmethod', receiver='$response', date=$time") or die($royaldb->error);
  }

  $_SESSION['alert'] = '<div class="alert alert-success alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <h4><i class="fa fa-sucess"></i> Alert!</h4>
                      <h5>Withdrawal was successful, Please wait for approval</h5>
                    </div>';
  header("location: withdraw.php");
  exit;
}




include "header.php";
include "sidebar.php";




?>
<title>Withdrawal | TimeLine-Investment </title>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div id="google_translate_element" class="text-center mb-2"></div>
    <h1>
      Withdraw Funds
    </h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="breadcrumb-item active">Withdraw Funds</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-sm-12">
      </div>
    </div>

    <div class="row">
      <div class="col-md-4">
        <div class="alert alert-info bg-dark">
          <div class="row">
            <div class="col-7">
              <h5>Balance:</h5>
            </div>
            <div class="col-5 text-right">
              <h6 class='text-white modal-title'><strong> $0.00 </strong></h6>
            </div>
          </div>
          <div class="row">
            <div class="col-7">
              <h5>BTC Balance:</h5>
            </div>
            <div class="col-5 text-right">
              <h6 class='text-white modal-title'><strong>
                  <span class="badge badge-danger" id="balancebtc"></span></strong></h6>
            </div>
          </div>

        </div>
      </div>
      <!-- /.col -->

    </div>
    <!-- /.row -->
    <?php
    if (isset($_SESSION["alert"])) {
      echo $_SESSION["alert"];
      unset($_SESSION["alert"]);
    }
    ?>

    <div class="row">
      <div class="col-md-12">
      </div>
    </div>

    <div class="row">
      <div class="col-lg-6">
        <div class="box box-solid">
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-money"></i> Withdrawal Request</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <form class="form" method="post">
              <div class="form-group">
                <label for="withdrawal_method">Select Withdrawal Method</label>
                <select name="withdrawal_method" class="form-control" id="withdrawalMethod" required>
                  <option value="">--Select Method--</option>
                  <option value="Bitcoin">Bitcoin</option>
                  <option value="PayPal">PayPal</option>
                  <option value="Bank Transfer">Bank Transfer</option>
                </select>
              </div>

              <div id="beneficiaryField1" class="form-group" style="display: none">
                <label for="bank_name">Bank Name</label>
                <input class="form-control border-primary" type="text" name="bank_name" placeholder="Enter Bank Name">
              </div>

              <div id="beneficiaryField2" class="form-group" style="display: none">
                <label for="acct_name">Account Name</label>
                <input class="form-control border-primary" type="text" name="acct_name" placeholder="Enter Account Name">
              </div>

              <div id="beneficiaryField3" class="form-group" style="display: none">
                <label for="acct_no">Account Number</label>
                <input class="form-control border-primary" type="text" name="acct_no" placeholder="Enter Account Number">
              </div>

              <div id="beneficiaryField4" class="form-group" style="display: none">
                <label for="swift_code">Swift Code</label>
                <input class="form-control border-primary" type="text" name="swift_code" placeholder="Enter Swift Code">
              </div>

              <div id="beneficiaryField5" class="form-group" style="display: none">
                <label for="paypal_email">PayPal Email</label>
                <input class="form-control border-primary" type="text" name="paypal_email" placeholder="Enter PayPal Email">
              </div>

              <div id="beneficiaryField6" class="form-group" style="display: none">
                <label for="btc_address">BTC Wallet</label>
                <input class="form-control border-primary" type="text" name="btc_address" placeholder="Enter Bitcoin Wallet Address">
              </div>

              <div class="form-group">
                <label for="amount">Enter Withdrawal Amount</label>
                <input class="form-control border-primary" type="number" name="amount" placeholder="0.00" id="amount" min="500" max="<?= $UserDetails->balance ?>" required>
              </div>

              <div class="form-group">
                <button name="withdraw" type="submit" class="btn btn-info"><i class="fa fa-check-square-o"></i> Request Withdrawal</button>
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
            <h3 class="box-title"><i class="icon-wallet"></i> Withdrawal FAQ</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <h6 style="color: #1E9FF2;"><strong>Withdrawing Funds – How Does It Work? </strong></h6>
            At Stormerfxt Stock Option, we have designed our withdrawal process to be as easy as our funding process. To begin the withdrawal process first select your preferred withdrawal method and then type in the amount you want to withdraw and click "Proceed". <br><br>

            <h6 style="color: #1E9FF2;"><strong>What Methods Are There For Withdrawal Of Funds? </strong></h6>
            Stormerfxt Stock Option provides three(3) withdrawal methods (Bitcoin, PayPal and Direct Bank Transfer). <br><br>

            <h6 style="color: #1E9FF2;"><strong>Must Withdrawal Requests Only Be Made At Certain Times? </strong></h6>
            Requests for withdrawals can be made at any time via the Stormerfxt Stock Option website. The requests will be processed immediately, and during the relevant financial institution's business hours.<br><br>

            <h6 style="color: #1E9FF2;"><strong>Is There A Withdrawal Limit? </strong></h6>
            Withdrawals are capped at the amount of funds that are currently in the account. <br><br>

            <h6 style="color: #1E9FF2;"><strong>How Long Does It Take To Get My Money? </strong></h6>
            Withdrawal requests are addressed and handled as quickly as possible.
          </div>
          <!-- /.box-body -->

        </div>
        <!-- /.box -->
      </div>
      <!-- Col -->
    </div>
    <!-- Row -->
    <div class="row">
      <div class="col-md-12">
        <div class="box box-solid">
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-line-chart"></i> Withdrawal History Summary</h3>

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
                    <th>Method</th>
                    <th>Status</th>
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


<script type="text/javascript">
  $(function() {
    $("#withdrawalMethod").change(function() {
      if ($(this).val() == "Bank Transfer") {
        $("#beneficiaryField1").fadeIn();
        $("#beneficiaryField2").fadeIn();
        $("#beneficiaryField3").fadeIn();
        $("#beneficiaryField4").fadeIn();
        $("#beneficiaryField5").hide();
        $("#beneficiaryField6").hide();
      } else if ($(this).val() == "PayPal") {
        $("#beneficiaryField5").fadeIn();
        $("#beneficiaryField1").hide();
        $("#beneficiaryField2").hide();
        $("#beneficiaryField3").hide();
        $("#beneficiaryField4").hide();
        $("#beneficiaryField6").hide();
      } else if ($(this).val() == "Bitcoin") {
        $("#beneficiaryField6").fadeIn();
        $("#beneficiaryField1").hide();
        $("#beneficiaryField2").hide();
        $("#beneficiaryField3").hide();
        $("#beneficiaryField4").hide();
        $("#beneficiaryField5").hide();
      }
    });
  });
</script>

<script type="text/javascript">
  $(document).ready(function() {
    $("#myModal").modal('show');
  });
</script>