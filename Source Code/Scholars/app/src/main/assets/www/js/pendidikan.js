// //var serviceURL = "http://localhost/temporary/Scholarapp/services/"; //akses localhost
// var serviceURL = "http://dbbeasiswa.site50.net/services/";
var serviceURL = "http://dbbeasiswa.16mb.com/services/";
//var serviceURL = "http://192.168.242.1/skripsiku/scholar/scholarapp/services/"; //akses via wifi
//var serviceURL = "http://scholarshipadv.16mb.com/service/"; //akses via idhostinger

var pendidikan;

//membuat fungsi xss domain dan konfigurasi phonegap
$('#pendidikan').bind('pageinit', function(event) {
	getpendidikan();
});

//fungsi getbeasiswa
function getpendidikan() {
	$.getJSON(serviceURL + 'getpendidikan.php', function(data) {
		$('#pendidikanlist li').remove();
		pendidikan = data.items;
		$.each(pendidikan, function(index, pendidikan) {
			$('#pendidikanlist').append('<li><a href="pendidikandetail.html?id=' + pendidikan.id_pendidikan + '">' +
					
					'<h1>' + pendidikan.nama_pendidikan + '</h1></li>'); 
		});
		$('#pendidikanlist').listview('refresh');
	});
}