<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">
	<!-- Bootstrap 4.0-->
	<link rel="stylesheet" href="assets/vendor_components/bootstrap/dist/css/bootstrap.css">
	
	<!-- Bootstrap-extend -->
	<link rel="stylesheet" href="css/bootstrap-extend.css">

	<!-- theme style -->
	<link rel="stylesheet" href="css/master_style.css">

	<!-- Crypto_Admin skins -->
	<link rel="stylesheet" href="css/skins/_all-skins.css">
	<script src="assets/vendor_components/jquery/dist/jquery.js"></script>
      <script src="js/wow.min.js"></script>
      <script src="js/count.js"></script>

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<style type="text/css">
	    .goog-te-gadget .goog-te-combo {
        	padding: 5px;
        	border-radius: 5px;
        }
	</style>
</head>
<body class="hold-transition skin-black sidebar-mini fixed">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index.php" class="logo">

      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">
  		  <img src="images/logo-light-text.png" alt="logo" class="light-logo">
  	  	<img src="images/logo-dark-text.png" alt="logo" class="dark-logo">
  	  </span>
    </a>                           
    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="user user-menu" style="margin-right: 40px;">
            <a href="#" class="btn btn-outline-danger" style="margin-top: 15px; color: #f15c30;">
              TRADING SESSION
            </a>
          </li>
          
          
          <li class="dropdown user user-menu">
            <a href="#" class="btn btn-info" style="margin-top: 15px;">
              <?=$UserDetails->username?>            </a>
          </li>

		      <!-- User Account -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="images/user.png" class="user-image rounded-circle" alt="User Image">
            </a>
            <ul class="dropdown-menu scale-up">
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row no-gutters">
                  <div class="col-12">
                    <a href="profile.php"><i class="ion ion-person"></i> My Profile</a>
                  </div>
                  <div class="col-12">
                    <a href="change-password.php"><i class="fa fa-lock"></i> Change Password</a>
                  </div>
				          <div class="col-12">
                    <a href="logout.php"><i class="icon-logout"></i> Logout</a>
                  </div>				
                </div>
                <!-- /.row -->
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>  