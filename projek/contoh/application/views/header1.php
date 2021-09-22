<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Free Bootstrap Admin Template : Binary Admin</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="<?= base_url() ?>assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="<?= base_url() ?>assets/css/font-awesome.css" rel="stylesheet" />
    <!-- MORRIS CHART STYLES-->
    <link href="<?= base_url() ?>assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="<?= base_url() ?>assets/css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/js/dataTables/dataTables.bootstrap.css">
    
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html"><small><small><small>Web Management VPS</small></small></small></a> 
            </div>
            <div style="color: white; padding: 15px 50px 5px 50px; float: right;font-size: 16px;"> Last access : 30 May 2014 &nbsp; <a href="<?= base_url() ?>logout" class="btn btn-danger square-btn-adjust">Logout</a> </div>
        </nav>   
        <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li class="text-center">
                        <img src="<?= base_url() ?>assets/img/poltek.png" class="user-image img-responsive"/>
					</li>
                    <li> <a href="<?= base_url() ?>dashboard"><i class="fa fa-home fa-2x"></i> Dashboard</a> </li>
                    <li> <a href="<?= base_url() ?>users"><i class="glyphicon glyphicon-user fa-2x"></i> User Management</a> </li>
                    <li> <a href="<?= base_url() ?>vm"><i class="fa fa-laptop fa-2x"></i> VM Management</a> </li>
                    <li> <a href="<?= base_url() ?>nodeserver"><i class="glyphicon glyphicon-hdd fa-2x"></i> Node Server</a> </li>
                    <li> <a href="<?= base_url() ?>ipblock"><i class="glyphicon glyphicon-th-large fa-2x"></i> IP Block</a> </li>
                    <li> <a href="<?= base_url() ?>ipaddress"><i class="glyphicon glyphicon-list fa-2x"></i>IP Address</a> </li>
                </ul>
            </div>
        </nav>
        <!-- /. NAV SIDE  -->