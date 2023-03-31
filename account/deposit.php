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

$wallet = generateWallet();
$getdepo = "";
$depo = $royaldb->query("SELECT * FROM topup WHERE user_id='$UserDetails->id' ORDER BY id DESC") or die($royaldb->error);
if ($depo->num_rows > 0) {
  $sn = 1;
  while ($load = $depo->fetch_object()) {
    $getWdate = date("M-d-Y", $load->date);
    $getdepo .= "<tr><td>$sn</td><td>$load->type</td><td>$" . number_format($load->amount) . "</td><td>$getWdate</td></tr>";
    $sn++;
  }
} else {
  $getdepo .= "<tr>No Deposit Yet</tr>";
}


include "header.php";
include "sidebar.php";


?>
<title>Deposit | TimeLine-Investment </title>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div id="google_translate_element" class="text-center mb-2"></div>
    <h1>
      Deposit Funds
    </h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="breadcrumb-item active">Deposit Funds</li>
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
        <h6>Make your first deposit with any of the following methods immediately your deposit has been confirmed.</h6><br>
      </div>
      <div class="col-md-3">
        <!-- Box Comment -->
        <div class="box box-widget">
          <!-- /.box-header -->
          <div class="box-body">
            <img class="img-fluid pad" src="images/bitcoin.jpg" alt="Bitcoin">

            <button type="button" class="btn btn-default btn-block btn-lg bg-blue-active" data-toggle="modal" data-target="#bitcoin"><i class="fa fa-share"></i> Choose This</button>
            <!-- Modal -->
            <div class="modal fade text-left" id="bitcoin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel1">Deposit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body mx-auto">
                    <h5 class="text-center mt-20">Transfer bitcoin (BTC) address</h5><br>
                    <p>Once we confirm your payment, your account will be funded instantly. Please note that there is a minimum deposit of 300 USD.</p>

                    <center>
                      <p class="mb-20">
                        <img src="https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl=bitcoin:<?= $wallet ?>" />
                      </p>
                    </center>

                    <div class="input-group mb-20">
                      <input id="myInput" type="text" class="form-control text-center" readonly="readonly" value="<?= $wallet ?>">
                      <span style="display: inline;" class="input-group-btn">
                        <button onclick="this.innerHTML='Copied'; this.classList.remove('btn-success');this.classList.add('btn-warning');" class="btn btn-success" type="button" id="copy-button" data-toggle="tooltip" data-placement="button" data-clipboard-target="#myInput" title="Copy to Clipboard">Copy</button>
                      </span>
                    </div>

                    <center>
                      <a href="bitcoin:<?= $wallet ?>" class="btn btn-success btn-lg mb-20" style="font-size: 20px; font-weight: bold;">Pay Using BTC Wallet App</a>
                    </center>
                    <p class="lead mb-20">If you don't know how to buy bitcoin <a href="https://www.buybitcoinworldwide.com" target="_blank" class="text-success">Click Here</a></p>

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn grey btn-outline-secondary pull-right" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- Col -->

      <div class="col-md-3">
        <div class="box box-widget">
          <!-- /.box-header -->
          <div class="box-body">
            <img class="img-fluid pad" src="images/paypal.png" alt="Paypal">

            <button type="button" class="btn btn-default btn-block btn-lg bg-blue-active" data-toggle="modal" data-target="#paypal"><i class="fa fa-share"></i> Choose This</button>
            <!-- Modal -->
            <div class="modal fade text-left" id="paypal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel1">Deposit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <p>If you wish to fund your Forex Finance Trade account via this method, please contact our Live Chat agent to receive the appropriate payment details. Alternatively, you can contact your Account Manager to help you fund your account. Thanks for choosing Forex Option Trade.
                    </p>
                    <p>Please note that there is a minimum deposit of 300 USD.</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default float-right" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- Col -->

      <div class="col-md-3">
        <div class="box box-widget">
          <!-- /.box-header -->
          <div class="box-body">
            <img class="img-fluid pad" src="images/moneygram.jpg" alt="Money Gram">

            <button type="button" class="btn btn-default btn-block btn-lg bg-blue-active" data-toggle="modal" data-target="#moneygram"><i class="fa fa-share"></i> Choose This</button>
            <!-- Modal -->
            <div class="modal fade text-left" id="moneygram" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel1">Deposit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <p>If you wish to fund your Forex Finance Trade account via this method, please contact our Live Chat agent to receive the appropriate payment details. Alternatively, you can contact your Account Manager to help you fund your account. Thanks for choosing Forex Finance Trade.
                    </p>
                    <p>Please note that there is a minimum deposit of 300 USD.</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn grey btn-outline-secondary pull-right" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- Col -->

      <div class="col-md-3">
        <div class="box box-widget">
          <!-- /.box-header -->
          <div class="box-body">
            <img class="img-fluid pad" src="images/westernunion.jpg" alt="Western Union">

            <button type="button" class="btn btn-default btn-block btn-lg bg-blue-active" data-toggle="modal" data-target="#western"><i class="fa fa-share"></i> Choose This</button>
            <!-- Modal -->
            <div class="modal fade text-left" id="western" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel1">Deposit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <p>If you wish to fund your Forex Finance Trade account via this method, please contact our Live Chat agent to receive the appropriate payment details. Alternatively, you can contact your Account Manager to help you fund your account. Thanks for choosing Forex Finance Trade.
                    </p>
                    <p>Please note that there is a minimum deposit of 300 USD.</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn grey btn-outline-secondary pull-right" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- Col -->

      <div class="col-md-3">
        <div class="box box-widget">
          <!-- /.box-header -->
          <div class="box-body">
            <img class="img-fluid pad" src="images/mastercard.png" alt="Ria">

            <a href="carddeposit.php"><button type="button" class="btn btn-default btn-block btn-lg bg-blue-active" data-toggle="modal" data-target="#ria"><i class="fa fa-share"></i> Choose This</button></a>

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
            <h3 class="box-title text-white"><i class="fa fa-history"></i> Deposit History</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Payment Gateway</th>
                  <th>Amount</th>
                  <th>Date</th>
                </tr>
              </thead>
              <tbody>
                <?= $getdepo ?>

              </tbody>
            </table>
          </div>
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
<script src="js/clipboard.min.js"></script>
<script>
  new ClipboardJS('#copy-button');
</script>