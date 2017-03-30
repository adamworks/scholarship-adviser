//var serviceURL = "http://localhost/temporary/Scholarapp/services/";
//var serviceURL = "http://dbbeasiswa.site50.net/services/";
var serviceURL = "http://dbbeasiswa.16mb.com/services/";
var beasiswa;

$('#detailjurusan').live('pageshow', function(event) {
	// var id = getUrlVars()["id"];
	//var id = sessionStorage.getItem('id');
	detailjurusan();
	// $.getJSON(serviceURL + 'getdetailjurusan.php?id='+id, detailjurusan);
	//$.getJSON(serviceURL + 'rekomendasi.php?id='+id, getrekomendasi, function(data));
});

function detailjurusan() {
	var id = getUrlVars()["id"];
	$.getJSON(serviceURL + 'getdetailjurusan.php?id='+id, function(data){
	$('#detailjurusanli li').remove();
		beasiswa = data.items;
		$.each(beasiswa, function(index, beasiswa) {
			$('#detailjurusanli').append('<li><a href="beasiswadetail.html?id=' + beasiswa.id + '">' +
					'<img src="img/' + beasiswa.pic_normal + '"/>' +
					'<h1>' + beasiswa.judul_beasiswa + '</h1>' +
                    '<p>' + '<b>Jenjang Pendidikan :</b>' + beasiswa.jenjang + '</p>' +
                    '<p>' + '<b>Negara :</b>' + beasiswa.negara + '</p>'+
                    '<p>' + '<b>Instansi :</b>' + beasiswa.univ + '</p>' +
                    '<p class="ui-li-aside" style="margin-top:90px;">' + '<b>Deadline :</b>' + ' ' + beasiswa.deadline2 +'<b>' + ' ' + '</p></li>');
		});
		$('#detailjurusanli').listview('refresh');
	});

}
//membuat fungsi xss domain dan konfigurasi phonegap
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
