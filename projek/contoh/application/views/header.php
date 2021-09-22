<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Lumino - Dashboard</title>
	<link href="<?= base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?= base_url() ?>assets/css/font-awesome.min.css" rel="stylesheet">
	<link href="<?= base_url() ?>assets/css/datepicker3.css" rel="stylesheet">
	<link href="<?= base_url() ?>assets/css/styles.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/css/bootstrab-table.css" rel="stylesheet">
	
	<!--Custom Font-->
	<link href="<?= base_url() ?>assets/css/fonts.css" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<!-- <a class="navbar-brand" href="#"><span>Lumino</span>Admin</a> -->
                <a class="navbar-brand" href="#">Web Management Web</a>
				<div style="color: white; padding: 15px 50px 5px 50px; float: right;font-size: 16px;"> 
                Last access : 30 May 2014 &nbsp; <a href="<?= base_url() ?>logout"class="btn btn-danger square-btn-adjust">
                <em class=" fa fa-power-off">&nbsp;</em> Logout</a> </div>
			</div>
		</div><!-- /.container-fluid -->
	</nav>
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <div class="profile-sidebar">
			<div class="profile-userpic">
				<img src="<?= base_url() ?>assets/img/poltek.png" class="img-responsive" alt="">
			</div>
			<div class="profile-usertitle">
                
				<div class="profile-usertitle-name">ADMIN</div>
				<div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
			</div>
			<div class="clear"></div>
		</div>
		</form>
		<ul class="nav menu">
            
			<li class="<?php if($this->uri->uri_string()=="dashboard"){echo "active";}?>"> <a  href="<?= base_url() ?>dashboard"><em class="glyphicon glyphicon-home">&nbsp;</em> Dashboard</a></li>
			<li class="<?php if($this->uri->uri_string()=="users"){echo "active";}?>"> <a  href="<?= base_url() ?>users"><em class="glyphicon glyphicon-user">&nbsp;</em> User Management</a></li>
			<li class="<?php if($this->uri->uri_string()=="vm"){echo "active";}?>"> <a  href="<?= base_url() ?>vm"><em class="glyphicon glyphicon-blackboard">&nbsp;</em> VM Management </a></li>
			<li class="<?php if($this->uri->uri_string()=="nodeserver"){echo "active";}?>" > <a href="<?= base_url() ?>nodeserver"><em class="glyphicon glyphicon-hdd">&nbsp;</em> Node Server </a></li>
            <li class="<?php if($this->uri->uri_string()=="ipblock"){echo "active";}?>"> <a href="<?= base_url() ?>ipblock"><em class="glyphicon glyphicon-th-large">&nbsp;</em> IP Block</a></li>
            <li class="<?php if($this->uri->uri_string()=="ipaddress"){echo "active";}?>" > <a href="<?= base_url() ?>ipaddress"><em class="glyphicon glyphicon-list">&nbsp;</em> IP Address</a></li>
			<li class="<?php if($this->uri->uri_string()=="service"){echo "active";}?>" > <a href="<?= base_url() ?>service"><em class="glyphicon glyphicon-gift">&nbsp;</em> Packages</a></li>


			<!-- <li><a href="login.html"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li> -->
		</ul>
	</div><!--/.sidebar-->
    <!--main-->
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
