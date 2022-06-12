<body>
<!-- header -->
<hr>
<div class="container">
	<div class="row">
		<div class="col-sm-1">
			<a href="<?php echo base_url("memberMulai"); ?>" type="button" class="btn btn-warning btn-lg">&laquo;</a>
		</div>
		<div class="col-sm-11">
			<div class="d-flex justify-content-center"><h1>BELAJAR</h1></div>
		</div>
	</div>
</div>
<hr>
<!-- header -->
<div class="container">
	<div class="row">
		<?php
		$allAksara = array("HA", "NA", "CA", "RA", "KA", "DA", "TA", "SA", "WA", "LA", "MA", "GA", "BA", "NGA", "PA", "JA", "YA", "NYA", "ULU", "SUKU", "TALING", "TEDONG", "PEPET"); 
		for($i=0; $i<count($allAksara); $i++){ ?>
		<div class="col">
			<a href="<?php echo base_url("memberBelajarList/".$i); ?>" type="button" class="btn btn-warning btn-lg" style="width: 100%;"><h3><?php echo $allAksara[$i]; ?></h3></a>
			<br>
			<br>
			<br>
		</div>
		<?php } ?>
	</div>
</div>