<body>
<!-- header -->
<hr>
	<div class="d-flex justify-content-center"><h1>Game Edukasi</h1></div>
	<div class="d-flex justify-content-center"><h1>Aksara</h1></div>
	<div class="d-flex justify-content-center"><h1>Wreastra</h1></div>
<hr>
<!-- header -->

<div class="container">
	<div class="row">
		<div class="col-sm d-flex justify-content-center">
			<a href="<?php echo base_url("memberMulai"); ?>" type="button" class="btn btn-primary btn-lg"><h3>MULAI</h3></a>
		</div>
		<div class="col-sm d-flex justify-content-center">
			<button type="button" class="tentang btn btn-primary btn-lg"><h3>TENTANG</h3></button>
		</div>
		<!-- <div class="col-sm d-flex justify-content-center">
			<button type="button" class="btn btn-primary btn-lg" onclick="window.close();" ><h3>KELUAR</h3></button>
		</div> -->
	</div>
</div>

<script type="text/javascript">
	document.querySelector(".tentang").addEventListener('click', function(){ Swal.fire("Tentang", "Sistem ini merupakan OCR Aksara Bali yang bertujuan sebagai media pembelajaran Aksara Bali");});

	function Close(){
		window.close();
	}
</script>