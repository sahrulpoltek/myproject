<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>SB Admin - Start Bootstrap Template</title>
  <!-- Bootstrap core CSS-->
  <!-- <link href="<?php echo base_url()?>assets/css/bootstrap.min.css" rel="stylesheet"> -->
  <!-- Custom fonts for this template-->
  <!-- <link href="<?php echo base_url()?>assets/css/font-awesome.min.css" rel="stylesheet" type="text/css"> -->
  <!-- Custom styles for this template-->
  <!-- <link href="<?php echo base_url()?>assets/css/sb-admin.css" rel="stylesheet"> -->
  <!-- <link href="<?php echo base_url()?>assets/css/style.css" rel="stylesheet"> -->

  <link href="<?= base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?= base_url() ?>assets/css/font-awesome.min.css" rel="stylesheet">
	<link href="<?= base_url() ?>assets/css/datepicker3.css" rel="stylesheet">
	<link href="<?= base_url() ?>assets/css/styles.css" rel="stylesheet">
</head>
<body class="bg-login">
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading"><center>Log in</center></div>
				<center><?php echo $error?></center>
				<div class="panel-body">
        			<form method="post" action="">
							<br>
							<div class="form-group">
								<input class="form-control" type="text" aria-describedby="emailHelp" placeholder="Email Address" name="username">
							</div>
							<div class="form-group">
								<input class="form-control" id="exampleInputPassword1" type="password" placeholder="Password" name="password">
							</div>
							<div class="checkbox">
								<label>
									<input name="remember" class="form-check-input" type="checkbox" value="Remember Me">Remember Me
								</label>
							</div>
							<input type="submit" name="submit" class="btn btn-primary btn-block" value="Login">
							<br>
						
					</form>
					<div class="text-center">
						<a class="d-block small mt-3" href="<?= base_url()?>login/registration">Register an Account</a></br>
						<a class="d-block small" href="<?= base_url()?>login/forgot">Forgot Password?</a>
					</div>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->	
	

<script src="<?php echo base_url()?>assets/js/jquery-1.11.1.min.js"></script>
	<script src="<?php echo base_url()?>assets/js/bootstrap.min.js"></script>
  <!-- Bootstrap core JavaScript-->
  <!-- <script src="<?php echo base_url()?>assets/js/jquery.min.js"></script> -->
</body>

</html>
