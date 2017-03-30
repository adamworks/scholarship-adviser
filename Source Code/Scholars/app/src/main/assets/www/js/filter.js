var serviceURL = "http://localhost/temporary/Scholarapp/services/"; //akses localhost
//var serviceURL = "http://192.168.242.1/skripsiku/scholar/scholarapp/services/"; //akses via wifi
//var serviceURL = "http://scholarshipadv.16mb.com/service/"; //akses via idhostinger

$(document).ready(function){
	$('#submitfil').submit(function(e)){
		register();
		e.preventDefault();
	}
}
	function register(){
		$.ajax({
			type 	: 'POST',
			url 	: 'http://localhost/temporary/service/filter.php',
			dataType: 'json',
			data 	: $('#submitfil').serialize(),
			success	: function(msg){
				var AmbilData = data.items;
	            $.each(AmbilData, function(i, r) {
	                console.log(r.count);
	                 window.location.href = tampilfilter.html;	
	             });
			}
		});
	}

/*$(document).on('click', '#submitfil', function(e){
	function filter(){
    //Mengambil value 
	var selectedLanguage = new Array();
	$('input[name="pendidikan"]:checked').each(function() {
		selectedLanguage.push(this.value);
	});
	
    /*var sarjana = $('#S1').val();
	var master = $('#S2').val();
	var doktor = $('#S3').val();*/

    //Ubah alamat url berikut, sesuaikan dengan alamat script pada komputer anda
    //var url_login    ='http://localhost/login4/login.php';
    //var url_admin    ='http://localhost/login4/admin.php';
     
    //Ubah tulisan pada button saat click login
    //$('#btnLogin').attr('value','Silahkan tunggu ...');
     
    //Gunakan jquery AJAX
    /*$.ajax({
    	//Method pengiriman
        type    : 'POST',
        url     : 'http://localhost/scholarapp/service/filter.php',
        //data    : 'var_s1='+sarjana+'&var_master='+master+'&var_doktor='+doktor+,
		data 	: { getdata : selectedLanguage,
		},       
        //dataType: 'html',
        //Respon jika data berhasil dikirim
        async: true,
	        beforeSend: function(x) {
	            if(x && x.overrideMimeType) {
	                 x.overrideMimeType("application/j-son;charset=UTF-8");
	            }
	        },
	    dataType : 'json',
	        success : function(data){
	            var AmbilData = data.items;
	            $.each(AmbilData, function(i, r) {
	                console.log(r.count);
	                 window.location.href = tampilfilter.html;
	            });
	        },
    });
 }
});
//var filter;*/

//membuat fungsi xss domain dan konfigurasi phonegap
$('#tampilfilter').on('pageinit', function(event) {
	filtertampil();
});

//fungsi getbeasiswa
function filtertampil() {
	$.getJSON(serviceURL + 'getfilter.php', function(data) {
		$('#filterlist li').remove();
		var filterdata = data.items;
		$.each(filterdata, function(index, beasiswa) {
			$('#filterlist').append('<li><a href="beasiswadetail.html?id=' + beasiswa.id + '">' +
					'<img src="img/' + beasiswa.gambartemp + '"/>' +
					'<h1>' + beasiswa.nama_beasiswa + '</h1>' +
					'<p>' + beasiswa.deskripsi + '</p>' +
					'<p>' + '<b>Deadline :</b>' + ' ' + beasiswa.deadline +'<b>' + ' ' + 'Tag:' + ' ' + beasiswa.kategoritemp +'</b></p></li>'); 
		});
		$('#filterlist').listview('refresh');
	});
}
