var serviceURL = "http://localhost/skripsiku/scholar/Scholarapp/services/"; //akses localhost
//var serviceURL = "http://192.168.242.1/skripsiku/scholar/scholarapp/services/"; //akses via wifi
//var serviceURL = "http://scholarshipadv.16mb.com/service/"; //akses via idhostinger
var rekomendasites;

$('#rektes').bind('pageinit', function(event) {
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
}