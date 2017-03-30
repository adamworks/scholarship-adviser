$(document).on('click', '#simpan', function(e) {
	function saveFavorit(){
		var id = sessionStorage.getItem('id');
	    $.ajax({
	        type : 'POST',
	        url : 'http://www.resepfinder.web.id/favorite.php',
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
	                console.log(r.favorit);
	            });
	        },
	    });
	}
    
    
    var idValue = JSON.parse(window.localStorage.getItem('idLocal'));
    var judulValue = window.localStorage.getItem("judulLocal");
    var gambarValue = window.localStorage.getItem("gambarLocal");
    var isiValue = window.localStorage.getItem("isiLocal");
    var urlValue = window.localStorage.getItem("urlLocal");
    
    var db = window.openDatabase("resepdb", "1.0", "Resep_DB", 200000);
    //db.transaction(read, messageError);
    db.transaction(createTable, messageError);
    db.transaction(simpan, messageError);
    
    function createTable(tx) {
        var sql = 
            "CREATE TABLE IF NOT EXISTS MyFavorite ( "+
            "id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, " +
            "idFavorit INTEGER, " +
            "judulFavorit TEXT, " +
            "gambarFavorit TEXT, " +
            "isiFavorit TEXT, " +
            "urlFavorit TEXT)";
        tx.executeSql(sql);
    }

    function simpan(tx){
    	db.transaction(function(tx) { 
        	var cekData = "select * FROM MyFavorite WHERE idFavorit = ?";
	    	var sql = 'INSERT INTO MyFavorite (idFavorit, judulFavorit, gambarFavorit,isiFavorit, urlFavorit) VALUES ('+idValue+','+judulValue+','+gambarValue+','+isiValue+','+urlValue+')';
	    	tx.executeSql (cekData, [idValue],
	    	function (tx, result){
	    		if (result.rows.length){
	    			alert("Data resep favorit sudah ada");
			   	}
			   	else {
			   		tx.executeSql(sql);
        			alert("Data Resep Berhasil Disimpan");
        			saveFavorit();        			
        		}        		
	    	}, messageError);
	    });
    }
	
	function dropTable(tx){
        var sql = "DROP TABLE MyFavorite";
        tx.executeSql(sql);
        alert('Hapus table berhasil');
    }
    function messageError(tx, error) {
        alert("Database Error: " + error);
    }
});
