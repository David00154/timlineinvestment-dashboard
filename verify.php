<?php
include "core/config.php";
if (!isLogged()) {
  header("location: login.php");
  exit;
}

$mErr = "";
if (isset($_POST['verify'])) {
  $vcode = $_POST['vcode'];
  if ($vcode != $UserDetails->vcode) {
    $_SESSION['alert'] = '<div class="callout callout-danger"> <strong><i class="fa fa-info-circle"></i></strong> &nbsp;  Invalid Verification Code</div>';
    header("location: verify.php");
    exit;
  } else {
    $up = $royaldb->query("UPDATE user SET vcode=0 WHERE id=$UserDetails->id");
    header("location: account");
    exit;
  }
}
if (isset($_POST['resend'])) {

  $usr = new Royaltechinc\Mailer;
  $usr->mailVcode($UserDetails->email, $UserDetails->full_name, $UserDetails->vcode);
  $_SESSION['alert'] = '<div class="callout callout-success"> <strong><i class="fa fa-info-circle"></i></strong> Verification  Code sent successfully!</div>';
   header("location: verify.php");
  exit;
}




?>


<!DOCTYPE html>
<html>

<!-- Mirrored from TimeLine-Investment .com/sign-in.php by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Nov 2020 10:45:59 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Reliable trading and investment platform for all">
  <meta name="author" content="TimeLine-Investment ">
  <title>Verify | TimeLine-Investment </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="dist/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">
  <link href="images/favicon.png" rel="shortcut icon" type="image/png">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style>
    .goog-te-gadget .goog-te-combo {
      margin: 4px 0;
      width: 100%;
      padding: 7px;
      border-radius: 5px;
    }
  </style>
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="/"><img src="images/auth-logo.png" class="img-responsive"></a>
    </div>
    <!-- /.login-logo -->
    <div id="google_translate_element"></div>
    <div class="login-box-body">
      <p class="login-box-msg">Verification</p>
      <!-- json response will be here -->
      <div id="errorDiv" style>

      </div>
      <!-- json response will be here -->
      <?php
      if (isset($_SESSION["alert"])) {
        echo $_SESSION["alert"];
        unset($_SESSION["alert"]);
      }
      ?>

      <form id="login-form" method="post">
        <div class="form-group has-feedback">
          <input type="text" class="form-control" value="<?= $UserDetails->username ?>" readonly>
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
          <span class="help-block" id="error"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="number" name="vcode" class="form-control" placeholder="Verification Code">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          <span class="help-block" id="error"></span>
        </div>
        <div class="row">
          <div class="col-xs-6">
            <div class="checkbox icheck">
              <label>
                <input type="submit" name="resend" value="Resend Link">
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-xs-6">
            <button type="submit" name="verify" class="btn btn-info btn-block btn-flat"><i class="fa fa-sign-in"></i> Verify</button>
          </div>
          <!-- /.col -->
        </div>
      </form>


    </div>
    <!-- /.login-box-body -->
  </div>
  <!-- /.login-box -->
  <script type="text/javascript">
    function googleTranslateElementInit() {
      new google.translate.TranslateElement({
        pageLanguage: 'en',
        layout: google.translate.TranslateElement.InlineLayout.SIMPLE
      }, 'google_translate_element');
    }
  </script>

  <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>


  <script>
    function googleTranslateElementInit() {
      new google.translate.TranslateElement({
          pageLanguage: 'en'
        },
        'google_translate_element'
      );
      /*
    To remove the "powered by google",
    uncomment one of the following code blocks.
    NB: This breaks Google's Attribution Requirements:
    https://developers.google.com/translate/v2/attribution#attribution-and-logos
*/

      // Native (but only works in browsers that support query selector)
      if (typeof(document.querySelector) == 'function') {
        document.querySelector('.goog-logo-link').setAttribute('style', 'display: none');
        document.querySelector('.goog-te-gadget').setAttribute('style', 'font-size: 0');
      }

      // If you have jQuery - works cross-browser - uncomment this
      jQuery('.goog-logo-link').css('display', 'none');
      jQuery('.goog-te-gadget').css('font-size', '0');
    }
  </script>
  <!-- jQuery 3 -->
  <script src="dist/js/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="dist/bootstrap/js/bootstrap.min.js"></script>

  <!-- iCheck -->
  <script src="plugins/iCheck/icheck.min.js"></script>


</body>

<!-- Mirrored from TimeLine-Investment .com/sign-in.php by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Nov 2020 10:45:59 GMT -->

</html>