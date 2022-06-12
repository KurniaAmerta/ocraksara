<!DOCTYPE html>
<html>
<head>
	<title>OCR Aksara Bali</title>

	<script src="<?php echo base_url("asset/opencv.js"); ?>" type="text/javascript"></script>
	<script src="<?php echo base_url("asset/sweetalert2.all.min.js"); ?>" type="text/javascript"></script>
	<script src="<?php echo base_url("asset/jquery.min.js"); ?>" type="text/javascript"></script>

	<script src="<?php echo base_url("asset/latih/preprosesLatih.js"); ?>" type="text/javascript"></script>
  	<script src="<?php echo base_url("asset/latih/ekstraksiFiturLatih.js"); ?>" type="text/javascript"></script>
  	<script src="<?php echo base_url("asset/latih/buatTablesAdmin.js"); ?>" type="text/javascript"></script>

	<link rel="stylesheet" type="text/css" href="<?php echo base_url("asset/bootstrap/css/bootstrap.min.css"); ?>">
	<script src="<?php echo base_url("asset/bootstrap/js/bootstrap.min.js"); ?>" type="text/javascript"></script>

	<!-- <script src="<?php echo base_url("asset/jquery.jqscribble.js"); ?>" type="text/javascript"></script> -->

	<style type="text/css">
		@font-face {
		  font-family: 'AksaraBali';
		  /*font-style: normal;*/
		  /*font-weight: 400;*/
		  src: url("<?php echo base_url("asset/b_simbar.ttf"); ?>");
		  /*unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;*/
		}
		#aksaras {
		  font-family: AksaraBali;
		}
	</style>
</head>