<style type="text/css">
	.paint-canvas {
	  border: 1px black solid;
	  display: block;
	  margin: 1rem;
	  background-color: blue;
	}

	.color-picker {
	  margin: 1rem 1rem 0 1rem;
	}
</style>
<hr>
<h4 style="margin-left: 50px;">Form Input Data Latih</h4>
<div class="checkbox" style="margin-left: 75px;">
	<div class="form-row">
    	<div class="form-group col-md-3">
  			<label> Input File</label>
    		<input class="form-control" type="checkbox" data-toggle="toggle" data-on="Iya" data-off="Tidak" checked id="pilihan">
    	</div>
    </div>	
</div>
<form style="margin-left: 75px;">
	<div class="form-row">
	<div class="form-group col-md-3">
      <label>Nama Responden</label>
      <input type="text" class="form-control" id="namaResponden">
    </div>
    <div class="form-group col-md-3">
      <label>Label Data Latih</label>
      <select class="form-control" id="inputLabel">
	      <option value="ha" selected>Ha</option>
	      <option value="na">Na</option>
	      <option value="ca">Ca</option>
	      <option value="ra">Ra</option>
	      <option value="ka">Ka</option>
	      <option value="da">Da</option>
	      <option value="ta">Ta</option>
	      <option value="sa">Sa</option>
	      <option value="wa">Wa</option>
	      <option value="la">La</option>
	      <option value="ma">Ma</option>
	      <option value="ga">Ga</option>
	      <option value="ba">Ba</option>
	      <option value="nga">Nga</option>
	      <option value="pa">Pa</option>
	      <option value="ja">Ja</option>
	      <option value="ya">Ya</option>
	      <option value="nya">Nya</option>
	      <option value="ulu">Ulu</option>
	      <option value="suku">Suku</option>
	      <option value="taling">Taling</option>
	      <option value="tedong">Tedong</option>
	      <option value="pepet">pepet</option>
		</select>
    </div>
    <div class="form-group col-md-3" id="divInputFile" style="display: block;">
      <label>Gambar</label>
      <input type="file" class="form-control" id="inputGambar" accept="image/png,image/jpeg">
    </div>
    <div class="form-group col-md-3" id="divInputGambar" style="display: none;">
      <label>Gambar</label>
      <canvas class="js-paint  paint-canvas" id="canvasOutputInput" width="600" height="300"></canvas>
    </div>
  </div>
  <img id="imageSrc" alt="No Image">
</form>
<button class="btn btn-primary" onclick="Proses();" type="submit" style="margin-left: 75px;">Proses</button>

<hr>
<h4 style="margin-left: 50px;">Preprocessing & Ekstraksi Fitur</h4>
<canvas id="canvasOutput" style="display: none;"></canvas>
<br><canvas id="preproses" style="display: none;"></canvas>
<table class="table table-striped" id="kesimpulan" style="display: none;">
	<thead class="thead-dark">
		<tr>
			<th rowspan="2">No</th>
			<th rowspan="2">Preprocessing</th>
			<th colspan="2">Ekstraksi Fitur</th>
			<th rowspan="2">Label</th>
		</tr>
		<tr>
			<th>Diagonal</th>
			<th>Euler Number</th>
		</tr>
	</thead>
	<tbody>
		
	</tbody>
</table>
<div>
	<button class='btn btn-success' onclick="SetData();">Set Data</button><br><br>
	<a style="display: block;" class='btn btn-success' id="InputDatabase">Input ke Database</a>
</div>

<script type="text/javascript">
	var labelFile;
	let imgElement = document.getElementById('imageSrc');
	let inputElement = document.getElementById('inputGambar');
	inputElement.addEventListener('change', (e) => {
	      imgElement.src = URL.createObjectURL(e.target.files[0]);
	      var nameFile = inputElement.value;
	      nameFile = nameFile.split('\\');
	      nameFile = nameFile[nameFile.length-1];
	      nameFile = nameFile.split('.');
	      nameFile = nameFile[0];
	      nameFile = nameFile.split("_");
	      nameFile = nameFile[0];
	      console.log(nameFile);
	      labelFile = nameFile;
	      //console.log(inputElement.value);
	   	}, false);

	var allDiagonal = [];
	var allEuler = [];
	var allLabel = [];
	var cacheAllData = 0;
	function Proses(){
		var checked = document.getElementById("pilihan").checked; 
		if(document.getElementById("namaResponden").value != "" && (document.getElementById("inputGambar").files.length != 0 || !checked)){
			if(checked){
				//console.log("file");
				//allDiagonal = [];
				document.getElementById("canvasOutput").style.display = "block";
				document.getElementById("preproses").style.display = "block";
				document.getElementById("kesimpulan").style.display = "block";

				let mat = cv.imread(imgElement);
				cv.imshow('canvasOutput', mat);
				// Free memory 
		   		mat.delete();
			   	hitamPutih(document.getElementById('canvasOutput'));
			   	segmentasi(document.getElementById('preproses'));

			   	//histogramProjection(document.getElementById('preproses'));
			   	var firstData = cacheAllData;
			   	for(var i=firstData; i<banyakKanvas; i++){
			   		var indeks =  "kanvas"+(i+1).toString();
			   		berhenti = 0;
		   			ubahUkuran(document.getElementById(indeks),90,60);

		   			eulerNumber(document.getElementById(indeks),i+1);

		   			thinningImage(document.getElementById(indeks));

		   			var kanvasChosed = document.getElementById(indeks);

		   			allKanvasData.push(kanvasChosed.getContext('2d').getImageData(0,0,kanvasChosed.width,kanvasChosed.height));

		   			allDiagonal.push(diagonal(document.getElementById(indeks)));
	   			document.getElementById("diagonal"+(i+1)).innerHTML = "<button class='btn btn-success' onclick=download_csv("+(i)+");>Unduh Ekstraksi Fitur Diagonal</button>";

		   			//document.getElementById("label"+(i+1)).innerHTML = document.getElementById('inputLabel').value;
		   			allLabel.push(document.getElementById('inputLabel').value);

		   			//allEuler.push(parseInt(document.getElementById("euler"+(i+1)).innerHTML));
		   			//for label
		   			var idLabel = "Inputlabel"+(i+1);
		   			var idEuler = "Inputeuler"+(i+1);
		   			//console.log(document.getElementById(idLabel).value);
		   			document.getElementById(idLabel).value = labelFile;	
		   			if(labelFile == "na" || labelFile == "ka") document.getElementById(idEuler).value = "-1";
		   			else if(labelFile == "ca" || labelFile == "da" || labelFile == "sa" || labelFile == "suku" || labelFile == "pepet") document.getElementById(idEuler).value = "0";
		   			else document.getElementById(idEuler).value = "1";
		   			//for euler

		   			cacheAllData++;

		   			
				}
			}else{
				//allDiagonal = [];
				//document.getElementById("kesimpulan").style.display = "block";
				document.getElementById("preproses").style.display = "block";
				document.getElementById("kesimpulan").style.display = "block";

				//menghilangkan warna transparan
				var kanvas = document.getElementById("canvasOutputInput");
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
			   	
			   	//histogramProjection(document.getElementById('preproses'));

			   	segmentasi(document.getElementById('preproses'));

			   	allKanvasData = [];
			   	var firstData = cacheAllData;
			   	for(var i=firstData; i<banyakKanvas; i++){
			   		var indeks =  "kanvas"+(i+1).toString();
			   		berhenti = 0;
			   		console.log(indeks);
		   			//ubahUkuran(document.getElementById(indeks),60,90);
		   			ubahUkuran(document.getElementById(indeks),90,60);

		   			eulerNumber(document.getElementById(indeks),i+1);

		   			thinningImage(document.getElementById(indeks));

		   			//document.getElementById("label"+(i+1)).innerHTML = document.getElementById("inputLabel").value;
		   			allLabel.push(document.getElementById("inputLabel").value);
		   			//console.log(cacheAllData);
		   			//console.log(diagonal(document.getElementById(indeks)).values());
		   			console.log("id diagonal:"+indeks);
		   			allDiagonal.push(diagonal(document.getElementById(indeks)));
		   			document.getElementById("diagonal"+(i+1)).innerHTML = "<button class='btn btn-success' onclick=download_csv("+(i)+");>Unduh Ekstraksi Fitur Diagonal</button>";

		   			//allEuler.push(parseInt(document.getElementById("euler"+(i+1)).innerHTML));
		   			//post();
		   			var idLabel = "label"+(i+1);
		   			console.log(document.getElementById(idLabel).value);
		   			document.getElementById(idLabel).value = labelFile;	
		   			cacheAllData++;
				}		
			}
		}else{
			var dataKosong = "Input data";
			if(document.getElementById("namaResponden").value == "" && document.getElementById("inputGambar").files.length == 0) dataKosong += " nama dan gambar";
			else if(document.getElementById("namaResponden").value == "") dataKosong += " nama";
			else if(document.getElementById("inputGambar").files.length == 0) dataKosong += " gambar";
			dataKosong += " kosong";
			Swal.fire({
			  icon: 'error',
			  title: 'Input Data',
			  text: dataKosong,
			});
		}
	}
</script>

<script type="text/javascript">
	var allKanvasData = [];
	function SetData(){
		allEuler = [];
		allLabel = [];
		for(var i =1; i<=23; i++){
			var eulerVal = "Inputeuler"+i;
			var labelVal = "Inputlabel"+i;
		// 	console.log(eulerVal);
		// 	console.log(labelVal);
			allEuler.push(document.getElementById(eulerVal).value);
			allLabel.push(document.getElementById(labelVal).value);
		}
		var Data = {
			nama : document.getElementById("namaResponden").value,
			diagonal : allDiagonal,
			//kanvasData : allKanvasData,
			euler : allEuler, 
			label : allLabel
		};
		download("hello.txt",JSON.stringify(Data));
	}

function download(filename, text) {
	//console.log("testing"+text);
  var element = document.getElementById("InputDatabase");
  element.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(text));
  element.setAttribute('download', filename);

  //element.style.display = 'none';
  //document.body.appendChild(element);

  //element.click();

  //document.body.removeChild(element);
}

// Start file download.
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
	    hiddenElement.target = '_blank';
	    hiddenElement.download = 'diagonal.csv';
	    hiddenElement.click();
	}
</script>
<script type="text/javascript">
  	 $(function() {
    	$('#pilihan').change(function() {
    		if($(this).prop('checked')){
    			document.getElementById("divInputFile").style.display = "block";
    			document.getElementById("divInputGambar").style.display = "none";
    		}
    		else{
    			document.getElementById("divInputFile").style.display = "none";
    			document.getElementById("divInputGambar").style.display = "block";
    		}
    	})
  	})
</script>
<!-- menggambar -->
<script type="text/javascript">
	const paintCanvas = document.querySelector( '.js-paint' );
const context = paintCanvas.getContext( '2d' );
context.lineCap = 'round';
context.lineWidth = 10;

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
        x = newX;
        y = newY;
    }
}

paintCanvas.addEventListener( 'mousedown', startDrawing );
paintCanvas.addEventListener( 'mousemove', drawLine );
paintCanvas.addEventListener( 'mouseup', stopDrawing );
paintCanvas.addEventListener( 'mouseout', stopDrawing );
</script>
</body>