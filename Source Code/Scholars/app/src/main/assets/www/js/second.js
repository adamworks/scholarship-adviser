var serviceURL = "http://localhost/skripsiku/scholar/Scholarapp/services/";

$(document).on('pageshow', "#second",function(event){
	//var id = getUrlVars()["id"];
	//var id = sessionStorage.getItem('id');
	
	//$.getJSON(serviceURL + 'getdetailbeasiswa.php?id='+id, tampildetail);
	//$.getJSON(serviceURL + 'rekomendasi.php?id='+id, getrekomendasi, function(data));
	var parameters = $(this).data("url").split("?")[1];

	$.ajax({
					 type: 'POST',
					 url: 'http://localhost/skripsiku/scholar/scholarapp/services/filter.php',
					 // data: $.param({
					 // 	filterdata : filter
					 // }),
					 data: parameters,
					 dataType: 'json',
					 success: function(result){
					 	//alert("suskses");
					 	var cek = JSON.stringify(result);
					 	if(cek=='"No rows found"'){
							alert('Tidak ada pesanan')
							location.reload();
							//get_pesanan();
						}
						else{
							//$('#filtertampil').bind('pageinit', function(result){
								//$(document).on('pageshow', "#second",function(data) {
			$('#beasiswalist li').remove();
							 	var beasiswa = result.items;
							 	$.each(beasiswa, function(index, beasiswa) {
									$('#beasiswalist').append('<li><a href="beasiswadetail.html?id=' + beasiswa.id + '">' +
											'<img src="img/' + beasiswa.defgambar + '"/>' +
											'<h1>' + beasiswa.nama_beasiswa + '</h1>' +
											'<p>' + beasiswa.deskripsi + '</p>' +
											'<p>' + '<b>Deadline :</b>' + ' ' + beasiswa.deadline +'<b>' + ' ' + 'Tag:' + ' ' + beasiswa.jurusan +'</b></p></li>'); 
										});
									$('#beasiswalist').listview('refresh');


            // var parameters = $(this).data("url").split("?")[1];;
            // parameter = parameters.replace("input=","");
            // $('#tampil').append('<li>' + parameter + '</li>');
            //alert(parameter);
        // });      
								//});
						}
					}
						
				 });
	   
});