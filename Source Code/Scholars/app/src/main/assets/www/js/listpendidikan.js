var serviceURL = "http://localhost/intergrasi/Scholarapp/services/"; //akses localhost
//var serviceURL = "http://192.168.242.1/skripsiku/scholar/Scholarapp/services/"; //akses via wifi
//var serviceURL = "http://scholarshipadv.16mb.com/service/"; //akses via idhostinger

var lpendidikan;

//membuat fungsi xss domain dan konfigurasi phonegap
$('#listpendidikan').bind('pageinit', function(event) {
	getpendidikanList();
});

//fungsi getbeasiswa
function getpendidikanList() {
	$.getJSON(serviceURL + 'getlistpendidikan.php', function(data) {
		$('#listpendidikan li').remove();
		lpendidikan = data.items;
		$.each(lpendidikan, function(index, beasiswa) {
			$('#lpendidikan').append('<li><a href="beasiswadetail.html?id=' + beasiswa.id + '">' +
					'<img src="img/' + beasiswa.gambartemp + '"/>' +
					'<h1>' + beasiswa.nama_beasiswa + '</h1>' +
					'<p>' + beasiswa.deskripsi + '</p>' +
					'<p>' + '<b>Deadline :</b>' + ' ' + beasiswa.deadline + '</p>'+
					'<P><b>' + 'Tag:' + ' ' + beasiswa.kategoritemp +'</b></p></li>'); 
		});
		$('#lpendidikan').listview('refresh');
	});
}