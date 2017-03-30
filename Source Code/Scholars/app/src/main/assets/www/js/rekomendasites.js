//var serviceURL = "http://localhost/skripsiku/scholar/Scholarapp/services/"; //akses localhost
var serviceURL = "http://192.168.242.1/skripsiku/scholar/Scholarapp/services/"; //akses via wifi
//var serviceURL = "http://scholarshipadv.16mb.com/service/"; //akses via idhostinger
//var rekomendasites;

/*$('#detailbeasiswa').bind('pageinit', function(event) {
	getrekomendasi();
});

//fungsi getrekomendasi
function getrekomendasi() {
	$.getJSON(serviceURL + 'rekomendasi.php', function(data) {
		$('#rekomendasi li').remove();
		rekomendasites  = data.items;
		$.each(rekomendasites, function(index, beasiswa) {
			$('#rekomendasi').append('<li><a href="beasiswadetail.html?id=' + beasiswa.id + '">' +
					'<img src="img/' + beasiswa.gambartemp + '"/>' +
					'<h1>' + beasiswa.nama_beasiswa + '</h1>' +
					'<p>' + beasiswa.Deskripsi + '</p>' +
					'<p>' + '<b>Deadline :</b>' + ' ' + beasiswa.deadline + '</p>'+
					'<P><b>' + 'Tag:' + ' ' + beasiswa.kategoritemp +'</b></p></li>'); 
		});
		$('#rekomendasi').listview('refresh');
	});
}*/

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
					'<img src="img/' + beasiswa.gambartemp + '"/>' +
					'<h1>' + beasiswa.nama_beasiswa + '</h1>' +
					'<p>' + beasiswa.Deskripsi + '</p>' +
					'<p>' + '<b>Deadline :</b>' + ' ' + beasiswa.deadline + '</p>'+
					'<P><b>' + 'Tag:' + ' ' + beasiswa.kategoritemp +'</b></p></li>'); 
		});
		$('#rekomendasi').listview('refresh');

}

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