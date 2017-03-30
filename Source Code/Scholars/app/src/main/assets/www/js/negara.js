//var serviceURL = "http://localhost/temporary/Scholarapp/services/"; //akses localhost
// var serviceURL = "http://dbbeasiswa.site50.net/services/";
var serviceURL = "http://dbbeasiswa.16mb.com/services/";
//var serviceURL = "http://192.168.242.1/skripsiku/scholar/scholarapp/services/"; //akses via wifi
//var serviceURL = "http://scholarshipadv.16mb.com/service/"; //akses via idhostinger

var negara;

//membuat fungsi xss domain dan konfigurasi phonegap
$('#negara').bind('pageinit', function(event) {
	getnegara();
});

//fungsi getbeasiswa
function getnegara() {
	$.getJSON(serviceURL + 'getnegara.php', function(data) {
		$('#negaralist li').remove();
		negara = data.items;
		$.each(negara, function(index, negara) {
			$('#negaralist').append('<li><a href="negaradetail.html?id=' + negara.id_negara + '">' +
					
					'<h1>' + negara.nama_negara + '</h1></li>'); 
		});
		$('#negaralist').listview('refresh');
	});
}