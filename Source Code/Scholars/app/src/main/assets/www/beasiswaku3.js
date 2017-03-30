$(document).on('pageshow','#beasiswakupage', function (event) {
    if(localStorage.getItem("username") === undefined || localStorage.getItem("username") == null){
           // $.mobile.changePage("login.html");
        	//window.location = loginpage;
        	alert("kamu harus login dulu");
        	location.href ="../www/login.html";
        	e.preventDefault();
        }else{
			//var id = "baru";
			var id =localStorage.getItem("username");
			var sign = 1;
			$.getJSON(serviceURL + 'rekomenlist.php?fnama='+id, getrekomendasix);
			$.getJSON(serviceURL + 'getjumlah.php?fnama='+id, getjumlah);
    	}
});

function getrekomendasix(data) {
			$('#rekomendasix li').remove();
			var rekomendasites = data.items;
			$.each(rekomendasites, function(index, beasiswa) {
					$('#rekomendasix').append('<li><a href="beasiswadetail.html?id=' + beasiswa.id + '">' +
							'<img src="img/' + beasiswa.pic_normal + '"/>' +
							'<h1>' + beasiswa.judul_beasiswa + '</h1>' +
							'<p>' + '<b>Jenjang Pendidikan :</b>' + beasiswa.jenjang + '</p>' +
		                    '<p>' + '<b>Negara :</b>' + beasiswa.negara + '</p>'+
		                    '<p>' + '<b>Instansi :</b>' + beasiswa.penyedia + '</p>'+
		                    '<p class="ui-li-aside" style="margin-top:90px;">' + '<b>Deadline :</b>' + ' ' + beasiswa.deadline2 +'<b>' + ' ' + '</p></li>');


							// '<p>' + beasiswa.deskripsi + '</p>' +
							// '<p>' + '<b>Deadline :</b>' + ' ' + beasiswa.deadline + '</p>'+
							// '<P><b>' + 'Tag:' + ' ' + beasiswa.array_tag +'</b></p></li>'); 
				});
				$('#rekomendasix').listview('refresh');

}

				//$('#tampilkanx li').show();
				// $('#beasiswakupage').reload();
			//}
				// else{
				// 	$('#tampilkanx').show();
				// }

function getjumlah(data) {
			//$('#tampilkanx').html("<h4>belum menyimpan</h4>");
			$('#tampilkan li').remove();
			//$('#tampilkax li').show();
			console.log(data);
			var rek = data.items;
			//alert(data);
			//$.each(rekomendasites, function(index, beasiswa)
			//$('#tampilkan').empty(); 
			$.each(rek, function(index, beasiswax) {
				if(beasiswax.num > 0){
					console.log(beasiswax.num);
					//$('#tampilkanx').empty();
					$('#tampilkan').append('<li><a href="#" onclick="page2()">'+
            		'<p>' + 'beasiswa yang tersimpan adalah' + beasiswax.num + '</p></a></li>');
				$('#tampilkan').listview('refresh');
			}
			if(beasiswax.num==0){
				$('#tampilkan').append('<li><a href="#" onclick="page2()">'+
            		'<p>' + 'BELUM MENYIMPAN BEASISWA' + '</p></a></li>');
				$('#tampilkan').listview('refresh');
			}
			//return false;
		});
			
}

$('#backtopage').click(function() {
    location.reload();
    location.href="#beasiswakupage";
});
				// 	function getbeasiswaku(data) {
				// 	// $.getJSON(serviceURL + 'getbeasiswa.php', function(data) {
						
				// 		$('#listbeasiswaku li').remove();
				// 		var beasiswa = data.items;
				// 		$.each(beasiswa, function(index, beasiswa) {
				// 			$('#listbeasiswaku').append('<li><a href="beasiswadetail.html?id=' + beasiswa.id + '">' +
				// 					'<img src="img/' + beasiswa.defgambar + '"/>' +
				// 					'<h1>' + beasiswa.nama_beasiswa + '</h1>' +
				// 					'<p>' + beasiswa.deskripsi + '</p>' +
				// 					'<p>' + '<b>Deadline :</b>' + ' ' + beasiswa.deadline + '</p></a></li>'); 
				// 		});
				// 		$('#listbeasiswaku').listview('refresh');
				// 	//});
				// }


$(document).on('pageshow','#beasiswakupage2', function (event) {
    
            //$.mobile.changePage("#pageYYY");
           // var id =localStorage.getItem("username");
           var id =localStorage.getItem("username");
        	var servicelink = "http://localhost/intergrasi/Scholarapp/services/";
			//$.getJSON(servicelink + 'syncbeasiswaku.php?id='+id, getbeasiswaku);
			mulai();
			//$.getJSON(serviceURL + 'syncbeasiswaku.php?fnama='+id, getbeasiswalist);


});	


function getbeasiswalist(data) {
	
	//$.getJSON(serviceURL + 'komentarisi.php', function(data) {
		console.log(data);
		$('#listbeasiswaku li').remove();
		var varkomen = data.items;
		$.each(varkomen, function(index, beasiswa) {
			//var fnama = localStorage.getItem("username");
			$('#listbeasiswaku').append('<li id='+ beasiswa.id +' ><a href="beasiswadetail.html?id=' + beasiswa.id + '">' +
											'<img src="img/' + beasiswa.pic_normal + '"/>' +
											'<h1>' + beasiswa.judul_beasiswa + '</h1>' +
                                            '<p>' + '<b>Jenjang Pendidikan :</b>' + beasiswa.jenjang + '</p>' +
                                            '<p>' + '<b>Negara :</b>' + beasiswa.negara + '</p>'+
                                            '<p>' + '<b>Instansi :</b>' + beasiswa.penyedia + '</p>' +
                                            '<p>' + '<b>Deadline :</b>' + ' ' +'<b>'+ beasiswa.deadline2 +'</b>' + ' ' + '</p>'+
                                            '<a class="delete2" href="#" id='+beasiswa.id+'>Delete</a>'+'</li>');
            //$('<a href="#" onClick="deleteBy('+data.id+');">Hapus</a>').appendTo('#listbeasiswaku');
			    	$('#listbeasiswaku').listview('refresh');
	});
}

// function deletex(id){
// 			//deleteBy(id);
// 			kirimsql(id);
// 		}

// function kirimsql(id){
// 				// var id = '';
// 			 //  var data = hasil.rows.length;
// 			 //  for(var i=0;i<=data;i++){
// 			  //var baris = hasil.rows.item(i);
// 			  //var id = baris.idFavorit;
// 			  //var id2 = 1;
// 			  var fnama = localStorage.getItem("username");
// 					  $.ajax({
// 				        type : 'POST',
// 				        url : serviceURL +'updatebeasiswaku.php',
// 				        async: true,
// 				        beforeSend: function(x) {
// 				            if(x && x.overrideMimeType) {
// 				                 x.overrideMimeType("application/j-son;charset=UTF-8");
// 				            }
// 				        },
// 				        data : {
// 				            getid : id,
// 				            fnama : fnama
// 				        },
// 				        dataType : 'json',
// 				        success : function(result){
// 				        	if(result.status==true)
// 				                console.log(result);
// 				            }
// 				    });
// 			}


//VERSI DELETE SERVER TERPISAH

// $('.delete2').live("click",function(){
//   var id = $(this).attr("id");
//   var user =localStorage.getItem("username");
//   var sign = 3;
//    //var idb = getUrlVars()["id"];
//   if(confirm("Apakah Anda yakin akan menghapus Beasiswa?")){
  	
//     $.ajax({
//       type: "POST",
//       url: serviceURL + "beasiswaku.php",
//       data: {
//       	fnama : user,
//       	getid : id,
//       	sign : sign
//       	//idbea : idb
//       },
//       dataType: "json",
//       //cache: false,
//       success: function(data){
//       	if(data.status==true) {
//       		//deletex(id);
//       		alert("data berhasil dihapus");
//       		 console.log("data dihapus");
      		 
//       		 $("#listbeasiswaku li").remove("#"+ data.id);
//              $("#listbeasiswaku" ).listview( "refresh" );

//       	}
//     }
//     });
//   }
//  //}
// });

function deletex(id){
			deleteBy(id);
			kirimsql(id);
			//location.reload();
		}

        function deleteBy(id) {
				var db = window.openDatabase("beasiswadb", "1.0", "beasiswaku_DB", 200000);	
			   
			    db.transaction(function(tx) { 
			    	var sql = "DELETE FROM beasiswaku WHERE idFavorit = ?";
			    	tx.executeSql(sql, [id]);
			    }, messageError);

				//db.transaction(read, messageError);
			    //alert("Beasiswa telah terhapus di localStorage ");

			    // db.transaction(function(tx) { 
			    // 	var dsql = "SELECT * FROM beasiswaku WHERE id = ?";
			    // 	tx.executeSql(dsql, [id]);
			    // },kirimsql);
			    // db.transaction(read, kirimsql);

			}
			function messageError(tx, error) {
			    alert("Database Error: " + error);
			}





	
	function mulai(){
		var db = window.openDatabase("beasiswadb", "1.0", "beasiswaku_DB", 200000);
			db.transaction(read, function(){
				//$('#kosong').html("anda belum menyimpan beasiswa");});
		});
		// function read(tx) {
		// 					var sql = "select * from beasiswaku order by id";
		// 					tx.executeSql(sql);
		// 				}
		function read(tx) {
							var sql = "select * from beasiswaku order by id";
							tx.executeSql(sql, [], dataList);
						}

	}
		
		
		function dataList(tx, results) {
				$('#listbeasiswaku').empty();
				
			    var getList = results.rows.length;
			    if(getList == 0){
			    	$('#kosong').html("Belum menyimpan beasiswa");
			    }
			    for (var i=0; i<getList; i++) {
			    	var data = results.rows.item(i);  	
			    	//var td11 = $('<input type="button" value="delete" />').attr("name",data.id);
			    	$('#listbeasiswaku').append(
			    		'<li><a href="beasiswadetail.html?id=' + data.idFavorit + '">'+
			    		//'<img src="img/'+data.gambarFavorit+'" style="width:80px; height:80px;"><h2>'+data.judulFavorit+'</h2><p>'+data.desFavorit+'</p>'+'<p>'+data.deadFavorit+'</p></a>'+
			    		'<img src="img/'+data.gambarFavorit+'" style="width:80px; height:80px;"><h2>'+data.judulFavorit+'</h2>'+
			    		'<p>' + '<b>JenjangPendidikan :</b>' +data.jenjFavorit+'</p>'+
			    		'<p>' + '<b>Negara :</b>' +data.negFavorit+'</p>'+
			    		'<p>' + '<b>Instansi :</b>' +data.univFavorit+'</p>'+
			    		'<p>'+ '<b>Deadline :</b>' +data.deadFavorit+'</p></a>'+
			    		'<a onclick="if(confirm(\'Apakah Anda yakin untuk menghapus?\')){deletex('+data.idFavorit +')}">Delete</a>'+
			    		'</li>'	
			    	);
            //$('<a href="#" onClick="deleteBy('+data.id+');">Hapus</a>').appendTo('#listbeasiswaku');
			    	$('#listbeasiswaku').listview('refresh');

			    }
			}

		
		
	// 		function messageError(tx, error) {
	// 		    alert("Database Error: " + error);
	// 		}

			function kirimsql(id){
				// var id = '';
			 //  var data = hasil.rows.length;
			 //  for(var i=0;i<=data;i++){
			  //var baris = hasil.rows.item(i);
			  //var id = baris.idFavorit;
			  //var id2 = 1;
			  //var id = $(this).attr("id");
  var user = localStorage.getItem("username");
  var sign = 3;
   //var idb = getUrlVars()["id"];
  //if(confirm("Apakah Anda yakin akan menghapus Beasiswa?")){
  	
    $.ajax({
      type: "POST",
      url: serviceURL + "beasiswaku.php",
      data: {
      	fnama : user,
      	getid : id,
      	sign : sign
      	//idbea : idb
      },
      dataType: "json",
      //cache: false,
      success: function(data){
      	if(data.status==true) {
      		//deletex(id);
      		alert("data berhasil dihapus");
      		 console.log("data dihapus");
      		 location.reload();
      		 $("#listbeasiswaku li").remove("#"+ data.id);
             $("#listbeasiswaku" ).listview( "refresh" );

      	}
    }
    });
  	}



			  // var fnama = localStorage.getItem("username");
					//   $.ajax({
				 //        type : 'POST',
				 //        url : serviceURL +'updatebeasiswaku.php',
				 //        async: true,
				 //        beforeSend: function(x) {
				 //            if(x && x.overrideMimeType) {
				 //                 x.overrideMimeType("application/j-son;charset=UTF-8");
				 //            }
				 //        },
				 //        data : {
				 //            getid : id,
				 //            fnama : fnama
				 //        },
				 //        dataType : 'json',
				 //        success : function(result){
				 //        	if(result.status==true)
				 //                console.log(result);
				 //            }
				 //    });
			//}
		// }