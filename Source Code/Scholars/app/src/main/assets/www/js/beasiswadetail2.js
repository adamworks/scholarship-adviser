function get_id(id){
    sessionStorage.setItem("id", id);
}

$('#detailbeasiswa').live('pageshow', function(event) {
	var id = getUrlVars()["id"];
	var fnama = localStorage.getItem('username');
	//var id = sessionStorage.getItem('id');
	$.getJSON(serviceURL + 'getdetailbeasiswa.php?id='+id, tampildetail);
    cekbutton();

	//$.getJSON(serviceURL + 'rekomendasi.php?id='+id, getrekomendasi, function(data));
});

function tampildetail(data) {
	var beasiswa = data.item;
	$('#gambar').attr('src', 'img/' + beasiswa.pic_besar);
	$('#judul').text(beasiswa.judul_beasiswa);
	//$('#judul').append( beasiswa.id );
	//('#deskripsi').text(beasiswa.deskripsi);
	$('#deadline').text("Deadline : "+beasiswa.deadline2);
	$('#tipe').text("Tipe : "+beasiswa.tipe_beasiswa);
	//$('#infodetail').text(beasiswa.detail);
	if (beasiswa.detail) {
		 $('#tampil').append('<h3>Detail</h3>' + beasiswa.detail).trigger("create");
	//$("#collapsible").append('<div id="collapsible" data-role="collapsible"></div>');
	// $("#collapsible").append('<h3>First element</h3>');
	// $("#collapsible").append('<p>Im the collapsible set content for section 1.</p>');
	// $("#collapsible").append('<p>Im the collapsible set content for section 1.</p>');
	// $('#collapsible').trigger('create');
	//$('#detail-resep-masakan').append('<div>'+beasiswa.detail+'</div>');
	}
	// if (beasiswa.detail) {
	// 	$('#actionList').append('<li>' + '<h3>Detail</h3>' +
	// 			'<p>' + beasiswa.detail + '</p></li>');
	// }
	if (beasiswa.jenjang) {
		$('#actionList').append('<li>' + '<h3>Jenjang Pendidikan</h3>' +
				'<p>'  + beasiswa.jenjang + '</p></li>');
	}
	if (beasiswa.negara) {
		$('#actionList').append('<li>' + '<h3>Negara</h3>' +
				'<p>' + beasiswa.negara+ '</p></a></li>');
	}
	if (beasiswa.penyedia) {
		$('#actionList').append('<li>' + '<h3>Instansi Pendidikan :</h3>' +
				'<p>' + beasiswa.penyedia + '</p></li>');
	}
	if (beasiswa.jurusan) {
		$('#actionList').append('<li>' + '<h3>Program Studi</h3>' +
				'<p>' + beasiswa.jurusan + '</p></li>');
	}
	if (beasiswa.sertifikat) {
		$('#actionList').append('<li>' + '<h3>Informasi Tambahan</h3>' +
				'<p>' + beasiswa.sertifikat + '</p></li>');
	}
	if (beasiswa.more_url) {
		$('#actionList').append('<li><a href="' + beasiswa.more_url + '"><h5>kunjungi Website</h5>' +
				'</a></li>');
	}
	$('#actionList').listview('refresh');
				var idFav = JSON.stringify(beasiswa.id);
				var gambarFav = JSON.stringify(beasiswa.pic_normal);
				var judulFav = JSON.stringify(beasiswa.judul_beasiswa);
				var deadFav = JSON.stringify(beasiswa.deadline2);
				var jenjangFav = JSON.stringify(beasiswa.jenjang);
				var negFav = JSON.stringify(beasiswa.negara);
				var univFav = JSON.stringify(beasiswa.penyedia);
				//var tagFav = JSON.stringify(beasiswa.array_tag);
				
				window.localStorage.setItem('idLocal',idFav);
				window.localStorage.setItem('gambarLocal',gambarFav);
				window.localStorage.setItem('judulLocal',judulFav);
				//window.localStorage.setItem('desLocal',desFav);
				window.localStorage.setItem('deadLocal',deadFav);
				window.localStorage.setItem('jenjangLocal',jenjangFav);
				window.localStorage.setItem('negLocal',negFav);
				window.localStorage.setItem('univLocal',univFav);

}

function cekbutton(){
        		//var getid = localStorage.getItem('idLocal');
		var id = getUrlVars()["id"];
		var fnama = localStorage.getItem('username');
		var sign = 1;
		console.log(id);
	    $.ajax({
	        type : 'POST',
	        //url : 'http://dbbeasiswa.site50.net/services/beasiswaku.php',
	        url : 'http://dbbeasiswa.16mb.com/services/beasiswaku.php',
	        data : {
	            getid : id,
	            fnama : fnama,
	            sign : sign
	        },
	        dataType : 'json',
	        success : function(data){
	           	if(data.info==true) {
      			console.log("beasiswa telah tersimpan");
      			//$('#simpanx').empty();
	      			$('#simpanx').append('<input id="hapus" type="button" data-theme="b" class="hapusFav" value="hapus" class="ui-btn ui-mini">Hapus</input>');
	      				//<a id='+data.id_simpan+' data-role="button" data-theme="a" data-icon="plus" data-iconpos="right onclick="page2()" ">Hapus</a>');
					$('#simpanx').button();
					//$('["data-role="controlgroup"]').remove('#simpan');
      			}
      			if(data.info==false){
      				//$('#hapusx').remove();
      				$('#simpanx').append('<input id="simpan" type="button" data-theme="c" class="ui-btn ui-mini" value="simpan">Simpan</input>');
      				$('#simpanx').button();
      			}
      			// else{
      			// 	alert("terjadi kesalahan");
      			// }
	        }
	    });
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
					'<h1>' + beasiswa.judul_beasiswa + '</h1>' +
					'<p>' + '<b>Jenjang Pendidikan :</b>' + beasiswa.jenjang + '</p>' +
                    '<p>' + '<b>Negara :</b>' + beasiswa.negara + '</p>'+
                    '<p>' + '<b>Instansi :</b>' + beasiswa.penyedia + ' | ' + '<b>Deadline :</b>' + ' ' + beasiswa.deadline2 +'<b>' + ' ' +'</p></li>');
                    // '<p>' + '<b>Deadline :</b>' + ' ' + beasiswa.deadline2 +'<b>' + ' ' + '</p></li>');


					// '<p>' + beasiswa.deskripsi + '</p>' +
					// '<p>' + '<b>Deadline :</b>' + ' ' + beasiswa.deadline + '</p>'+
					// '<P><b>' + 'Tag:' + ' ' + beasiswa.array_tag +'</b></p></li>'); 
		});
		$('#rekomendasi').listview('refresh');

}
//** SHOW KOMENTAR
$('#detailbeasiswa').live('pageshow', function(event) {
	//getkomentarList();
	var fnama = localStorage.getItem("username");
	var id = getUrlVars()["id"];
	//var id = sessionStorage.getItem('id');
	//var servicelink = "http://localhost/temporary/Scholarapp/services/";
	$.getJSON(serviceURL + 'komentarisi.php?fnama='+fnama+'&id='+id, getkomentarlist);
});

function getkomentarlist(data) {
	
	//$.getJSON(serviceURL + 'komentarisi.php', function(data) {
		$('#komenlist li').remove();
		var varkomen = data.items;
		$.each(varkomen, function(index, beasiswa) {
			var fnama = localStorage.getItem("username");
			$('#komenlist').append('<li id='+ beasiswa.id_kom +' ><a href="#" id=' + beasiswa.id_kom + '>' +
					'<h6>' + beasiswa.username + "|" + ' ' + beasiswa.dibuat+'</h6>' + 
					'<p>' +	beasiswa.komentar + '</p>'+
					//if(beasiswa.username==fnama){
						(beasiswa.username == fnama ? '<a class="delete" href="#" id='+beasiswa.id_kom+'>Delete</a>'+'</li>' : '')
										
											//}
											); 
					// '<a class="delete" href="#" id='+beasiswa.id_kom+'>Delete</a>'+'</li>'); 
		});
		$('#komenlist').listview('refresh');
	};
//** END SHOW KOMENTAR

//** SIMPAN KOMNETAR
//$('#simpankomentar').live("click",function(){
	//function savekomentar(){
		$(document).on('click', '#simpankomentar', function(event) {
			if(localStorage.getItem("username") === undefined || localStorage.getItem("username") == null){
	 		alert("kamu harus login dulu");
        	//location.href = "login.html";
        	event.preventDefault();
        }else{
		  var ID = getUrlVars()["id"];
		  var fnama = localStorage.getItem("username"); 
		  var komentar= $("#komentar").val();
		  //var dataString = 'komentar='+ komentar + '&id_status=' + ID;
		  var url_kom    = serviceURL + 'komentaropen.php';

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
		      		fnama : fnama,
		      		komentar : komentar
		      	},
		      dataType : 'json',
		      cache: false,
		      success: function(data){
		      	var fnama = localStorage.getItem("username");
		      	$('#komenlist li').remove();
									 	var beasiswa = data.items;
									 	$.each(beasiswa, function(index, beasiswa) {
											$('#komenlist').append('<li id='+ beasiswa.id_kom +' ><a href="#" id=' + beasiswa.id_kom + '>' +
											'<h6>' + beasiswa.username + "|" + ' ' + beasiswa.dibuat+'</h6>' + 
											'<p>' +	beasiswa.komentar + '</p>'+
											//if(beasiswa.username==fnama){
											(beasiswa.username == fnama ? '<a class="delete" href="#" id='+beasiswa.id_kom+'>Delete</a>'+'</li>' : 'Y')
											//}
											); 
											});
											$('#komenlist').listview('refresh');


		        //$("#commentload"+ID).append(html);
		        $("#komentar").val('');
		        $("#komentar").focus();
		      }
		    });
		  }
		  //return false;
		}
		});
	//}


// // Hapus Komentar berdasarkan ID Komentar
// $( ".delete" ).on( "click", function() {
//             var listitem = $( this ).parent( "li.ui-li" );
//             confirmAndDelete( listitem );
//         });

$('.delete').live("click",function(){
  var id = $(this).attr("id");
  var user =localStorage.getItem("username");
   var idb = getUrlVars()["id"];
   //confirmAndDelete(id,user,idb);
//});  //var dataString = 'id_kom='+ ID;

// function confirmAndDelete( listitem, transition ) {
//         // Highlight the list item that will be removed
//         listitem.addClass( "ui-btn-down-d" );
//         // Inject topic in confirmation popup after removing any previous injected topics
//         $( "#confirm .topic" ).remove();
//         listitem.find( ".topic" ).clone().insertAfter( "#question" );
//         // Show the confirmation popup
//         $( "#confirm" ).popup( "open" );
//         // Proceed when the user confirms
//         $( "#confirm #yes" ).on( "click", function() {
//             // Remove with a transition
//function confirmAndDelete( id,user,idb ) {
  if(confirm("Apakah Anda yakin akan menghapus Komentar?")){
    $.ajax({
      type: "POST",
      url: serviceURL + "komentardelete.php",
      data: {
      	idkom : id,
      	user : user,
      	idbea : idb
      },
      dataType: "json",
      //cache: false,
      success: function(data){
      	if(data.status==true) {
      		alert("data berhasil dihapus");
      		 console.log("data dihapus");
      	// if(data.id){
      	// 	var databaru = $(this).attr(data.id);
      	// 	 console.log(databaru);
      		 $("#komenlist li").remove("#"+ data.id);
             $('#komenlist').listview('refresh');
      	}
      		
             $("#komentar").val('');
		     $("#komentar").focus();
      	// 	 var databaru = $(this).attr(data.id);
      	// 	 console.log(databaru);
      	// 	 databaru.remove();
       //       $( "#komenlist" ).listview( "refresh" );
       //       $("#komentar").val('');
		     // $("#komentar").focus();
        //$("#"+ID).slideUp();
    	}
    });
  }
 
 //}
});
//   return false;





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

// $(document).on('pageshow','#detailbeasiswa', function () {
//     if(localStorage.getItem("username") === undefined || localStorage.getItem("username") == null){
//            // $.mobile.changePage("login.html");
//         	//window.location = loginpage;
//         	alert("kamu harus login dulu");
//         	//location.href = "login.html";
//         	e.preventDefault();
//         }else{
//             //$.mobile.changePage("#pageYYY");
//         savebeasiswaku();
//     	}
// });
//function savebeasiswaku(){
//favorite section
$(document).on('click', '#simpan', function(e) {
	 if(localStorage.getItem("username") === undefined || localStorage.getItem("username") == null){
	 	alert("kamu harus login dulu");
        	//location.href = "login.html";
        	e.preventDefault();
        }else{

        	saveFavorit();
        	//cekbutton();
        	//$('#simpanx').remove();
        	$('#simpanx').empty();
        			$('#simpanx').append('<input id="hapus" type="button" data-theme="b" class="hapusFav" value="hapus" class="ui-btn ui-mini">Hapus</input>');
	      				//<a id='+data.id_simpan+' data-role="button" data-theme="a" data-icon="plus" data-iconpos="right onclick="page2()" ">Hapus</a>');
					$('#simpanx').button();
	      			

	function saveFavorit(){
		//var getid = localStorage.getItem('idLocal');
		var getid = getUrlVars()["id"];
		var fnama = localStorage.getItem('username');
		var sign = 2;
		console.log(getid);
	    $.ajax({
	        type : 'POST',
	        // url : 'http://dbbeasiswa.site50.net/services/beasiswaku.php',
	        url : 'http://dbbeasiswa.16mb.com/services/beasiswaku.php',
	        // async: true,
	        // beforeSend: function(x) {
	        //     if(x && x.overrideMimeType) {
	        //          x.overrideMimeType("application/j-son;charset=UTF-8");
	        //     }
	        // },
	        data : {
	            getid : getid,
	            fnama : fnama,
	            sign : sign
	        },
	        dataType : 'json',
	        success : function(data){
	           	if(data.status==true) {
      			alert("data berhasil disimpan");
      			//cekbutton();
      			
      			
    //   			$('#simpanx').append('<input id="hapus" type="button" data-theme="b" class="hapusFav" value="hapus" class="ui-btn ui-mini">Hapus</input>');
	   //    				//<a id='+data.id_simpan+' data-role="button" data-theme="a" data-icon="plus" data-iconpos="right onclick="page2()" ">Hapus</a>');
				// $('#simpanx').button();
      			//$('[data-role="controlgroup"]').attr('#simpan').remove();
      			//$('input:button').attr("disabled", true);
      		// 	$('[data-role="controlgroup"]').append('<a data-role="button" data-theme="b" data-icon="plus" data-iconpos="right">Save</a>');
        // // Enhance new button element
        // $('[data-role="button"]').button();
      			}
      			if(data.status==false){
      				alert("terjadi kesalahan");
      			}

    //   				if(data.status=='simpan') {
    //   			alert("data berhasil disimpan");
    //   			console.log("beasiswa disimpan");
    //   			// $('#simpan').remove();
    // //   			$('#').append('<li><a href="#" onclick="page2()">'+
    // //         		'<p>' + 'beasiswa yang tersimpan adalah' + rekomendasites + '</p></a></li>');
				// // $('#tampilkan').listview('refresh');
    //   			//$(this).val('hapus');
      			
    //   			}
    //   			if(data.status=='dobel'){
    //   				alert("beasiswa sudah disimpan");
    //   				console.log("beasiswa sudah disimpan");
    //   			}
    //   			if(data.status=='gagal'){
    //   				alert("terjadi kesalahan");
    //   				console.log("gagal");
    //   			}
	            // $.each(AmbilData, function(i, r) {
	            //     console.log(r.count);
	            // });
	        }
	    });
	}
   


    var idValue = JSON.parse(window.localStorage.getItem('idLocal'));
    var gambarValue = window.localStorage.getItem("gambarLocal");
    var judulValue = window.localStorage.getItem("judulLocal");
    //var desValue = window.localStorage.getItem("desLocal");
    var deadValue = window.localStorage.getItem("deadLocal");
    var jenjValue = window.localStorage.getItem("jenjangLocal");
	var negValue = window.localStorage.getItem("negLocal");
	var univValue = window.localStorage.getItem("univLocal");

//$('#offline').on('change', function(e) {
    if($("#offline:checked").length == 1) update =1; else update = 0;
    console.log(update);
    if(update==0){
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
            "jenjFavorit TEXT, " +
            "negFavorit TEXT, " +
            "univFavorit TEXT, " +
            "deadFavorit DATE)";
        tx.executeSql(sql);
    }

    function simpan(tx){
    	db.transaction(function(tx) { 
        	var cekData = "select * FROM beasiswaku WHERE idFavorit = ?";
	    	var sql = "INSERT INTO beasiswaku (idFavorit, judulFavorit, gambarFavorit,jenjFavorit,negFavorit,univFavorit,deadFavorit) VALUES ("+idValue+","+judulValue+","+gambarValue+","+jenjValue+","+negValue+","+univValue+","+deadValue+")";
	    	tx.executeSql (cekData, [idValue],
	    	function (tx, result){
	    		if (result.rows.length){
	    			alert("beasiswa telah tersimpan");
	    			//hapusFavorit();
	    // 			$('#hapusx').append('<a data-role="button" data-theme="b" data-icon="plus" data-iconpos="right">Hapus</a>');
					// $('#hapusx').button();
			   	}
			   	else {
			   		tx.executeSql(sql);
        			//alert("beasiswa telah disimpan");
        			//saveFavorit();
     //    			$('#simpanx').remove();
     //    			$('#hapusx').append('<input id="hapus" type="button" data-theme="b" class="hapusFav" value="hapus" class="ui-btn ui-mini">Hapus</input>');
	    //   				//<a id='+data.id_simpan+' data-role="button" data-theme="a" data-icon="plus" data-iconpos="right onclick="page2()" ">Hapus</a>');
					// $('#hapusx').button();
        			
	  		// 		$('#simpanx').append('<input id="hapus" type="button" data-theme="b" class="hapusFav" value="hapus" class="ui-btn ui-mini">Hapus</input>');
	    //   				//<a id='+data.id_simpan+' data-role="button" data-theme="a" data-icon="plus" data-iconpos="right onclick="page2()" ">Hapus</a>');
					// $('#simpanx').button();			
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
	}
  //});
}
});


$('#hapus').live("click",function(){
  //var id = $(this).attr("id");
  var fnama =localStorage.getItem("username");
   var id = getUrlVars()["id"];
   var sign = 3;
   hapusFav(fnama,id,sign);
   
   $('#simpanx').empty();
   //$('#simpanx').show();
         $('#simpanx').append('<input id="simpan" type="button" data-theme="b" class="hapusFav" value="simpan" class="ui-btn ui-mini">Simpan</input>');
	      				//<a id='+data.id_simpan+' data-role="button" data-theme="a" data-icon="plus" data-iconpos="right onclick="page2()" ">Hapus</a>');
					$('#simpanx').button();
  });

function hapusFav(fnama,id,sign){
  //if(confirm("Apakah Anda yakin akan menghapus Komentar?")){
    $.ajax({
      type: "POST",
      url: serviceURL + "beasiswaku.php",
      data: {
      	//idkom : id,
      	fnama : fnama,
      	getid : id,
      	sign : sign
      },
      dataType: "json",
      //cache: false,
      success: function(data){
      	if(data.status==true) {
      		alert("data berhasil dihapus");
      		 console.log("data dihapus");
      	// if(data.id){
      	// 	var databaru = $(this).attr(data.id);
      	// 	 console.log(databaru);
      		 // $("#komenlist li").remove("#"+ data.id);
         //     $( "#komenlist" ).listview( "refresh" );
         
         
     //    			$('#simpanx').append('<input id="hapus" type="button" data-theme="b" class="hapusFav" value="hapus" class="ui-btn ui-mini">Hapus</input>');
	    //   				//<a id='+data.id_simpan+' data-role="button" data-theme="a" data-icon="plus" data-iconpos="right onclick="page2()" ">Hapus</a>');
					// $('#simpanx').button();
      	}
      	

       //       $("#komentar").val('');
		     // $("#komentar").focus();
      
    	}
    });
  //}
 }
//});
//}