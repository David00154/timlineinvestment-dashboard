<?php






?>


<!DOCTYPE html>
<html>

<!-- Mirrored from TimeLine-Investment.com/sign-in.php by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Nov 2020 10:45:59 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Reliable trading and investment platform for all">
  <meta name="author" content="TimeLine-Investment ">
  <title>Sign In | TimeLine-Investment </title>
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
      <p class="login-box-msg">Sign In</p>
      <!-- json response will be here -->
      <div id="errorDiv">
      </div>
      <!-- json response will be here -->

      <form id="login-form" method="post">
        <input type="hidden" name="csrf_token" value="c0644f36fad7f3838963606e90f5fd1b">
        <div class="form-group has-feedback">
          <input type="text" name="username" class="form-control" placeholder="Username">
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
          <span class="help-block" id="error"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" name="password" class="form-control" placeholder="Password">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          <span class="help-block" id="error"></span>
        </div>
        <div class="row">
          <div class="col-xs-6">
            <div class="checkbox icheck">
              <label>
                <input type="checkbox"> Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-xs-6">
            <button type="submit" name="login" class="btn btn-info btn-block btn-flat" id="btn-login"><i class="fa fa-sign-in"></i> Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <br>
      <!-- Forgot Password? <a href="forgot-password.php">Recover Here</a><br>-->
      Don't have an account yet? <a href="sign-up.php" class="text-center">Signup</a>

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
  <script src="js/jquery.validate.min.js"></script>
  <script src="js/login.js"></script>
  <!-- iCheck -->
  <script src="plugins/iCheck/icheck.min.js"></script>
  <script>
    $(function() {
      $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' /* optional */
      });
    });
  </script>

</body>

<!-- Mirrored from TimeLine-Investment.com/sign-in.php by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Nov 2020 10:45:59 GMT -->

</html>