<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Management Content & Detail Redis</title>
	<link rel="stylesheet" href="">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="<?php echo base_url();?>assets/jquery/jquery-3.2.1.min.js"></script>
	<link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/custom.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/datatables/datatables.min.css">
	<script src="<?php echo base_url();?>assets/datatables/datatables.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/sweet/sweetalert.min.js" /></script>
	<script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>
	<link href="<?php echo base_url(); ?>assets/sweet/sweetalert.css" rel="stylesheet" type="text/css">
	<script src="<?php echo base_url(); ?>assets/sweet/sweetalert.min.js" /></script>
	<script defer src="<?php echo base_url(); ?>assets/font-awesome/svg-with-js/js/fontawesome-all.js"></script>
</head>
<body>
<div class="container">
	<form action="<?php echo base_url("Welcome")?>" method="POST" enctype="multipart/form-data">
		<br>
	<div class="row">
			<div class="form-group">
			<div class="col-md-4">
				<h1>Form API Article</h1>
			</div>
		</div>
	</div>
		<div class="row">
			<div class="form-group">
			<div class="col-md-4">
				<label for="">Username</label>
		<input type="text" class="form-control" name="username">
	</div>
</div>
</div>
<br>
	<div class="row">
			<div class="form-group">
			<div class="col-md-4">
				<label for="">Password</label>
		<input type="text" class="form-control" name="password">
	</div>
</div>
</div>
<br>

<br>

<br>
	<div class="row">
			<div class="form-group">
			<div class="col-md-4">
		<button type="submit" name="submit" class="btn btn-primary">Submit</button>
	</div>
</div>
</div>
	</form>
</div>

	<script type="text/javascript" src="<?php echo base_url().'assets/js/bootstrap.js'?>"></script>
</body>
</html>