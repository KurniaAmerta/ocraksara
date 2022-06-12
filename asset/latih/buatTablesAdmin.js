function addCell(jenis,tr, val) {
  if(jenis==1){
    var td = document.createElement('td');

    td.innerHTML = val;

    tr.appendChild(td);
  }
  else{
    var td = document.createElement('td');
    tr.appendChild(td);
    td.appendChild(val);
  }
  
}

function addCell2(jenis,tr, val, tipe) {
  var td = document.createElement('td');

    tr.appendChild(td);
    td.id = tipe;
    //td.innerHTML = '<input type="text" id="Input'+tipe+'" value="a">';
}

function addRow(tbl, val_1, val_3, val_4, val_5, val_6) {
  var diagonal = "diagonal"+val_1.toString();
  var euler = "euler"+val_1.toString();
  var label = "label"+val_1.toString();

  var tr = document.createElement('tr');

  addCell(1,tr, val_1);
  addCell(0,tr, val_3);
  addCell2(1, tr, val_4, diagonal);
  addCell2(1, tr, val_5, euler);
  addCell2(1,tr, val_6, label);

  tbl.appendChild(tr);
}