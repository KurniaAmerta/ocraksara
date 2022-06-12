<body>
<!-- header -->
<hr>
<div class="container">
	<div class="row">
		<div class="col-sm-1">
			<a href="<?php echo base_url("memberMulai"); ?>" type="button" class="btn btn-warning btn-lg">&laquo;</a>
		</div>
		<div class="col-sm-11">
			<?php if(strpos(current_url(),'memberLatihan')!== false){ ?>
			<div class="d-flex justify-content-center"><h1>LATIHAN</h1></div>
			<?php } else{ ?>
				<div class="d-flex justify-content-center"><h1>KUIS</h1></div>
				<div class="d-flex justify-content-center"><h2 id="lp">Life Points</h2></div>
				<div class="d-flex justify-content-center"><h2 id="score">Score</h2></div>
			<?php } ?>
		</div>
	</div>
</div>
<hr>
<!-- header -->
<div class="container">
	<div class="col-sm d-flex justify-content-center">
		
		<h3 id="hurufs">Tuliskan Huruf</h3>
		
	</div>
</div>


<!-- menggambar -->
<style type="text/css">
	.paint-canvas {
	  /*border: 1px black solid;*/
	  display: block;
	  /*margin: 1rem;*/
	  background-color: blue;
	}

	.color-picker {
	  margin: 1rem 1rem 0 1rem;
	}
</style>
<!-- <div class="tools">
    <a href="#canvasOutput" data-tool="marker">Marker</a> <a href="#canvasOutput" data-tool="eraser">
        Eraser</a>
</div> -->
<div class="col-sm d-flex justify-content-center">
	<canvas class="js-paint  paint-canvas" id="canvasOutput" width="600" height="300"></canvas>
	<!-- <div id="go">[ CLICK/TAP TO DRAW ]</div> -->
</div>
	<div>
	<hr>
	<?php if(strpos(current_url(),'memberLatihan')!== false){ ?>
	<div class="col-sm d-flex justify-content-center">
		<label>Input Nilai k dari: </label>
		<input type="number" id="valueK" min="1" >
		<label>sampai: </label>
		<input type="number" id="valueKend" min="1">
	</div>
	<br>
	<div class="col-sm d-flex justify-content-center">
		<label>Input label yang Dibandingkan: </label>
		<select id="selectLabel">
		  <option value="ha" selected="">ha</option>
		<?php
			$allAksara = array("na", "ca", "ra", "ka", "da", "ta", "sa", "wa", "la", "ma", "ga", "ba", "nga", "pa", "ja", "ya", "nya", "ulu", "suku", "taling", "tedong", "pepet"); 
		for($i=0; $i<count($allAksara); $i++){ ?>
			<option value=<?php echo $allAksara[$i]; ?>><?php echo $allAksara[$i]; ?></option>
		<?php } ?>
		</select>
	</div>
<?php } else{ ?>
	<input type="hidden" id="valueK" value="5">
	<input type="hidden" id="valueKend" value="5">
<?php } ?>
</div>

<div class="container">
	<div class="row">
		<div class="col-sm-6">
			<div class="col-sm d-flex justify-content-center">
				<button type="button" id="hapus" class="btn btn-warning btn-lg" onclick="Hapus();">Hapus</button>
				<!-- <a class="btn btn-warning btn-lg" href="#canvasOutput" data-tool="eraser">Hapus</a> -->
			</div>
		</div>
		<div class="col-sm-6">
			<div class="col-sm d-flex justify-content-center">
				<button type="button" class="btn btn-warning btn-lg" onclick="Proses();">Periksa</button>
			</div>
		</div>
	</div>
</div>
<br>
<br>

<?php if(strpos(current_url(),'memberLatihan')!== false){ ?>
<div class="container">
	<div class="row">
		<div class="col-sm-6">
			<div class="col-sm d-flex justify-content-center">
				<button type="button" class="btn btn-success btn-lg" onclick="TampilkanProses(0);">Tampilkan Proses</button>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="col-sm d-flex justify-content-center">
				<button type="button" class="btn btn-success btn-lg" onclick="TampilkanProses(1);">Sembunyikan Proses</button>
			</div>
		</div>
	</div>
</div>
<?php } ?>

<hr>
<div id="hasilProses" style="display: none;">
	<div class="col-sm d-flex justify-content-center">
		<h4 style="margin-left: 50px; display: none;" id="titlePrepros">Preprocessing & Ekstraksi Fitur</h4>
	</div>
	<div class="col-sm d-flex justify-content-center">
		<br><canvas id="preproses" width="600" height="300" style="display: none;"></canvas>
	</div>
	<div class="col-sm d-flex justify-content-center">
		<table class="table table-striped" id="kesimpulan" style="display: none;">
			<thead class="thead-dark">
				<tr>
					<th rowspan="2">No</th>
					<th rowspan="2">Preprocessing</th>
					<th colspan="2">Ekstraksi Fitur</th>
					<th rowspan="2">Hasil Klasifikasi</th>
				</tr>
				<tr>
					<th>Diagonal</th>
					<th>Euler Number</th>
				</tr>
			</thead>
			<tbody>
				
			</tbody>
		</table>
	</div>
</div>
<div id="placehere"></div>

<script type="text/javascript">
	function TampilkanProses(nilai){
		if(nilai == 0){
			document.getElementById("hasilProses").style.display = "block";
		}else{
			document.getElementById("hasilProses").style.display = "none";
		}
	}
</script>

<script src="https://cdn.rawgit.com/mobomo/sketch.js/master/lib/sketch.min.js" type="text/javascript"></script>

<script type="text/javascript">
	
	var allAksara = ["na", "ca", "ra", "ka", "da", "ta", "sa", "wa", "la", "ma", "ga", "ba", "nga", "pa", "ja", "ya", "nya", "ulu", "suku", "taling", "tedong", "pepet"];
	var index = Math.floor(Math.random() * allAksara.length);
	var str = window.location.href;
	document.getElementById('hurufs').innerHTML = "Tuliskan Aksara Bali "+allAksara[index];
	var lp = 5;
	document.getElementById('lp').innerHTML = "Life Points "+lp;
	var score = 0;
	document.getElementById('score').innerHTML = "Score "+score;

	var dataReal = [];
	var dataCache = [];
	function CalculateDataReal(dataUji){
		dataReal = [];
		var areaData = "data10_"; //karena area data yang digunakan saat ini adalah 10x10
			// var jumlahPiksel = "0";
			// if(areaData == "0") areaData = "data5_";
			// else if(areaData == "1") areaData = "data10_";
			// else areaData = "data10_";
			// if(jumlahPiksel == "1") areaData = "l" + areaData;
		var batasData = 11; //jumlah data yang digunakan yaitu 10 responden dan 1 untuk aksara bali menggunakan bali simbar
		//if(areaData == "data10_" && jumlahPiksel == "0") batasData = 11;
		if(dataCache.length==0){ //jika belum ada data yang di cache, maka cache data tersebut
			//var indexData = 0;
			for(var indexData =1; indexData<=batasData; indexData++){
				//function ReadFile(indexData){
					//if(indexData>batasData) return;
					//var reader = new FileReader();
					//function readFile(indexData){
						//if(indexData>=batasData) return;
						//console.log("jumlah data:"+areaData+indexData+"*"+batasData);
						var file = "<?php echo base_url("asset/data/"); ?>"+areaData+indexData+".txt"; //mendapatkan direktori dari data latihh, karena data latih disimpan dalam bentuk file dengan format txt

						fetch(file)
						   .then( r => r.text() ) //mendapatkan berkas dari data latih yang kemudian diubah menjadi text
						   .then( t => addCacheData(t) ) //karena proses asychronus maka dipakai the tersebut jika sudah diubah ke text, maka fungsi addcache dijalankan
					}
					// var rawFile = new XMLHttpRequest();
				 //    rawFile.open("GET", "<?php echo base_url("asset/data/"); ?>"+areaData+indexData+".txt", false);
				     
				 //    rawFile.onreadystatechange = function ()
				 //    {
				 //        if(rawFile.readyState === 4)
				 //        {
				 //            if(rawFile.status === 200 || rawFile.status == 0)
				 //            {
				 			//reader.onload = function(e){
				 				function addCacheData(e){ //fungsi ini bertujuan untuk cache data
					                var allText = e; //data e merupakan string
					                var dataJson = JSON.parse(allText); //data string tersebut kemudian di parse sehingga membentuk data object
					                //console.log("jumlah data:"+dataJson['diagonal'].length);
					                for(var i=0; i<dataJson['diagonal'].length; i++){ //dari data object kita mabil panjang datanya
					                	var distanceCalculate=0; //inisialisasi untuk distance antara data latih dan data uji
					                	for(var j=0; j<dataUji.length; j++){
					                		distanceCalculate += Math.pow((dataUji[j]-dataJson['diagonal'][i][j]),2); //perhitungan menggunakan euclidean distance, bagian menjumlahkan dan mengkudaratkan antara data latih dan data uji
					                	}
					                	console.log("data uji");
					                	console.log(dataUji);
					                	console.log("data latih");
					                	console.log(dataJson['diagonal'][i]);
					                	distanceCalculate = Math.sqrt(distanceCalculate); //total data tersebut kemudian di akarkan
					                	//if(dataJson['euler'][i] == 0) console.log("ada");
					                	var realJson = { //mengubah data dari data latih dan hasil distance ke dalam bentuk object
					                		euler : dataJson['euler'][i],
					                		diagonal : dataJson['diagonal'][i],
					                		label : dataJson['label'][i],
					                		distance : distanceCalculate,
					                		index : indexData
					                	};
					                	dataReal.push(realJson); //data object tersebut ditambahkan dalam array
					                	
					                	var realJsonCache = { //data tanpa distance ditambahkan dalam array, data ini yang menjadi cache data
					                		euler : dataJson['euler'][i],
					                		diagonal : dataJson['diagonal'][i],
					                		label : dataJson['label'][i],
					                		index : indexData
					                	};
					                	dataCache.push(realJsonCache); //dataobject tersebut ditambahkan dalam array

					                	indexData++;
					                }
					                //console.log("check all:"+dataCache.length);
					                if(dataCache.length==2553){ //jika semua data sudah terkumpul maka dilakukan klasifikasi
					                	KNNDataLatih(); //data cache dicari distance antar data latih lainnya
					                	Klasifikasi(); //proses klasifikasi dijalankan
					                }
				                }
				                //ReadFile(indexData++);
				            //}
				            //reader.readAsBinaryString(file);
				        //     }
				        // }
				        //rawFile.send(null);
				        
				        //}
				    //}
			    //}
			    //readFile(1);
		    //}
		    
	    }else{ //jika data cahce sudah ada, cari jarak antara data latih dengan data uji
	    	for(var i=0; i<dataCache.length; i++){
	    		var distanceCalculate=0;
	        	for(var j=0; j<dataUji.length; j++){
	        		distanceCalculate += Math.pow((dataUji[j]-dataCache[i]['diagonal'][j]),2); //perhitungan menggunakan euclidean distance, bagian menjumlahkan dan mengkudaratkan antara data latih dan data uji
	        	}
	        	distanceCalculate = Math.sqrt(distanceCalculate);//total data tersebut kemudian di akarkan
	        	var realJson = {
	        		euler : dataCache[i]['euler'],
	        		diagonal : dataCache[i]['diagonal'],
	        		label : dataCache[i]['label'],
	        		distance : distanceCalculate,
	        		index : dataCache[i]['index']
	        	};
	    		dataReal.push(realJson);//data object tersebut ditambahkan dalam array
	    	}
	    	Klasifikasi();//proses klasifikasi dijalankan
	    }
    }

    function KNNDataLatih(){
    	for(var i = 0; i<dataCache.length; i++){ //perulangan dilakukan sepanjang data latih yang sudah di cache
    		var dataCacheDistance = [];
    		for(var j = 0; j<dataCache.length; j++){ //perulangan dilakukan sepanjang data latih yang sudah di cache
    			if(i!=j && dataCache[i]['euler'] == dataCache[j]['euler']){ //jarak anatara data latih dengan data latih lainnya dilakukan hanya dengan euler number yangs sama
    				var distanceResult =  0;
    				for(var k =0; k<dataCache[i]['diagonal'].length; k++){
    					distanceResult += Math.pow((dataCache[i]['diagonal'][k]-dataCache[j]['diagonal'][k]),2); //perhitungan menggunakan euclidean distance, bagian menjumlahkan dan mengkudaratkan antara data latih dan data uji
    				}
    				distanceResult = Math.sqrt(distanceResult);//total data tersebut kemudian di akarkan
    				var jsonDataCacheDistance = {
    					label : dataCache[j]['label'],
    					distance : distanceResult
    				};
    				dataCacheDistance.push(jsonDataCacheDistance);//data object tersebut ditambahkan dalam array
    			}
    		}
    		dataCacheDistance.sort(function(a,b){ //data object tersebut kemudian diurutkan dari data dengan distance terendah
    			return a['distance'] - b['distance'];
    		});
    		dataCache[i] = {
    			euler : dataCache[i]['euler'],
    			diagonal : dataCache[i]['diagonal'],
    			label : dataCache[i]['label'],
    			konektor : dataCacheDistance,
    			index : dataCache[i]['index']
    		}; //niali data cache, ditambahkan value baru berupa object, jadi object dalam object, yangisinya nilai euclidean distance beserta labelnya
    	}
    	//console.log("konektor");
    	//console.log(dataCache);
    }
</script>

<script type="text/javascript">

	// function shuffle(array) {
	//   var currentIndex = array.length, temporaryValue, randomIndex;

	//   // While there remain elements to shuffle...
	//   while (0 !== currentIndex) {

	//     // Pick a remaining element...
	//     randomIndex = Math.floor(Math.random() * currentIndex);
	//     currentIndex -= 1;

	//     // And swap it with the current element.
	//     temporaryValue = array[currentIndex];
	//     array[currentIndex] = array[randomIndex];
	//     array[randomIndex] = temporaryValue;
	//   }

	//   return array;
	// }

	var allResult = "<ul>";
	function Klasifikasi(){
		var nilaiK = parseInt(document.getElementById("valueK").value); // mendapatkan rentang nilai k awal
		var nilaiKend = parseInt(document.getElementById("valueKend").value); // mendapatkan rentang nilai k akhir
		if(nilaiK>nilaiKend){ //jika input rentang nilai k awal lebih besar dibandingkan nilai k akhir, proses diberhentikan
			Swal.fire({
			  icon: 'error',
			  title: 'Input Data',
			  text: "nilai k awal lebih besar dibandingkan nilai k akhir",
			});
			return;
		}else if(nilaiK == "" || nilaiKend == ""){ //jika input rentang nilai k awal dan k akhir kosong, proses diberhentikan
			Swal.fire({
			  icon: 'error',
			  title: 'Input Data',
			  text: "nilai k tidak boleh kosong",
			});
			return;
		}
		var i = firstData; // index data untuk hasil klasifikasi terakhir
		while(nilaiK<=nilaiKend){ // perulangan dari nilai k awal hingga akhir, sehingga klasifikasi dilakukan pada rentang k tersebut
			var result = [];
			var dataSeleksi = dataReal.filter(function(x){ return x['euler'] == allEuler[i]; } ); //menyisihkan data latih yang punya euler number yang sama dengan data uji
			if(nilaiKend > dataSeleksi.length){ //jika didapatkan nilai k akhir lebih besar dari data latih hasil yang disisihkan, maka proses berhenti
				Swal.fire({
				  icon: 'error',
				  title: 'Input Data',
				  text: "nilai k lebih besar dari data latih:"+dataSeleksi.length,
				});
				return;
			}
			dataSeleksi.sort(function(a,b){ //mengurutkan dari distance terpendek ke terpanjang dari data yang sudah disisihkan tersebut
				return a["distance"]-b["distance"];
			});

			//khusus untuk knn
			var resultKnn = [];
			for(var k=0; k<nilaiK; k++){
				var indexResultKnn = resultKnn.findIndex(element => element['label'] == dataSeleksi[k]['label']);//cek index didalam result	
				if(indexResultKnn == -1){ //jika belum ditemukan maka dimasukkan ke dalam index result dan diberi niali voting 1
					var hasil = {
						label : dataSeleksi[k]['label'],
						voting : 1
					};
					resultKnn.push(hasil);	
				} 
				else{ //jika sudah ditemukan maka kelas data atau label tersebut diberikan tambahan 1 voting
					resultKnn[indexResultKnn]['voting'] += 1;
				}
			} 
			resultKnn.sort(function(a,b){ //hasil diurutkan dari yang tertinggi votingnya ke yg terendah
				return b['voting']-a['voting'];
			});
			allResult += "<li><b>KNN</b> nilai k: "+nilaiK+", hasil: "+resultKnn[0]['label']+", bobot:"+JSON.stringify(resultKnn)+"</li>";
			
			//khusus untuk mknn
			for(var k=0; k<nilaiK; k++){
				var indexDataValid = dataCache.findIndex(element => element['index'] == dataSeleksi[k]['index']); //mendapatkan index dataseleksi pada data cache
				var valid = 0;
				for(var m=0; m<nilaiK; m++){
					if(dataSeleksi[k]['label']==dataCache[indexDataValid]['konektor'][m]['label']) valid++; //validasi dataseleksi dengan data cache yaitu konektor berdasarkan kesamaan label
				}
				valid = valid/nilaiK; //nilai valid merupakan total vlaidasi dibagi dengan jumlah nilai k
				var indexResult = result.findIndex(element => element['label'] == dataSeleksi[k]['label']); //sama seperti mknn tetapi perbedaanya pada voting juga dilakukan pembobotan
				if(indexResult == -1){
					var hasil = {
						label : dataSeleksi[k]['label'],
						bobot : valid*(1/(dataSeleksi[k]['distance'] + 0.5)) //rumus pembobotan
					};
					result.push(hasil);	
				} 
				else{
					result[indexResult]['bobot'] += valid*(1/(dataSeleksi[k]['distance'] + 0.5)); //rumus pembobotan yang dijumlahkan
				} 
			}
			result.sort(function(e,f){ //pengurutan nilai bobot dari terbesar ke terkecil
				return f["bobot"]-e["bobot"];
			});
			allResult += "<li><b>MKNN</b> nilai k: "+nilaiK+", hasil: "+result[0]['label']+", bobot:"+JSON.stringify(result)+"</li>";
			

			if(i == allDiagonal.length-1){
				if(!str.includes("memberKuis")){
					if(result[0]['label'] == document.getElementById("selectLabel").value){
						Swal.fire({
						  icon: 'success',
						  title: 'Input Data',
						  text: "Aksara yang anda tulisakan sama dengan "+document.getElementById("selectLabel").value,
						});
					}else{
						Swal.fire({
						  icon: 'error',
						  title: 'Input Data',
						  text: "Aksara yang anda tulisakan adalah "+result[0]['label']+" dan tidak sama dengan "+document.getElementById("selectLabel").value,
						});
					}
				}else{
					if(result[0]['label'] == allAksara[index]){
						Swal.fire({
						  icon: 'success',
						  title: 'Input Data',
						  text: "Aksara yang anda tulisakan sama dengan "+allAksara[index],
						});
						lp++;
						score++;
					}else{
						Swal.fire({
						  icon: 'error',
						  title: 'Input Data',
						  text: "Aksara yang anda tulisakan adalah "+result[0]['label']+" dan tidak sama dengan "+allAksara[index],
						});
						lp--;
					}
					document.getElementById('lp').innerHTML = "Life Points "+lp;
					index = Math.floor(Math.random() * allAksara.length);
					document.getElementById('hurufs').innerHTML = "Tuliskan Aksara Bali "+allAksara[index];
					document.getElementById('score').innerHTML = "Score "+score;
					Hapus();
					if(lp == 0){
						Swal.fire({
						  	title: '<strong>Selamat Score Anda '+score+'</strong>',
							  icon: 'info',
							  showCloseButton: false,
							  showCancelButton: false,
							  focusConfirm: false,
							  confirmButtonText:
							    '<a href="<?php echo base_url("memberKuis"); ?>">OK</a>',
							  confirmButtonAriaLabel: 'great!',
						});
					}
				}
			}
			nilaiK++;
		}
		document.getElementById("label"+(i+1)).innerHTML = allResult+"</ul>";
	}
</script>

<!-- operasi -->
<script type="text/javascript">
	function Hapus(){
		const canvas = document.getElementById("canvasOutput");
		const context = canvas.getContext('2d');
		context.clearRect(0, 0, canvas.width, canvas.height);
		context.beginPath();
		//$('#canvasOutput').sketch('actions',[]);
	}
	var allDiagonal = [];
	var allEuler = [];
	var cacheAllData = 0;
	var firstData = 0;
	function Proses(){
		//allDiagonal = [];
		//document.getElementById("kesimpulan").style.display = "block";
		document.getElementById("titlePrepros").style.display = "block";
		document.getElementById("preproses").style.display = "block";
		document.getElementById("kesimpulan").style.display = "block";

		//menghilangkan warna transparan
		var kanvas = document.getElementById("canvasOutput");
		var ctx = kanvas.getContext('2d');
		var imgData = ctx.getImageData(0,0,kanvas.width,kanvas.height);
		var gambar = zeros([kanvas.height,kanvas.width]);
		var j = 0;
		var k = 0;
		for (var i = 0; i < imgData.data.length; i+=4) {
		 	if(j==kanvas.width){
		 		j=0;
		 		k=k+1;
		 	}
		 	if(imgData.data[i+3] == 255) gambar[k][j] = 0;
		 	else gambar[k][j] = 255;
		 	j=j+1;
		}
		var kanvasTransparan = document.getElementById("preproses");
		kanvasTransparan.width = kanvas.width;
		kanvasTransparan.height = kanvas.height;
		var ctxTransparan = kanvasTransparan.getContext('2d');
		var imgDataTransparan = ctxTransparan.getImageData(0,0,kanvasTransparan.width,kanvasTransparan.height);
		j = 0;
		k = 0;
		for (var i = 0; i < imgDataTransparan.data.length; i+=4) {
		 	if(j==kanvasTransparan.width){
		 		j=0;
		 		k=k+1;
		 	}
		 	imgDataTransparan.data[i]=gambar[k][j];
		 	imgDataTransparan.data[i+1]=gambar[k][j];
		 	imgDataTransparan.data[i+2]=gambar[k][j];
		 	imgDataTransparan.data[i+3]=255;
		 	j=j+1;
		}
		ctxTransparan.putImageData(imgDataTransparan,0,0);
		
	   	hitamPutih(document.getElementById('preproses'));
	   	
	   	segmentasi(document.getElementById('preproses'));

	   	firstData = cacheAllData;
	   	for(var i=firstData; i<banyakKanvas; i++){
	   		var indeks =  "kanvas"+(i+1).toString();
	   		berhenti = 0;

   			ubahUkuran(document.getElementById(indeks),90,60);
   			document.getElementById("euler"+(firstData+1)).innerHTML = eulerNumber(document.getElementById(indeks),i+1);
   			allEuler.push(document.getElementById("euler"+(firstData+1)).innerHTML);

   			thinningImage(document.getElementById(indeks));

   			allDiagonal.push(diagonal(document.getElementById(indeks)));
   			document.getElementById("diagonal"+(i+1)).innerHTML = "<button class='btn btn-success' onclick=download_csv("+(i)+");>Unduh Ekstraksi Fitur Diagonal</button>";
   			cacheAllData++;
		}
		CalculateDataReal(allDiagonal[firstData]); //mengumpulkan data latih dan jika belum ada di cache, maka di cache agar proses selanjutnya lebih ringan
		//Klasifikasi();
	}	
</script>

<!-- menggambar -->
<!-- <script type="text/javascript">
$(document).ready(function()
{
	$("#canvasOutput").jqScribble();
});
</script> -->

<!-- <script type="text/javascript">
	const paintCanvas = document.getElementById('canvasOutput'); //document.querySelector( '.js-paint' );
const context = paintCanvas.getContext( '2d' );
context.lineCap = 'round';

// const colorPicker = document.querySelector( '.js-color-picker');

// colorPicker.addEventListener( 'change', event => {
//     context.strokeStyle = event.target.value; 
// } );

const lineWidthRange = document.querySelector( '.js-line-range' );
const lineWidthLabel = document.querySelector( '.js-range-value' );

// lineWidthRange.addEventListener( 'input', event => {
//     const width = event.target.value;
//     lineWidthLabel.innerHTML = width;
     context.lineWidth = 15;
// } );

let x = 0, y = 0;
let isMouseDown = false;

const stopDrawing = () => { isMouseDown = false; }
const startDrawing = event => {
    isMouseDown = true;   
   [x, y] = [event.offsetX, event.offsetY];  
}
const drawLine = event => {
    if ( isMouseDown ) {
        const newX = event.offsetX;
        const newY = event.offsetY;
        context.beginPath();
        context.moveTo( x, y );
        context.lineTo( newX, newY );
        context.stroke();
        //[x, y] = [newX, newY];
        x = newX;
        y = newY;
    }
}

paintCanvas.addEventListener( 'mousedown', startDrawing );
paintCanvas.addEventListener( 'touchstart', startDrawing );

paintCanvas.addEventListener( 'mousemove', drawLine );
paintCanvas.addEventListener( 'touchmove', drawLine );


paintCanvas.addEventListener( 'mouseup', stopDrawing );
paintCanvas.addEventListener( 'mouseout', stopDrawing );
paintCanvas.addEventListener( 'touchend', stopDrawing );
paintCanvas.addEventListener( 'touchcancel', stopDrawing );

</script> -->


<!-- <script type="text/javascript">
    $(function () {
        $('#canvasOutput').sketch();
        var c = document.getElementById("canvasOutput");
		var ctx = c.getContext("2d");
		ctx.lineWidth = 100;
        // $("#hapus").eq(0).attr("style", "color:#000");
        // $("#hapus").click(function () {
        //     $("#hapus").removeAttr("style");
        //     $(this).attr("style", "color:#000");
        // });
    });
</script> -->

<script type="text/javascript">
// Set up the canvas
var canvas = document.getElementById("canvasOutput");
var ctx = canvas.getContext("2d");
ctx.strokeStyle = "#000000";
ctx.lineWidth = 15;
ctx.lineCap = 'round';
  ctx.lineJoin = 'round';


	// Set up mouse events for drawing
var drawing = false;
var mousePos = { x:0, y:0 };
var lastPos = mousePos;
canvas.addEventListener("mousedown", function (e) {
        drawing = true;
  lastPos = getMousePos(canvas, e);
}, false);
canvas.addEventListener("mouseup", function (e) {
  drawing = false;
}, false);
canvas.addEventListener("mousemove", function (e) {
  mousePos = getMousePos(canvas, e);
}, false);

// Get the position of the mouse relative to the canvas
function getMousePos(canvasDom, mouseEvent) {
  var rect = canvasDom.getBoundingClientRect();
  return {
    x: mouseEvent.clientX - rect.left,
    y: mouseEvent.clientY - rect.top
  };
}


// Get a regular interval for drawing to the screen
window.requestAnimFrame = (function (callback) {
        return window.requestAnimationFrame || 
           window.webkitRequestAnimationFrame ||
           window.mozRequestAnimationFrame ||
           window.oRequestAnimationFrame ||
           window.msRequestAnimaitonFrame ||
           function (callback) {
        window.setTimeout(callback, 1000/60);
           };
})();

// Draw to the canvas
function renderCanvas() {
  if (drawing) {
    ctx.moveTo(lastPos.x, lastPos.y);
    ctx.lineTo(mousePos.x, mousePos.y);
    ctx.stroke();
    lastPos = mousePos;
  }
}

// Allow for animation
(function drawLoop () {
  requestAnimFrame(drawLoop);
  renderCanvas();
})();

// Set up touch events for mobile, etc
canvas.addEventListener("touchstart", function (e) {
        mousePos = getTouchPos(canvas, e);
  var touch = e.touches[0];
  var mouseEvent = new MouseEvent("mousedown", {
    clientX: touch.clientX,
    clientY: touch.clientY
  });
  canvas.dispatchEvent(mouseEvent);
}, false);
canvas.addEventListener("touchend", function (e) {
  var mouseEvent = new MouseEvent("mouseup", {});
  canvas.dispatchEvent(mouseEvent);
}, false);
canvas.addEventListener("touchmove", function (e) {
  var touch = e.touches[0];
  var mouseEvent = new MouseEvent("mousemove", {
    clientX: touch.clientX,
    clientY: touch.clientY
  });
  canvas.dispatchEvent(mouseEvent);
}, false);

// Get the position of a touch relative to the canvas
function getTouchPos(canvasDom, touchEvent) {
  var rect = canvasDom.getBoundingClientRect();
  return {
    x: touchEvent.touches[0].clientX - rect.left,
    y: touchEvent.touches[0].clientY - rect.top
  };
}

// Prevent scrolling when touching the canvas
document.body.addEventListener("touchstart", function (e) {
  if (e.target == canvas) {
    e.preventDefault();
  }
}, false);
document.body.addEventListener("touchend", function (e) {
  if (e.target == canvas) {
    e.preventDefault();
  }
}, false);
document.body.addEventListener("touchmove", function (e) {
  if (e.target == canvas) {
    e.preventDefault();
  }
}, false);
</script>

<script>
	function download_csv(indeks) {
		console.log(indeks);
		var data = allDiagonal[indeks];
		console.log(allDiagonal);
		console.log(data);
	    var csv = 'Data\n';
	    data.forEach(function(row) {
	            csv += row;
	            csv += "\n";
	    });
	 
	    console.log(csv);
	    var hiddenElement = document.createElement('a');
	    hiddenElement.href = 'data:text/csv;charset=utf-8,' + encodeURI(csv);
	    //hiddenElement.target = '_blank';
	    hiddenElement.download = 'diagonal.csv';
	    hiddenElement.click();
	}
</script>

<!-- <script type="text/javascript">
	document.ontouchmove = function(e){ e.preventDefault(); }

  var canvas  = document.getElementById('canvasOutput');
  var canvastop = canvas.offsetTop

  var context = canvas.getContext("2d");

  var lastx;
  var lasty;

  context.strokeStyle = "#000000";
  context.lineCap = 'round';
  context.lineJoin = 'round';
  context.lineWidth = 5;

  function clear() {
    context.fillStyle = "#ffffff";
    context.rect(0, 0, 300, 300);
    context.fill();
  }

  function dot(x,y) {
    context.beginPath();
    context.fillStyle = "#000000";
    context.arc(x,y,1,0,Math.PI*2,true);
    context.fill();
    context.stroke();
    context.closePath();
  }

  function line(fromx,fromy, tox,toy) {
    context.beginPath();
    context.moveTo(fromx, fromy);
    context.lineTo(tox, toy);
    context.stroke();
    context.closePath();
  }

  canvas.ontouchstart = function(event){                   
    event.preventDefault();                 
    
    lastx = event.touches[0].clientX;
    lasty = event.touches[0].clientY - canvastop;

    dot(lastx,lasty);
  }

  canvas.ontouchmove = function(event){                   
    event.preventDefault();                 

    var newx = event.touches[0].clientX;
    var newy = event.touches[0].clientY - canvastop;

    line(lastx,lasty, newx,newy);
    
    lastx = newx;
    lasty = newy;
  }


  // var clearButton = document.getElementById('clear')
  // clearButton.onclick = clear

  clear();
</script> -->