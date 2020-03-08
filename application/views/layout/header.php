<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo $title; ?></title>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width,initial-scale=1.0"/>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/materialize.css">
	<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">

	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/materialize.js"></script>
	<script type="text/javascript" src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
	
	<style type="text/css">
		body {
		    display: flex;
		    min-height: 100vh;
		    flex-direction: column;
		  }

		  main {
		    flex: 1 0 auto;
		  }
    
	</style>
</head>
<body>
	<header>
		<nav>
			<div class="nav-wrapper">
				<a href="#" class="brand-logo" style="padding-left: 5px;">YTKaraoke</a>
				<ul id="nav-mobile" class="right hide-on-med-and-down">
					<li><a href="#">Users</a></li>
					<li><a href="#">Songs</a></li>
					<li><a href="#">Logout</a></li>
				</ul>
			</div>
		</nav>
	</header>
	