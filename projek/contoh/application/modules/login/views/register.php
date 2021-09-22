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
				<div class="panel-heading card-header">Register Account</div>
				<center><?php echo $error?></center>
				<div class="panel-body">
        <form method="post" action="<?=base_url()?>login/registration">
						<fieldset>
							<div class="form-group">
		            <label for="">Nama</label>
		            <input class="form-control" type="text" placeholder="Nama" name="nama" required>
		          </div>
		          <div class="form-group">
		            <label for="exampleInputEmail1">Email address</label>
		            <input class="form-control" type="text" aria-describedby="emailHelp" placeholder="Email Address" name="email" required>
		          </div>
		          <div class="form-group">
		            <label for="">NIM/NIP</label>
		            <input class="form-control" type="text" placeholder="NIM/NIP" name="no_induk" required>
		          </div>
		          <div class="form-group">
		            <label for="">User Type</label>
		            <select name="user_type" id="" class="form-control" required>
		              <option value="">-Pilih User Type-</option>
		              <option value="Dosen">Dosen</option>
		              <option value="Mahasiswa">Mahasiswa</option>
		            </select>
		          </div>
		          <div class="form-group">
		            <label for="exampleInputPassword1">Password</label>
		            <input class="form-control" id="exampleInputPassword1" type="password" placeholder="Password" name="password" required>
		          </div>
		          <input type="submit" name="submit" class="btn btn-primary btn-block" value="Register">
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
  <!-- Bootstrap core JavaScript-->
  <!-- <script src="<?php echo base_url()?>assets/js/jquery.min.js"></script> -->
</body>

</html>
