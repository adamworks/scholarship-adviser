$(document).on('pagebeforeshow','#beasiswakupage', function () {
    if(localStorage.getItem("username") === undefined || localStorage.getItem("username") == null){
           // $.mobile.changePage("login.html");
        	//window.location = loginpage;
        	alert("kamu harus login dulu");
        	location.href = "login.html";
        	e.preventDefault();
        }else{
            //$.mobile.changePage("#pageYYY");
            var id =localStorage.getItem("username");
        	var servicelink = "http://localhost/intergrasi/Scholarapp/services/";
			$.getJSON(servicelink + 'syncbeasiswaku.php?id='+id, getbeasiswaku);
			mulai();
    	}
});	
	function getbeasiswaku(data) {
		var beasiswa = data.items;
		//beasiswa = data.items;
		$.each(beasiswa, function(index, beasiswa) {
				var idFav = JSON.stringify(beasiswa.id);
				var gambarFav = JSON.stringify(beasiswa.pic_besar);
				var judulFav = JSON.stringify(beasiswa.nama_beasiswa);
				var desFav = JSON.stringify(beasiswa.deskripsi);
				var deadFav = JSON.stringify(beasiswa.deadline);
			 
		});
				// var idFav = JSON.stringify(beasiswa.id);
				// var gambarFav = JSON.stringify(beasiswa.pic_besar);
				// var judulFav = JSON.stringify(beasiswa.nama_beasiswa);
				// var desFav = JSON.stringify(beasiswa.deskripsi);
				// var deadFav = JSON.stringify(beasiswa.deadline);
				
				window.localStorage.setItem('idLocal',idFav);
				window.localStorage.setItem('gambarLocal',gambarFav);
				window.localStorage.setItem('judulLocal',judulFav);
				window.localStorage.setItem('desLocal',desFav);
				window.localStorage.setItem('deadLocal',deadFav);

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
			    }//end function
			    function simpan(tx){
		    	db.transaction(function(tx) { 
			    	var sql = "INSERT INTO beasiswaku (idFavorit, judulFavorit, gambarFavorit,desFavorit, deadFavorit) VALUES ("+idValue+","+judulValue+","+gambarValue+","+desValue+","+deadValue+")";
			    	tx.executeSql(sql);
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

	}//end function

	function mulai(){
		var db = window.openDatabase("beasiswadb", "1.0", "beasiswaku_DB", 200000);
			db.transaction(read, function(){
				$('#kosong').html("anda belum menyimpan beasiswa");});
		}
		
		function read(tx) {
							var sql = "select * from beasiswaku order by id";
							tx.executeSql(sql, [], dataList);
						}

		// function dataList(tx, results) {
		// 		$('#listbeasiswaku').empty();
				
		// 	    var getList = results.rows.length;
		// 	    if(getList == 0){
		// 	    	$('#kosong').html("Belum menyimpan beasiswa");
		// 	    }
		// 	    for (var i=0; i<getList; i++) {
		// 	    	var data = results.rows.item(i);
			    	
		// 	    	$('#listbeasiswaku').append(
		// 	    		'<li><a href="beasiswadetail.html?id=' + data.idFavorit + '">'+
		// 	    		'<img src="img/'+data.gambarFavorit+'" style="width:80px; height:80px;"><h2>'+data.judulFavorit+'</h2><p>'+data.desFavorit+'</p>'+'<p>'+data.deadFavorit+'</p></a>'+
		// 	    		'<a onclick="if(confirm(\'Apakah Anda yakin untuk menghapus?\')){deleteBy('+data.id +')}">Delete</a>'+
		// 	    		'</li>'	
		// 	    	);
		// 	    	$('#listbeasiswaku').listview('refresh');
		// 	    }
		// 	}

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
			    		'<img src="img/'+data.gambarFavorit+'" style="width:80px; height:80px;"><h2>'+data.judulFavorit+'</h2><p>'+data.desFavorit+'</p>'+'<p>'+data.deadFavorit+'</p></a>'+
			    		'<a onclick="if(confirm(\'Apakah Anda yakin untuk menghapus?\')){deletex('+data.idFavorit +')}">Delete</a>'+
			    		'</li>'	
			    	);
            //$('<a href="#" onClick="deleteBy('+data.id+');">Hapus</a>').appendTo('#listbeasiswaku');
			    	$('#listbeasiswaku').listview('refresh');

			    }
			}

		function deletex(id){
			deleteBy(id);
			kirimsql(id);
		}

        function deleteBy(id) {
				var db = window.openDatabase("beasiswadb", "1.0", "beasiswaku_DB", 200000);	
			   
			    db.transaction(function(tx) { 
			    	var sql = "DELETE FROM beasiswaku WHERE idFavorit = ?";
			    	tx.executeSql(sql, [id]);
			    }, messageError);

				db.transaction(read, messageError);
			    alert("Beasiswa telah terhapus");

			    // db.transaction(function(tx) { 
			    // 	var dsql = "SELECT * FROM beasiswaku WHERE id = ?";
			    // 	tx.executeSql(dsql, [id]);
			    // },kirimsql);
			    // db.transaction(read, kirimsql);

			}
		
			function messageError(tx, error) {
			    alert("Database Error: " + error);
			}

			function kirimsql(id){
				// var id = '';
			 //  var data = hasil.rows.length;
			 //  for(var i=0;i<=data;i++){
			  //var baris = hasil.rows.item(i);
			  //var id = baris.idFavorit;
			  //var id2 = 1;
			  var uid = localStorage.getItem("username");
					  $.ajax({
				        type : 'POST',
				        url : 'http://localhost/intergrasi/scholarapp/services/updatebeasiswaku.php',
				        async: true,
				        beforeSend: function(x) {
				            if(x && x.overrideMimeType) {
				                 x.overrideMimeType("application/j-son;charset=UTF-8");
				            }
				        },
				        data : {
				            getid : id,
				            uid : uid
				        },
				        dataType : 'json',
				        success : function(result){
				        	if(result.status==true)
				                console.log(result);
				            }
				    });
			}
		// }