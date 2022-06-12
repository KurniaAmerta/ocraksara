//membuat array multi dimensi, digunakan seperti pada ektraksi fitur diagonal yang memerlukan array dengan baris 9 dan kolom 6
function zeros(dimensions){
	var array = [];
	for(var i=0; i<dimensions[0]; ++i){
		array.push(dimensions.length ==1 ? 0: zeros(dimensions.slice(1)));
	}
	return array;
}

//menbgubah gambar menjadi biner, karena pada javascript data gambar berupa r,g,b,a
function hitamPutih(kanvas){
	//ubah grayscale
	var ctx = kanvas.getContext('2d');
	var imgData = ctx.getImageData(0,0,kanvas.width,kanvas.height);

	var gambar = zeros([imgData.data.length/4]);
	for(var i=0; i<imgData.data.length; i+=4){
		gambar[i]=(imgData.data[i]+imgData.data[i+1]+imgData.data[i+2])/3; //ubah gambar menjadi warna grayscale, dengan merata-ratakan nilai r,g,b
		if(gambar[i]<=220){ //jika nilai rata rata tersebut kurang dari 220 atau rata rata pada nilai abu-abu, maka dia berwarna hitam atau foreground atau pada javascript bernilai 0;
			gambar[i]=0;
		}
		else{
			gambar[i]=255; // selain itu termasuk background atau pada javascript bernilai 255
		}
		imgData.data[i]=gambar[i]; //pada nilai r diberi nilai 0 jika dideteksi foreground seperti yang dijelaskan diatas dan 255 jika background
		imgData.data[i+1]=gambar[i]; //pada nilai g diberi nilai 0 jika dideteksi foreground seperti yang dijelaskan diatas dan 255 jika background
		imgData.data[i+2]=gambar[i]; //pada nilai b diberi nilai 0 jika dideteksi foreground seperti yang dijelaskan diatas dan 255 jika background
	}

	var preproses = document.getElementById("preproses");
	preproses.width = kanvas.width;
	preproses.height = kanvas.height;
	var ctxTab = preproses.getContext('2d');
	ctxTab.putImageData(imgData,0,0); //pemberian nilai tersebut kemudian di masukkan ke dalam image baru, dan jadilah image dengan warna hitam putih atau biner
}

//var banyakKanvas=0;

// function histogramProjection(kanvas){
// 	var ctx = kanvas.getContext('2d');
// 	var imgData = ctx.getImageData(0,0,kanvas.width,kanvas.height);
// 	var gambar = zeros([kanvas.height,kanvas.width]);
// 	var j = 0;
// 	var k = 0;
// 	for (var i = 0; i < imgData.data.length; i+=4) {
// 	 	if(j==kanvas.width){
// 	 		j=0;
// 	 		k=k+1;
// 	 	}
// 	 	gambar[k][j] = imgData.data[i];
// 	 	j=j+1;
// 	}
// 	//console.log(gambar);
// 	//step 1
// 	var barisAwal = [];
// 	var barisAkhir = [];
// 	var barisTotal = [];
// 	var barisRata = 0;
// 	var barisBuffer = 0;

// 	for(var m=0; m<kanvas.height; m++){
// 		var total = 0;
// 		for(var n=0; n<kanvas.width; n++){
// 			if(gambar[m][n]==0){
// 				total++;
// 			}	
// 		}
// 		if(barisBuffer==0 && total>0){
// 			barisBuffer = 1;
// 			barisAwal.push(m);
// 		}
// 		if(barisBuffer==1 && total==0){
// 			barisBuffer = 0;
// 			syarat = 0;
// 			barisAkhir.push(m-1);
// 		}
// 	}
// 	//console.log(total);
// 	//console.log(barisAkhir);
// 	//console.log(barisAwal);
// 	// for(var i=0; i<barisAwal.length; i++){
// 	// 	barisTotal.push(barisAkhir[i] - barisAwal[i]);
// 	// 	barisRata = barisRata + (barisAkhir[i] - barisAwal[i]);
// 	// }
// 	// barisRata = barisRata/barisTotal.length;
// 	for(var i=0; i<barisAwal.length; i++){
// 		barisTotal.push(barisAkhir[i] - barisAwal[i]);
// 		if(barisRata<barisAkhir[i] - barisAwal[i]){
// 			barisRata = barisAkhir[i] - barisAwal[i];
// 		}
// 	}
// 	barisRata = barisRata/2;
// 	//console.log(barisTotal);
// 	//console.log(barisRata);

// 	var barisAwalFix = [];
// 	var barisAkhirFix = [];
// 	for(var i=0; i<barisTotal.length; i++){
// 		if(barisTotal[i]>barisRata){
// 			barisAwalFix.push(barisAwal[i]);
// 			barisAkhirFix.push(barisAkhir[i]);
// 		}
// 		else{
// 			barisAwalFix.push(barisAwal[i]);
// 			barisAkhirFix.push(barisAkhir[i+1]);	
// 			i++;
// 		}
// 	}

// 	// console.log(barisAwalFix);
// 	// console.log(barisAkhirFix);

// 	// console.log(barisAwal);
// 	// console.log(barisAkhir);

// 	//step 2
// 	var kolomAwal = [];
// 	var kolomAkhir = [];
// 	for(var indeksBaris=0; indeksBaris<barisAwalFix.length; indeksBaris++){
// 		kolomAwal[indeksBaris] = [];
// 		kolomAkhir[indeksBaris] = [];
// 		var bufferKolom =0;
// 		for(var n=0; n<kanvas.width; n++){
// 			var total = 0;
// 			for(var m=barisAwalFix[indeksBaris]; m<=barisAkhirFix[indeksBaris]; m++){
// 				if(gambar[m][n]==0){
// 					total++;
// 				}
// 			}
// 			if(bufferKolom==0 && total>0){
// 				bufferKolom = 1;
// 				kolomAwal[indeksBaris].push(n);
// 			}
// 			else if(bufferKolom==1 && total==0){
// 				bufferKolom = 0;
// 				kolomAkhir[indeksBaris].push(n-1);
// 			}
// 		}
// 	}

// 	//step 3 draw
// 	//console.log(kolomAwal);
// 	//console.log(kolomAkhir);
// 	var indeksSeluruh = 0;
// 	for(var m=0; m<kolomAwal.length; m++){	
// 		var baris = [];
// 		var kolom = [];
// 		for(var n=0; n<kolomAwal[m].length; n++){
// 			kolom[0] = barisAwalFix[m]; 
// 			kolom[1] = barisAkhirFix[m];
// 			baris[0] = kolomAwal[m][n];
// 			baris[1] = kolomAkhir[m][n];
// 			banyakKanvas++;
// 			drawSegmen(banyakKanvas,gambar,baris,kolom);
// 		}
// 	}
// }

// function drawSegmen(idSegmen,gambar,minmaxB,minmaxK){
// 	loop1:
// 	for(var n=minmaxK[0]; n<=minmaxK[1]; n++){
// 		loop2:
// 		for(var m=minmaxB[0]; m<=minmaxB[1]; m++){
// 			if(gambar[n][m]==0){
// 				minmaxK[0] = n;
// 				break loop1;
// 			}
// 		}
// 	}
// 	loop1:
// 	for(var n=minmaxK[1]; n>=minmaxK[0]; n--){
// 		loop2:
// 		for(var m=minmaxB[0]; m<=minmaxB[1]; m++){
// 			if(gambar[n][m]==0){
// 				minmaxK[1] = n;
// 				break loop1;
// 			}
// 		}
// 	}
// 	var nilaiString =0;
// 	var segmen = document.createElement("CANVAS");
// 	segmen.width = minmaxB[1]-minmaxB[0]+1;
// 	segmen.height = minmaxK[1]-minmaxK[0]+1;
// 	segmen.id = "kanvas"+idSegmen;
// 	addRow(document.getElementById('kesimpulan'), idSegmen, segmen, '');

// 	var segmenCtx = segmen.getContext('2d');
// 	var segmenData = segmenCtx.getImageData(0,0,segmen.width,segmen.height);

// 	for(var i = 0; i < segmenData.data.length; i++){
// 		segmenData.data[i] = 255;
// 	}
// 	segmenCtx.putImageData(segmenData,0,0);

// 	var j=minmaxB[0];
// 	var k=minmaxK[0];
// 	var batasBaris=minmaxB[1];

// 	for (var i = 0; i < segmenData.data.length; i+=4) {
// 	 	if(j>batasBaris){
// 	 		j=minmaxB[0];
// 	 		k=k+1;
// 	 	}
// 	 	segmenData.data[i]=gambar[k][j];
// 	 	segmenData.data[i+1]=gambar[k][j];
// 	 	segmenData.data[i+2]=gambar[k][j];
// 	 	j=j+1;
// 	}
// 	segmenCtx.putImageData(segmenData,0,0);
// }

var banyakKanvas=0;

function segmentasi(kanvas){
	var ctx = kanvas.getContext('2d');
	var imgData = ctx.getImageData(0,0,kanvas.width,kanvas.height);

	//kanvas
	var gambar = zeros([kanvas.height+2,kanvas.width+2]);
	for(var m=0; m<kanvas.height+2; m++){
		for(var n=0; n<kanvas.width+2; n++){
			gambar[m][n]=255;
		}
	}
	var j = 1;
	var k = 1;
	for (var i = 0; i < imgData.data.length; i+=4) {
	 	if(j==kanvas.width+1){
	 		j=1;
	 		k=k+1;
	 	}
	 	gambar[k][j] = imgData.data[i];
	 	j=j+1;
	}

	//label
	var label = zeros([kanvas.height+2,kanvas.width+2]);

	var ekivalensi = [];
	var jenisLabel=0;
	var labelTerendah=[];
	for(var m=1; m<kanvas.height+1; m++){
		for(var n=1; n<kanvas.width+1; n++){
			if(gambar[m][n]==0){
				labelTerendah = [];
				if(label[m-1][n-1]==0&&label[m][n-1]==0&&label[m-1][n+1]==0&&label[m-1][n]==0){ //jika belum memiliki label maka berikan label baru
					jenisLabel+=1; //label terus bertambah
					label[m][n] = jenisLabel;
					var dataEkivalensi = {
						label : jenisLabel,
						ekivalen : jenisLabel,
					};
					ekivalensi.push(dataEkivalensi);
				}
				else{//cek tetanggga kiri, atas kiri, atas, dan atas kanan
					if(label[m-1][n]!=0){
						labelTerendah.push(label[m-1][n]);
					}
					if(label[m-1][n-1]!=0&&cekLabelTerendah(labelTerendah,label[m-1][n-1])==0){
						labelTerendah.push(label[m-1][n-1]);
					}
					if(label[m][n-1]!=0&&cekLabelTerendah(labelTerendah,label[m][n-1])==0){
						labelTerendah.push(label[m][n-1]);
					}
					if(label[m-1][n+1]!=0&&cekLabelTerendah(labelTerendah,label[m-1][n+1])==0){
						labelTerendah.push(label[m-1][n+1]);
					}
					//pilih label
					label[m][n] = pilihLabel(ekivalensi,labelTerendah); //dari seluruh label, pilih label dengan nilai ekivalensi terendah
					for(var i=0; i<labelTerendah.length; i++){
						if(labelTerendah[i]!=label[m][n]){ //ubah seluruh tetangga memakai ekivalensi terendah yang didapatkan
							var indexUbahEkivalensi = ekivalensi.findIndex(element => element.label == labelTerendah[i]);
							if(indexUbahEkivalensi!=-1){
								ekivalensi[indexUbahEkivalensi]["ekivalen"] = label[m][n];
							}
						}
					}
				}		
			}
		}
	}
	for(var i =0; i<ekivalensi.length; i++){
		var indexEkivalen = ekivalensi.findIndex(element => element.label == ekivalensi[i]['ekivalen']); //dicari nilai label yang sama dengan nilai ekivalensi
		if(ekivalensi[indexEkivalen]['ekivalen'] < ekivalensi[i]['ekivalen']){ //jika ekivalen dari label tersebut lebih rendah dari index ekivalensi
			ekivalensi[i]['ekivalen'] = ekivalensi[indexEkivalen]['ekivalen']; //maka index ekivalensi nilainya diubah dengan ekivalensi dari label tersebut
		}
	}
	for(var m=0; m<kanvas.height; m++){ //memberikan label pada seluruh piksel dengan nilai ekivalensinya
		for(var n=0; n<kanvas.width; n++){
			if(label[m][n]!=0){
				label[m][n] = ekivalensi.find(element => element.label == label[m][n])['ekivalen'];
			}
		}
	}

	var jumlahObjek=[];
	for(var i=0; i<ekivalensi.length; i++){ //mandapatkan jumlah objek
		var ada =0;
		for(var m=0; m<jumlahObjek.length; m++){
			if(jumlahObjek[m]==ekivalensi[i]['ekivalen']){
				ada =1;
			}
		}
		if(ada==0){
			jumlahObjek.push(ekivalensi[i]['ekivalen']);
		}
	}
	
	for(var i=0; i<jumlahObjek.length; i++){ //menggambarkan objek
		var pertama = 0;
		var baris = [];
		var kolom = [];
		for(var m=0; m<kanvas.height; m++){
			for(var n=0; n<kanvas.width; n++){
				if(label[m][n]==jumlahObjek[i]&&pertama==0){
					baris[0]=baris[1]=n;
					kolom[0]=kolom[1]=m;
					pertama=1;
				}
				else if(label[m][n]==jumlahObjek[i]&&pertama==1){
					if(baris[0]>n){
						baris[0]=n;	
					}
					if(kolom[0]>m){
						kolom[0]=m;
					}
					if(baris[1]<n){
						baris[1]=n;
					}
					if(kolom[1]<m){
						kolom[1]=m;
					}	
				}
			}
		}
		banyakKanvas++;
		drawSegmen(banyakKanvas,gambar,baris,kolom);
	}
}

function cekLabelTerendah(labelTerendah,label){
	var sudah =0;
	for(var i=0; i<labelTerendah.length; i++){
		if(label==labelTerendah[i]){
			sudah =1;
		}
	}
	return sudah;
}

function pilihLabel(ekivalensi, labelTerendah){
	var pilih = ekivalensi.find(element => element.label == labelTerendah[0])['ekivalen'];
	for(var i=1; i<labelTerendah.length; i++){
		if(pilih>ekivalensi.find(element => element.label == labelTerendah[i])['ekivalen']){
			pilih = ekivalensi.find(element => element.label == labelTerendah[i])['ekivalen'];
		}
	}
	return pilih;
}

var idKanvas = [];
function drawSegmen(idSegmen,gambar,minmaxB,minmaxK){
		idKanvas.push(idSegmen);
		var segmen = document.createElement("CANVAS");
		segmen.width = minmaxB[1]-minmaxB[0]+1;
		segmen.height = minmaxK[1]-minmaxK[0]+1;
		segmen.id = "kanvas"+idSegmen;
		addRow(document.getElementById('kesimpulan'), idSegmen,segmen, '');

		var segmenCtx = segmen.getContext('2d');
		var segmenData = segmenCtx.getImageData(0,0,segmen.width,segmen.height);

		for(var i = 0; i < segmenData.data.length; i++){
			segmenData.data[i] = 255;
		}
		segmenCtx.putImageData(segmenData,0,0);

		var j=minmaxB[0];
		var k=minmaxK[0];
		var batas =0;
		for (var i = 0; i < segmenData.data.length; i+=4) {
		 	if(batas==segmen.width){
		 		j=minmaxB[0];
		 		k=k+1;
		 		batas =0;
		 	}
		 	segmenData.data[i]=gambar[k][j];
		 	segmenData.data[i+1]=gambar[k][j];
		 	segmenData.data[i+2]=gambar[k][j];
		 	j=j+1;
		 	batas=batas+1;
		}
		segmenCtx.putImageData(segmenData,0,0);
}

function ubahUkuran(kanvas,lebar,tinggi){
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
	 	gambar[k][j] = imgData.data[i];
	 	j=j+1;
	}

	var gambarResize = zeros([tinggi,lebar]);
	for(var m=0; m<tinggi; m++){
		for(var n=0; n<lebar; n++){
			gambarResize[m][n] = gambar[Math.floor(m*(kanvas.height/tinggi))][Math.floor(n*(kanvas.width/lebar))];
		}
	}

	kanvas.width = lebar;
	kanvas.height = tinggi;

	var resizeCtx = kanvas.getContext('2d');
	var resizeData = resizeCtx.getImageData(0,0,kanvas.width,kanvas.height);		

	for(var i = 0; i < resizeData.data.length; i++){
		resizeData.data[i] = 255;
	}
	ctx.putImageData(resizeData,0,0);

	j=0;
	k=0;
	for (var i = 0; i < resizeData.data.length; i+=4) {
	 	if(j==kanvas.width){
	 		j=0;
	 		k=k+1;
	 	}
	 	resizeData.data[i]=gambarResize[k][j];
	 	resizeData.data[i+1]=gambarResize[k][j];
	 	resizeData.data[i+2]=gambarResize[k][j];
	 	j=j+1;
	}
	resizeCtx.putImageData(resizeData,0,0);
}

var berhenti =0;
function thinningImage(kanvas){
	var ctx = kanvas.getContext('2d');
	var imgData = ctx.getImageData(0,0,kanvas.width,kanvas.height);

	var gambar = zeros([kanvas.height+2,kanvas.width+2]);
	for(var m=0; m<kanvas.height+2; m++){
		for(var n=0; n<kanvas.width+2; n++){
			gambar[m][n]=255;
		}
	}
	var j = 1;
	var k = 1;
	for (var i = 0; i < imgData.data.length; i+=4) {
	 	if(j==kanvas.width+1){
	 		j=1;
	 		k=k+1;
	 	}
	 	gambar[k][j] = imgData.data[i];
	 	j=j+1;
	}
	while(berhenti==0){
		step1(gambar,kanvas.height+2,kanvas.width+2);
		step2(gambar,kanvas.height+2,kanvas.width+2);
	}

	j = 1;
	k = 1;
	for (var i = 0; i < imgData.data.length; i+=4) {
	 	if(j==kanvas.width+1){
	 		j=1;
	 		k=k+1;
	 	}
	 	imgData.data[i]=gambar[k][j];
	 	imgData.data[i+1]=gambar[k][j];
	 	imgData.data[i+2]=gambar[k][j];
	 	j=j+1;
	}ctx.putImageData(imgData,0,0);
}

function step1(gambar,tinggi,lebar){
	berhenti=1;
	var duplikasi = zeros([tinggi,lebar]);
	for(var m=0; m<tinggi; m++){
		for(var n=0; n<lebar; n++){
			duplikasi[m][n]=gambar[m][n];
		}
	}
	for(var m=1; m<tinggi-1; m++){
		for(var n=1; n<lebar-1; n++){
			if(gambar[m][n]==0){
				if(konektivitas(gambar,m,n)==1){
					if(tetangga(gambar,m,n)>=2&&tetangga(gambar,m,n)<=6){
						if(gambar[m][n+1]==255||gambar[m-1][n]==255||gambar[m][n-1]==255){
							if(gambar[m-1][n]==255||gambar[m+1][n]==255||gambar[m][n-1]==255){
								duplikasi[m][n]=255;
								berhenti=0;	
							}
						}
					}
				}
			}
		}
	}
	for(var m=0; m<tinggi; m++){
		for(var n=0; n<lebar; n++){
			gambar[m][n]=duplikasi[m][n];
		}
	}
}

function step2(gambar,tinggi,lebar){
	berhenti=1;
	var duplikasi = zeros([tinggi,lebar]);
	for(var m=0; m<tinggi; m++){
		for(var n=0; n<lebar; n++){
			duplikasi[m][n]=gambar[m][n];
		}
	}
	for(var m=1; m<tinggi-1; m++){
		for(var n=1; n<lebar-1; n++){
			if(gambar[m][n]==0){
				if(konektivitas(gambar,m,n)==1){
					if(tetangga(gambar,m,n)>=2&&tetangga(gambar,m,n)<=6){
						if(gambar[m-1][n]==255||gambar[m][n+1]==255||gambar[m+1][n]==255){
							if(gambar[m][n+1]==255||gambar[m+1][n]==255||gambar[m][n-1]==255){
								duplikasi[m][n]=255;
								berhenti=0;	
							}
						}
					}
				}
			}
		}
	}
	for(var m=0; m<tinggi; m++){
		for(var n=0; n<lebar; n++){
			gambar[m][n]=duplikasi[m][n];
		}
	}
}

function konektivitas(gambar,m,n){
	var nilai=0;
	if(gambar[m-1][n]==255 && gambar[m-1][n+1]==0){
		nilai++;
	}
	if(gambar[m-1][n+1]==255 && gambar[m][n+1]==0){
		nilai++;
	}
	if(gambar[m][n+1]==255 && gambar[m+1][n+1]==0){
		nilai++;
	}
	if(gambar[m+1][n+1]==255 && gambar[m+1][n]==0){
		nilai++;
	}
	if(gambar[m+1][n]==255 && gambar[m+1][n-1]==0){
		nilai++;
	}
	if(gambar[m+1][n-1]==255 && gambar[m][n-1]==0){
		nilai++;
	}
	if(gambar[m][n-1]==255 && gambar[m-1][n-1]==0){
		nilai++;
	}
	if(gambar[m-1][n-1]==255 && gambar[m-1][n]==0){
		nilai++;		
	}
	return nilai;
}

function tetangga(gambar,m,n){
 	var nilai=0;
 	if(gambar[m][n+1]==0){
 		nilai+=1;
 	}
 	if(gambar[m-1][n+1]==0){
 		nilai+=1;
 	}
 	if(gambar[m-1][n]==0){
 		nilai+=1;
 	}
 	if(gambar[m-1][n-1]==0){
 		nilai+=1;
 	}
 	if(gambar[m][n-1]==0){
 		nilai+=1;
 	}
 	if(gambar[m+1][n-1]==0){
 		nilai+=1;
 	}
 	if(gambar[m+1][n]==0){
 		nilai+=1;
 	}
 	if(gambar[m+1][n+1]==0){
		nilai+=1; 		
 	}
 	return nilai;
}