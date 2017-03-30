function get_id(id){
    sessionStorage.setItem("id", id);
}

$('#detailbeasiswa').live('pageshow', function(event) {
	var id = getUrlVars()["id"];
	//var id = sessionStorage.getItem('id');
	$.getJSON(serviceURL + 'getdetailbeasiswa.php?id='+id, tampildetail);
	//$.getJSON(serviceURL + 'rekomendasi.php?id='+id, getrekomendasi, function(data));
});

function tampildetail(data) {
	var beasiswa = data.item;
	$('#gambar').attr('src', 'img/' + beasiswa.pic_besar);
	$('#judul').text(beasiswa.nama_beasiswa);
	//$('#judul').append( beasiswa.id );
	$('#deskripsi').text(beasiswa.deskripsi);
	$('#deadline').text(beasiswa.deadline);
	if (beasiswa.detail) {
		$('#kolapsible').append('<li>' + '<h3>Detail</h3>' +
				'<p>' + beasiswa.detail + '</p></a></li>');
	}
	if (beasiswa.negara) {
		$('#actionList').append('<li>' + '<h3>Negara</h3>' +
				'<p>' + beasiswa.negara + '</p></a></li>');
	}
	// if (beasiswa.ipk) {
	// 	$('#actionList').append('<li>' + '<h3>IPK</h3>' +
	// 			'<p>' + 'IPK minum :' + '' + beasiswa.ipk + '</p></a></li>');
	// }
	if (beasiswa.url) {
		$('#actionList').append('<li><a href="Membuka website:' + beasiswa.url + '"><h3>Website</h3>' +
				'<p>' + beasiswa.website + '</p></a></li>');
	}
	$('#actionList').listview('refresh');
				var idFav = JSON.stringify(beasiswa.id);
				var gambarFav = JSON.stringify(beasiswa.pic_besar);
				var judulFav = JSON.stringify(beasiswa.nama_beasiswa);
				var desFav = JSON.stringify(beasiswa.deskripsi);
				var deadFav = JSON.stringify(beasiswa.deadline);
				
				window.localStorage.setItem('idLocal',idFav);
				window.localStorage.setItem('gambarLocal',gambarFav);
				window.localStorage.setItem('judulLocal',judulFav);
				window.localStorage.setItem('desLocal',desFav);
				window.localStorage.setItem('deadLocal',deadFav);


}

//fungsi rekomendasi beasiswa
$('#detailbeasiswa').live('pageshow', function(event) {
	var id = getUrlVars()["id"];
	//var id = sessionStorage.getItem('id');
	$.getJSON(serviceURL + 'rekomendasi.php?id='+id, getrekomendasi);
	//$.getJSON(serviceURL + 'rekomendasi.php?id='+id, getrekomendasi, function(data));
});

function getrekomendasi(data) {
	$('#rekomendasi li').remove();
	var rekomendasites = data.items;
	$.each(rekomendasites, function(index, beasiswa) {
			$('#rekomendasi').append('<li><a href="beasiswadetail.html?id=' + beasiswa.id + '">' +
					'<img src="img/' + beasiswa.pic_normal + '"/>' +
					'<h1>' + beasiswa.nama_beasiswa + '</h1>' +
					'<p>' + beasiswa.deskripsi + '</p>' +
					'<p>' + '<b>Deadline :</b>' + ' ' + beasiswa.deadline + '</p>'+
					'<P><b>' + 'Tag:' + ' ' + beasiswa.array_tag +'</b></p></li>'); 
		});
		$('#rekomendasi').listview('refresh');

}

$('#detailbeasiswa').live('pageshow', function(event) {
	//getkomentarList();
	var id = getUrlVars()["id"];
	//var id = sessionStorage.getItem('id');
	var servicelink = "http://localhost/temporary/Scholarapp/services/";
	$.getJSON(servicelink + 'komentarisi.php?id='+id, getkomentarlist);
});

function getkomentarlist(data) {
	//$.getJSON(serviceURL + 'komentarisi.php', function(data) {
		$('#komenlist li').remove();
		var varkomen = data.items;
		$.each(varkomen, function(index, beasiswa) {
			$('#komenlist').append('<li><a href="#" id=' + beasiswa.id_kome + '>' +
					'<p>' + beasiswa.komentar + '</p>' +'</li>'); 
		});
		$('#komenlist').listview('refresh');
	};

//Simpan Komentar
//$('#simpankomentar').live("click",function(){
$(document).on('click', '#simpankomentar', function(event) {
  var ID = getUrlVars()["id"];

  var komentar= $("#komentar").val();
  //var dataString = 'komentar='+ komentar + '&id_status=' + ID;
  var url_kom    = 'http://localhost/temporary/Scholarapp/services/komentaropen.php';

  if(komentar==''){
    alert("Silahkan isi komentar dulu");
  }
  else{
    $.ajax({
      type: "POST",
      //url: "komentar_ajax.php",
      url: url_kom,
      data: {
      		id_status : ID,
      		komentar : komentar
      	},
      dataType : 'json',
      cache: false,
      success: function(data){

      	$('#komenlist li').remove();
							 	var beasiswa = data.items;
							 	$.each(beasiswa, function(index, beasiswa) {
									$('#komenlist').append('<li>' + 
											beasiswa.komentar + '</li>'); 
										});
									$('#komenlist').listview('refresh');


        //$("#commentload"+ID).append(html);
        $("#komentar").val('');
        $("#komentar").focus();
      }
    });
  }
  //return false;
});



// Hapus Komentar berdasarkan ID Komentar
$('.stcommentdelete').live("click",function(){
  var ID = $(this).attr("id");
  var dataString = 'id_kom='+ ID;

  if(confirm("Apakah Anda yakin akan menghapus Komentar?")){
    $.ajax({
      type: "POST",
      url: "hapus_komentar_ajax.php",
      data: dataString,
      cache: false,
      success: function(html){
        $("#stcommentbody"+ID).slideUp();
      }
    });
  }
  return false;
});




//membuat fungsi xss domain dan konfigurasi phonegap


function getUrlVars() {
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}

//favorite section
$(document).on('click', '#simpan', function(e) {
	
	function saveFavorit(){
		var id = sessionStorage.getItem('id');
	    $.ajax({
	        type : 'POST',
	        url : 'http://localhost/temporary/scholarapp/service/beasiswaku.php',
	        async: true,
	        beforeSend: function(x) {
	            if(x && x.overrideMimeType) {
	                 x.overrideMimeType("application/j-son;charset=UTF-8");
	            }
	        },
	        data : {
	            getid : id,
	        },
	        dataType : 'json',
	        success : function(data){
	            var AmbilData = data.items;
	            $.each(AmbilData, function(i, r) {
	                console.log(r.count);
	            });
	        },
	    });
	}
   
    var idValue = JSON.parse(window.localStorage.getItem('idLocal'));
    var gambarValue = window.localStorage.getItem("gambarLocal");
    var judulValue = window.localStorage.getItem("judulLocal");
    var desValue = window.localStorage.getItem("desLocal");
    var deadValue = window.localStorage.getItem("deadLocal");
    
    var db = window.openDatabase("beasiswadb", "1.0", "beasiswaku_DB", 200000);
    //db.transaction(read, messageError);
    db.transaction(createTable, messageError);
    db.transaction(simpan, messageError);
    
    function createTable(tx) {
        var sql = 
            "CREATE TABLE IF NOT EXISTS beasiswaku ( "+
            "id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, " +
            "idFavorit INTEGER, " +
            "judulFavorit TEXT, " +
            "gambarFavorit TEXT, " +
            "desFavorit TEXT, " +
            "deadFavorit TEXT)";
        tx.executeSql(sql);
    }

    function simpan(tx){
    	db.transaction(function(tx) { 
        	var cekData = "select * FROM beasiswaku WHERE idFavorit = ?";
	    	var sql = "INSERT INTO beasiswaku (idFavorit, judulFavorit, gambarFavorit,desFavorit, deadFavorit) VALUES ("+idValue+","+judulValue+","+gambarValue+","+desValue+","+deadValue+")";
	    	tx.executeSql (cekData, [idValue],
	    	function (tx, result){
	    		if (result.rows.length){
	    			alert("beasiswa telah tersimpan");
			   	}
			   	else {
			   		tx.executeSql(sql);
        			alert("beasiswa telah disimpan");
        			saveFavorit();        			
        		}        		
	    	}, messageError);
	    });
    }
	
	function dropTable(tx){
        var sql = "DROP TABLE beasiswaku";
        tx.executeSql(sql);
        alert('Hapus table berhasil');
    }
    function messageError(tx, error) {
        alert("Database Error: " + error);
    }
});
//beasiswaku page
$(document).on('pageinit', '#beasiswa2', function(){
    var db = window.openDatabase("beasiswadb", "1.0", "beasiswaku_DB", 200000);
	db.transaction(read, messageError);

	var id = sessionStorage.getItem("id");
	
	function read(tx) {
		var sql = "select * from beasiswaku WHERE id=?";
		tx.executeSql(sql, [id], dataList);
	}

	function dataList(tx, results) {
		$('#beasiswaku').empty();
	    var data = results.rows.item(0);
	    $('#beasiswaku').append('<div><center><h2>'+data.judulFavorit+'</h2></center></div><hr>');
		$('#beasiswaku').append('<div><center><img src="http://www.resepfinder.web.id/images/'+data.gambarFavorit+'" style="width:300px; height:300px;"></center></div><hr>');
		$('#beasiswaku').append('<div>'+data.desFavorit+'</div>');
		$('#beasiswaku').append('<div><b>Sumber: </b>'+data.deadFavorit+'</div>');
	}

	function messageError(tx, error) {
	    alert("Database Error: " + error);
	}
});
