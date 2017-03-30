//var serviceURL = "http://localhost/temporary/Scholarapp/services/"; //akses localhost
//var serviceURL = "http://dbbeasiswa.site50.net/services/";
var serviceURL = "http://dbbeasiswa.16mb.com/services/";
//var serviceURL = "http://192.168.242.1/skripsiku/scholar/scholarapp/services/"; //akses via wifi
//var serviceURL = "http://scholarshipadv.16mb.com/service/"; //akses via idhostinger
var redirect = "http://localhost/temporary/Scholarapp/assets/www/";

var user;

//membuat fungsi xss domain dan konfigurasi phonegap
// $('#userdetail').live('pageshow', function(event) {
// 	getuserdetail();
// });

$(document).on('pageshow','#userdetail', function (event) {
    if(localStorage.getItem("username") === undefined || localStorage.getItem("username") == null){
           // $.mobile.changePage("login.html");
        	//window.location = loginpage;
        	//alert("kamu harus login dulu");
        	location.href ="../www/login.html";
        	event.preventDefault();
        }else{
            //$.mobile.changePage("#pageYYY");
        	var name = window.localStorage.getItem('username');
			getuserdetail(name);
				
    	}
});	

//fungsi getbeasiswa
function getuserdetail(name) {
	$.getJSON(serviceURL + 'getuser.php?fnama='+name, function(data) {
		// $('#userlist li').remove();
		user = data.item;
		//var fnama =strtoupper(user.fnama);
		//$('#gambar').attr('src', 'img/' + user.foto_kecil);
		$('#nama').text(user.fnama + " " + user.lnama );
		$('#univ').text(user.nama_univ);
		$('#jurusan').text(user.nama_jurusan);
		$('#nick').text(user.username);
		
		//$('#judul').append( beasiswa.id );
		// $('#deskripsi').text(user.tgl_lahir);
		// $('#deadline').text(user.gender);
		// if (user.gender) {
		// 	$('#userlist').append('<li>' + '<h3>Informasi Pribadi</h3>' +
		// 			'<p>'+'<b>Gender :</b>'+ user.gender + '</p>' +
		// 			'<p>'+'<b>tanggal lahir :</b>' + user.birth + '</p></li>');
		// }
		// if (user.tgl_lahir) {
		// 	$('#userlist').append('<li>' + '<h3>Negara</h3>' +
		// 			'<p>' + user.tgl_lahir + '</p></a></li>');
		// }
		// if (beasiswa.ipk) {
		// 	$('#actionList').append('<li>' + '<h3>IPK</h3>' +
		// 			'<p>' + 'IPK minum :' + '' + beasiswa.ipk + '</p></a></li>');
		// }

		// $('#userbio').append('<li><h3>Tanggal Lahir</h3>' +
		// 			'<p>' + user.t+ '</p></li>');
		// $('#userbio').listview('refresh');


		if (user.gender) {
			$('#userbio').append('<li><h3>Gender</h3>' +
					'<p>' + user.gender+ '</p></li>');
		}
		if (user.tanggal_lahir) {
			$('#userbio').append('<li><h3>Tanggal Lahir</h3>' +
					'<p>' + user.tanggal_lahir+ '</p></li>');
		}
		$('#userbio').listview('refresh');



		if (user.nama_jurusan) {
			$('#userlist').append('<li><h3>Jurusan</h3>' +
					'<p>' + user.nama_jurusan+ '</p>'+
					'</li>');
		}
		if (user.nama_pendidikan) {
			$('#userlist').append('<li><h3>Pendidikan Terakhir</h3>' +
					'<p>' + user.nama_pendidikan+ '</p>'+
					'</li>');
		}
		if (user.nama_univ) {
			$('#userlist').append('<li><h3>Instansi Pendidikan</h3>' +
					'<p>' + user.nama_univ+ '</p>'+
					'</li>');
		}
		if (user.email) {
			$('#userlist').append('<li><a href="Membuka website:' + user.email + '"><h3>Website</h3>' +
					'<p>' + user.email+ '</p></a></li>');
		}
		$('#userlist').listview('refresh');
				var idFav = JSON.stringify(user.id);
				var namaFav = JSON.stringify(user.fnama);
				var nama2Fav = JSON.stringify(user.lnama);
				var emailFav = JSON.stringify(user.email);
				// var jenjangFav = JSON.stringify(beasiswa.nama_pendidikan);
				// var negFav = JSON.stringify(beasiswa.nama_negara);
				// var univFav = JSON.stringify(beasiswa.univ);
				//var tagFav = JSON.stringify(beasiswa.array_tag);
				
				window.localStorage.setItem('id',idFav);
				window.localStorage.setItem('nama',namaFav);
				window.localStorage.setItem('nama2',nama2Fav);
				//window.localStorage.setItem('desLocal',desFav);
				window.localStorage.setItem('email',emailFav);
				// window.localStorage.setItem('jenjangLocal',jenjangFav);
				// window.localStorage.setItem('negLocal',negFav);
				// window.localStorage.setItem('univLocal',univFav);
	});
}

$(document).on('pageshow','#useredit', function (event) {
	//var fnama = window.localstorage.getItem("gambarLocal");
	var fnama = window.localStorage.getItem('gambarLocal');
	var lnama = window.localStorage.getItem('judulLocal');
	
	var output = '<div data-role="fieldcontain">'+'<label for="editnamaawal" id="editnamaawal">Nama Pertama</label>'
    +'<input type="text" required="required" id="fname" value='+ fnama +' data-clear-btn="true"></input>'
    +'</div>'
    +'<div data-role="fieldcontain">'+'<label for="editnamaawal" id="editnamaawal">Nama Belakang</label>'
    +'<input type="text" required="required" id="fname" value='+ lnama +' data-clear-btn="true"></input>'
    +'</div>';

	$('#editform').html(output);

	
	//$('#editform').append();	
});