<!DOCTYPE html>
<html lang="en">

	<head>
	  <meta charset="utf-8">
	  <meta http-equiv="X-UA-Compatible" content="IE=edge">
	  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	  <meta name="description" content="">
	  <meta name="author" content="">
	  <title>Web Management VPS</title>

	  <link href="<?= base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet">
		<link href="<?= base_url() ?>assets/css/font-awesome.min.css" rel="stylesheet">
		<link href="<?= base_url() ?>assets/css/datepicker3.css" rel="stylesheet">
		<link href="<?= base_url() ?>assets/css/styles.css" rel="stylesheet">
	</head>
	<body class="bg-login">
		<div class="row">
			<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
				<div class="login-panel panel panel-default">
					<div class="panel-heading">New Password</div>
					<center><?php echo $error?></center>
					<div class="panel-body">
		        <form method="post" action="<?= base_url('login/updatenewpass')?>">
							<fieldset>
								<div class="form-group">
			            <label for="exampleInputEmail1">Password Baru</label>
			            <input class="form-control" type="hidden" value="<?= $email ?>" name="email" required>
			            <input class="form-control" type="password" placeholder="Password Baru" name="pass" required>
			          </div>
			          <input type="submit" name="submit" class="btn btn-primary btn-block" value="New Password">
							</fieldset>
								
						</form>
		        <div class="text-center">
          		<a class="d-block small mt-3" href="<?= base_url()?>login">Login</a>
		        </div>
					</div>
				</div>
			</div><!-- /.col-->
		</div><!-- /.row -->	
	

		<script src="<?php echo base_url()?>assets/js/jquery-1.11.1.min.js"></script>
		<script src="<?php echo base_url()?>assets/js/bootstrap.min.js"></script>
 
	</body>

</html>
