
//var serviceURL = "http://dbbeasiswa.site50.net/services/"; //akses via wifi
var serviceURL = "http://dbbeasiswa.16mb.com/services/";
//var serviceURL = "http://localhost/temporary/Scholarapp/services/";

//var beasiswa;

//membuat fungsi xss domain dan konfigurasi phonegap
$('#home').bind('pageinit', function(event) {
	getBeasiswaList();
	 //localStorage.setItem('username', username);
});

//fungsi getbeasiswa
function getBeasiswaList() {
	$.getJSON(serviceURL + 'getbeasiswa.php', function(data) {
		$('#beasiswalist li').remove();
		var beasiswa = data.items;
		$.each(beasiswa, function(index, beasiswa) {
			$('#beasiswalist').append('<li><a href="beasiswadetail.html?id=' + beasiswa.id + '">' +
											'<img src="img/' + beasiswa.pic_normal + '"/>' +
											'<h1>' + beasiswa.judul_beasiswa + '</h1>' +
                                            '<p>' + '<b>Jenjang Pendidikan :</b>' + beasiswa.jenjang + '</p>' +
                                            '<p>' + '<b>Negara :</b>' + beasiswa.negara + '</p>'+
                                            '<p>' + '<b>Instansi :</b>' + beasiswa.penyedia + '</p>' +
                                            '<p>' + '<b>Deadline :</b>' + ' ' +'<b>'+ beasiswa.deadline2 +'</b>' + ' ' + '</p></li>');
											// '<p class="ui-li-aside" style="margin-top:90px;">' + '<b>Deadline :</b>' + ' ' + beasiswa.deadline2 +'<b>' + ' ' + '</p></li>');
											// '<p>' + beasiswa.deskripsi + '</p>' +
                                            //'<p class="ui-li-aside" style="margin-top:7px;">' + '<b>Deadline :</b>' + ' ' + beasiswa.deadline +'<b>' + ' ' + '</p><p class="ui-li-aside" style="margin-top:50px;">' +'<b>Tag:</b>' + ' ' + beasiswa.array_tag +'</p></li>');
											 
										});
									$('#beasiswalist').listview('refresh');
	});
}