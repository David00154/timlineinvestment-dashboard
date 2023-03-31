<?php
include "../core/config.php";
if (!isLogged()) {
  header("location: ../sign-in.php");
  exit;
}
if ($UserDetails->verify == 0) {
  header("location: index.php");
  exit;
}

$mErr = "";
if (isset($_POST['verify'])) {
  $document_type = $_POST['document_type'];
  $front_page = $_FILES['front_page'];
  $back_page = $_FILES['back_page'];
  $frontname = urlize($UserDetails->full_name) . '_idfrontcard';
  $backname = urlize($UserDetails->full_name) . '_idbackcard';

  if ($front_page['size'] > 0) {
    $thumb_name = $front_page['name'];
    $thumb_tmp = $front_page['tmp_name'];
    $thumb_size = $front_page['size'];
    $thumb_upload_path = thumbs_upload_dir . '/' . $thumb_name;
    $thumb_ext = strtolower(pathinfo($thumb_upload_path, PATHINFO_EXTENSION));
    $thumb_link = $frontname . '.' . $thumb_ext;
    $new_thumb_upload_path = thumbs_upload_dir . '/' . $thumb_link;
    #validate size

    #validate extension

  }
  if ($back_page['size'] > 0) {
    $bthumb_name = $back_page['name'];
    $bthumb_tmp = $back_page['tmp_name'];
    $bthumb_size = $back_page['size'];
    $bthumb_upload_path = thumbs_upload_dir . '/' . $bthumb_name;
    $bthumb_ext = strtolower(pathinfo($bthumb_upload_path, PATHINFO_EXTENSION));
    $bthumb_link = $backname . '.' . $bthumb_ext;
    $bnew_thumb_upload_path = thumbs_upload_dir . '/' . $bthumb_link;
  }
  $move_thumb = move_uploaded_file($thumb_tmp, $new_thumb_upload_path);
  $bmove_thumb = move_uploaded_file($bthumb_tmp, $bnew_thumb_upload_path);
  $save = $royaldb->query("UPDATE user SET verify=2 WHERE id=$UserDetails->id") or die($royaldb->error);
  $usr = new Royaltechinc\Mailer;

  $usr->mailAdminCard("support@timelineinvestment.uk", $UserDetails->email, $UserDetails->full_name, $document_type, $thumb_link, $bthumb_link);
  $mErr = '<div class="alert alert-success alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <h4><i class="fa fa-sucess"></i> Alert!</h4>
                      <h5>ID Uploaded successfully. We will be in touch</h5>
                    </div>';
}


include "header.php";
include "sidebar.php";



?>
<title>ID Verification | TimeLine-Investment </title>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div id="google_translate_element" class="text-center mb-2"></div>
    <h1>
      KYC Verification
    </h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="breadcrumb-item active">KYC Verification</li>


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
            <h3 class="box-title"><i class="fa fa-user-secret"></i> Verify Identity</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="alert alert-info">
              <p style="font-size: 16px;">Verify Your account by providing us with a vaild document (ID card). Drivers Licence, Valid Work ID Card, Passport, etc are accepted. Please do not try to upload a fake document as our support team reviews every document uploaded.
                <br><br>
                Detected fake documents will lead to immediate suspension of account! Once Uploaded, Our support team reviews your document and gets back to you within 3 working days. The uploaded documents are for verification purposes only and are deleted once confirmed.
                <br><br>
                You will be notified via email once your document has been verified. Choose your document and click on the verify button.
              </p>
            </div>

            <br>
            <form class="form" method="post" enctype="multipart/form-data">

              <div class="form-group">
                <label>Document Type</label>
                <select class="form-control" name="document_type" required="">
                  <option value="">---Select Document Type---</option>
                  <option value="National I.D">National I.D</option>
                  <option value="Driver's Licence">Driver's Licence</option>
                  <option value="International Passport">International Passport</option>
                  <option value="Others">Others</option>
                </select>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="imageupload card bg-dark">
                    <div class="card-header clearfix">
                      <h6 class="card-title pull-left">Front Page</h6>
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
                      <h6 class="card-title pull-left">Back Page</h6>
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
                  <button name="verify" type="submit" class="btn btn-info btn-lg"><i class="fa fa-check-square-o"></i> Verify My Account</button>
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