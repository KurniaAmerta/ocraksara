var lubang = 0;
function eulerNumber(kanvas,indeks) {
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

	var nilaiPoint = [];
	nilaiPoint = nilaiVertex(gambar,kanvas);
	lubang = 0;
	lubang = Math.round((nilaiPoint[0]-nilaiPoint[1])/4);

	return lubang;
}

function nilaiVertex(gambar, kanvas){
	var vertex = [];

	var point1 = 0;
	var point3 = 0;

	for(var m=1; m<kanvas.height+1; m++){
		for(var n=1; n<kanvas.width+1; n++){
			if(gambar[m][n]==0){
				if(gambar[m][n-1]!=0&&gambar[m-1][n]!=0){
					point1++;		
				}


				if(gambar[m-1][n]!=0&&gambar[m][n+1]!=0){
					point1++;		
				}


				if(gambar[m][n+1]!=0&&gambar[m+1][n]!=0){
					point1++;		
				}


				if(gambar[m+1][n]!=0&&gambar[m][n-1]!=0){
					point1++;		
				}
			}
			else{
				if(gambar[m][n-1]!=255&&gambar[m-1][n]!=255){
					point3++;		
				}


				if(gambar[m-1][n]!=255&&gambar[m][n+1]!=255){
					point3++;		
				}
				
				if(gambar[m][n+1]!=255&&gambar[m+1][n]!=255){
					point3++;		
				}

				if(gambar[m+1][n]!=255&&gambar[m][n-1]!=255){
					point3++;		
				}
			}
		}
	}

	vertex[0] = point1;
	vertex[1] = point3;

	return vertex;
}

function diagonal(kanvas){
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
	return hitungDiagonal(gambar,kanvas);
}

var nilai=zeros([69]);
function hitungDiagonal(gambar,kanvas){
	nilai=zeros([69]);
	var area = -1;
	for(var m=0; m<kanvas.height; m+=10){
		for(var n=0; n<kanvas.width; n+=10){
			area++;

			var batasX = n+10;
			var batasY = m+10;
			
			for(var i=n; i<batasX; i++){
				var y = m;
				var x = i;
				var pembagi =0;
				var jumlahHitam = 0;
				while(x>=n&&y<batasY){
					if(gambar[y][x]==0){
						jumlahHitam++;
					}
					x--;
					y++;
					pembagi++;
				}
				nilai[area] += (jumlahHitam/pembagi);
			}
			for(var i=m+1; i<batasY; i++){
				var y = i;
				var x = batasX-1;
				var pembagi =0;
				var jumlahHitam = 0;
				while(x>=n&&y<batasY){
					if(gambar[y][x]==0){
						jumlahHitam++;
					}
					x--;
					y++;
					pembagi++;
				}
				nilai[area] += (jumlahHitam/pembagi);
			}
			nilai[area]=nilai[area]/19;
			
		}
	}
	for(var i=0; i<54; i+=9){
		area++;
		for(var j=0; j<9; j++){
			nilai[area]+=nilai[i+j];
		}
		nilai[area]=nilai[area]/9;
	}
	for(var i=0; i<9; i++){
		area++;
		for(var j=0; j<54;j+=9){
			nilai[area]+=nilai[i+j];
		}
		nilai[area]=nilai[area]/6;
	}

	return nilai;
}

function hitungDiagonal5(gambar,kanvas){
	nilai=zeros([246]);
	var area = -1;
	for(var m=0; m<kanvas.height; m+=5){
		for(var n=0; n<kanvas.width; n+=5){
			area++;

			var batasX = n+5;
			var batasY = m+5;
			
			for(var i=n; i<batasX; i++){
				var y = m;
				var x = i;
				var pembagi =0;
				var jumlahHitam = 0;
				while(x>=n&&y<batasY){
					if(gambar[y][x]==0){
						jumlahHitam++;
					}else{
					}
					x--;
					y++;
					pembagi++;
				}
				nilai[area] += (jumlahHitam/pembagi);
			}
			for(var i=m+1; i<batasY; i++){
				var y = i;
				var x = batasX-1;
				var pembagi =0;
				var jumlahHitam = 0;
				while(x>=n&&y<batasY){
					if(gambar[y][x]==0){
						jumlahHitam++;
					}else{
					}
					x--;
					y++;
					pembagi++;
				}
				nilai[area] += (jumlahHitam/pembagi);
			}
			nilai[area]=nilai[area]/9;
			
		}
	}
	for(var i=0; i<216; i+=18){
		area++;
		for(var j=0; j<18; j++){
			nilai[area]+=nilai[i+j];
		}
		nilai[area]=nilai[area]/18;
	}
	for(var i=0; i<18; i++){
		area++;
		for(var j=0; j<216;j+=18){
			nilai[area]+=nilai[i+j];
		}
		nilai[area]=nilai[area]/12;
	}

	return nilai;
}

function hitungDiagonal15(gambar,kanvas){
	nilai=zeros([34]);
	var area = -1;
	for(var m=0; m<kanvas.height; m+=15){
		for(var n=0; n<kanvas.width; n+=15){
			area++;

			var batasX = n+15;
			var batasY = m+15;
			
			for(var i=n; i<batasX; i++){
				var y = m;
				var x = i;
				var pembagi =0;
				var jumlahHitam = 0;
				while(x>=n&&y<batasY){
					if(gambar[y][x]==0){
						jumlahHitam++;
					}else{
					}
					x--;
					y++;
					pembagi++;
				}
				nilai[area] += (jumlahHitam/pembagi);
			}
			for(var i=m+1; i<batasY; i++){
				var y = i;
				var x = batasX-1;
				var pembagi =0;
				var jumlahHitam = 0;
				while(x>=n&&y<batasY){
					if(gambar[y][x]==0){
						jumlahHitam++;
					}else{
					}
					x--;
					y++;
					pembagi++;
				}
				nilai[area] += (jumlahHitam/pembagi);
			}
			nilai[area]=nilai[area]/29;
			
		}
	}
	for(var i=0; i<24; i+=6){
		area++;
		for(var j=0; j<6; j++){
			nilai[area]+=nilai[i+j];
		}
		nilai[area]=nilai[area]/6;
	}
	for(var i=0; i<6; i++){
		area++;
		for(var j=0; j<24;j+=6){
			nilai[area]+=nilai[i+j];
		}
		nilai[area]=nilai[area]/4;
	}

	return nilai;
}

function hitung2Diagonal(gambar,kanvas){
	nilai=zeros([69]);
	var area = -1;
	for(var m=0; m<kanvas.height; m+=10){
		for(var n=0; n<kanvas.width; n+=10){
			area++;

			var batasX = n+10;
			var batasY = m+10;
			
			for(var i=n; i<batasX; i++){
				var y = m;
				var x = i;
				var pembagi =0;
				var jumlahHitam = 0;
				while(x>=n&&y<batasY){
					if(gambar[y][x]==0){
						jumlahHitam++;
					}else{
					}
					x--;
					y++;
					pembagi++;
				}
				nilai[area] += (jumlahHitam/pembagi);
			}
			for(var i=m+1; i<batasY; i++){
				var y = i;
				var x = batasX-1;
				var pembagi =0;
				var jumlahHitam = 0;
				while(x>=n&&y<batasY){
					if(gambar[y][x]==0){
						jumlahHitam++;
					}else{
					}
					x--;
					y++;
					pembagi++;
				}
				nilai[area] += (jumlahHitam/pembagi);
			}
			nilai[area]=nilai[area]/19;
			
		}
	}
	for(var i=0; i<54; i+=6){
		area++;
		for(var j=0; j<6; j++){
			nilai[area]+=nilai[i+j];
		}
		nilai[area]=nilai[area]/6;
	}
	for(var i=0; i<6; i++){
		area++;
		for(var j=0; j<54;j+=6){
			nilai[area]+=nilai[i+j];
		}
		nilai[area]=nilai[area]/9;
	}
	console.log(nilai);
	return nilai;
}

function hitung2Diagonal5(gambar,kanvas){
	nilai=zeros([246]);
	var area = -1;
	for(var m=0; m<kanvas.height; m+=5){
		for(var n=0; n<kanvas.width; n+=5){
			area++;

			var batasX = n+5;
			var batasY = m+5;
			
			for(var i=n; i<batasX; i++){
				var y = m;
				var x = i;
				var pembagi =0;
				var jumlahHitam = 0;
				while(x>=n&&y<batasY){
					if(gambar[y][x]==0){
						jumlahHitam++;
					}else{
					}
					x--;
					y++;
					pembagi++;
				}
				nilai[area] += (jumlahHitam/pembagi);
			}
			for(var i=m+1; i<batasY; i++){
				var y = i;
				var x = batasX-1;
				var pembagi =0;
				var jumlahHitam = 0;
				while(x>=n&&y<batasY){
					if(gambar[y][x]==0){
						jumlahHitam++;
					}else{
					}
					x--;
					y++;
					pembagi++;
				}
				nilai[area] += (jumlahHitam/pembagi);
			}
			nilai[area]=nilai[area]/9;
			
		}
	}
	for(var i=0; i<216; i+=18){
		area++;
		for(var j=0; j<18; j++){
			nilai[area]+=nilai[i+j];
		}
		nilai[area]=nilai[area]/18;
	}
	for(var i=0; i<18; i++){
		area++;
		for(var j=0; j<216;j+=18){
			nilai[area]+=nilai[i+j];
		}
		nilai[area]=nilai[area]/12;
	}

	return nilai;
}

function hitung2Diagonal15(gambar,kanvas){
	nilai=zeros([34]);
	var area = -1;
	for(var m=0; m<kanvas.height; m+=15){
		for(var n=0; n<kanvas.width; n+=15){
			area++;

			var batasX = n+15;
			var batasY = m+15;
			
			for(var i=n; i<batasX; i++){
				var y = m;
				var x = i;
				var pembagi =0;
				var jumlahHitam = 0;
				while(x>=n&&y<batasY){
					if(gambar[y][x]==0){
						jumlahHitam++;
					}else{
					}
					x--;
					y++;
					pembagi++;
				}
				nilai[area] += (jumlahHitam/pembagi);
			}
			for(var i=m+1; i<batasY; i++){
				var y = i;
				var x = batasX-1;
				var pembagi =0;
				var jumlahHitam = 0;
				while(x>=n&&y<batasY){
					if(gambar[y][x]==0){
						jumlahHitam++;
					}else{
					}
					x--;
					y++;
					pembagi++;
				}
				nilai[area] += (jumlahHitam/pembagi);
			}
			nilai[area]=nilai[area]/29;
			
		}
	}
	for(var i=0; i<24; i+=6){
		area++;
		for(var j=0; j<6; j++){
			nilai[area]+=nilai[i+j];
		}
		nilai[area]=nilai[area]/6;
	}
	for(var i=0; i<6; i++){
		area++;
		for(var j=0; j<24;j+=6){
			nilai[area]+=nilai[i+j];
		}
		nilai[area]=nilai[area]/4;
	}

	return nilai;
}

function detailCitra(gambar, height, width, indeks){
	var posisi =0;
	posisi=idKanvas[indeks];
	if(posisi>0){
		let clone = document.querySelector('#detail0').cloneNode( true );
		clone.setAttribute( 'id', 'detail'+idKanvas[indeks].toString());
		document.querySelector('body').appendChild( clone );
	}
	tabel = document.getElementById('detail'+idKanvas[indeks].toString());
	for(var i=0; i<height; i++){
		var tr = document.createElement('tr');
		tabel.appendChild(tr);
		var td = document.createElement('td');
		td.innerHTML = i+1;
		tr.appendChild(td);
		for(var j=0; j<width; j++){
			var tdNilai = document.createElement('td');
			tdNilai.innerHTML = gambar[i][j];
			tr.appendChild(tdNilai);
		}
	}
}