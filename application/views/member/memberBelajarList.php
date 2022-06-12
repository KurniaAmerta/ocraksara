<body>
<!-- header -->
<?php
	$allAksara = array("HA", "NA", "CA", "RA", "KA", "DA", "TA", "SA", "WA", "LA", "MA", "GA", "BA", "NGA", "PA", "JA", "YA", "NYA", "ULU", "SUKU", "TALING", "TEDONG", "PEPET"); 
	$allTrueAksara = array("h", "n", "c", "r", "k", "d", "t", "s", "w", "l", "m", "g", "b", "\\", "p", "j", "y", "z", "i", "u", "e", "o", ")"); 
	?>
<hr>
<div class="container">
	<div class="row">
		<div class="col-sm-1">
			<a href="<?php echo base_url("memberBelajar"); ?>" type="button" class="btn btn-warning btn-lg">&laquo;</a>
		</div>
		<div class="col-sm-11">
			<div class="d-flex justify-content-center"><h1>BELAJAR</h1></div>
			<div class="d-flex justify-content-center"><h1 id='keterangan'>Tulisan Huruf <?php echo $allAksara[$pilihan]; ?> </h1></div>
		</div>
	</div>
</div>
<hr>
<!-- header  -->
<div class="container">
	<div class="d-flex justify-content-around">
		<div class="align-self-center">
			<button onclick="next(-1)" class="btn btn-success btn-lg" style="margin-right:100px;">Prev</button>
		</div>
			<h1 id="aksaras" style="font-size: 500px;" > <?php echo $allTrueAksara[$pilihan]; ?> </h1>
		<div class="align-self-center">
			<button onclick="next(1);" class="btn btn-success btn-lg" style="margin-left:100px;">Next</button>
		</div>
	</div>
</div>

<script type="text/javascript">
	var allAksara = ["HA", "NA", "CA", "RA", "KA", "DA", "TA", "SA", "WA", "LA", "MA", "GA", "BA", "NGA", "PA", "JA", "YA", "NYA", "ULU", "SUKU", "TALING", "TEDONG", "PEPET"]; 
	var allTrueAksaras = ["h", "n", "c", "r", "k", "d", "t", "s", "w", "l", "m", "g", "b", "\\", "p", "j", "y", "z", "i", "u", "e", "o", ")"]; 
	var allTrueAksara = parseInt('<?php echo count($allTrueAksara); ?>');
	var pilihan = parseInt('<?php echo $pilihan; ?>');
	function next(indeks){
		pilihan += indeks;
		if(pilihan<0) pilihan = allTrueAksara-1;
		else if(pilihan==allTrueAksara) pilihan = 0;
		document.getElementById("aksaras").innerHTML = allTrueAksaras[pilihan];
		document.getElementById("keterangan").innerHTML ="Tulisan Huruf "+allAksara[pilihan];
	}
</script>