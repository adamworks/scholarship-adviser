
// var serviceURL = "http://dbbeasiswa.site50.net/services/";
var serviceURL = "http://dbbeasiswa.16mb.com/services/";
var jurusan;

//membuat fungsi xss domain dan konfigurasi phonegap
$('#jurusan').bind('pageinit', function(event) {
	getjurusan();
});

//fungsi getbeasiswa
function getjurusan() {
	$.getJSON(serviceURL + 'getjurusan.php', function(data) {
		$('#jurusanlist li').remove();
		jurusan = data.items;
		$.each(jurusan, function(index, jurusan) {
			$('#jurusanlist').append('<li><a href="jurusandetail.html?id=' + jurusan.id_jurusan + '">' +
					
					'<h1>' + jurusan.nama_jurusan + '</h1></li>'); 
		});
		$('#jurusanlist').listview('refresh');
	});
}