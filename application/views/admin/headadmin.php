<!DOCTYPE html>
<html>
<head>
	<title>OCR Aksara Bali Admin</title>

	<script src="<?php echo base_url("asset/opencv.js"); ?>" type="text/javascript"></script>
	<script src="<?php echo base_url("asset/sweetalert2.all.min.js"); ?>" type="text/javascript"></script>
	<script src="<?php echo base_url("asset/jquery.min.js"); ?>" type="text/javascript"></script>

  <script src="<?php echo base_url("asset/latih/preprosesLatih.js"); ?>" type="text/javascript"></script>
  <script src="<?php echo base_url("asset/latih/ekstraksiFiturLatih.js"); ?>" type="text/javascript"></script>
  <script src="<?php echo base_url("asset/latih/buatTables.js"); ?>" type="text/javascript"></script>

	<link rel="stylesheet" type="text/css" href="<?php echo base_url("asset/bootstrap/css/bootstrap.min.css"); ?>">
	<script src="<?php echo base_url("asset/bootstrap/js/bootstrap.min.js"); ?>" type="text/javascript"></script>

  <link rel="stylesheet" type="text/css" href="<?php echo base_url("asset/bootstrap-toggle/css/bootstrap4-toggle.min.css"); ?>">
  <script src="<?php echo base_url("asset/bootstrap-toggle/js/bootstrap4-toggle.min.js"); ?>" type="text/javascript"></script>  

  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<nav class="navbar navbar-expand-sm bg-primary navbar-dark">
  <ul class="navbar-nav">
    <li class="nav-item active">
      <a class="nav-link" href="#"><h4>Input Data Latih</h4></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#"><h4>Hapus Data Latih</h4></a>
    </li>
  </ul>
</nav>