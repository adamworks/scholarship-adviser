var serviceURL = "http://localhost/temporary/Scholarapp/services/";
var loginpage = "http://localhost/temporary/Scholarapp/assets/login.html";
// localStorage.setItem("username",adam);
//localStorage.getItem("username");

$(document).on('pagebeforeshow','#filter', function () {
    if(localStorage.getItem("username") === undefined || localStorage.getItem("username") == null){
           // $.mobile.changePage("login.html");
        	//window.location = loginpage;
        	alert("kamu harus login dulu");
        	location.href = "login.html";
        	e.preventDefault();
        }else{
            //$.mobile.changePage("#pageYYY");
        filterpage();
    	}
});

function filterpage(){
//$(document).on('pageinit', '#filter', function(){  
	 //var kategori = $('#').val();
	 // var url_login    ='http://localhost/intergrasi/Scholarapp/assets/www/login.html';
	 // checkPreAuth();
    	$(document).on('click', '#submitfil', function(event) {
		 if($("#update:checked").length == 1) update =1; else update = 0;
      //ar buttonLeech = $("#simpan");
      //var filter = $("#filterform").serializeObject();
      event.preventDefault();
      //console.log(filter);
         $('#loading').show();
        $.ajax({
        type: "GET",
        url:  "http://localhost/temporary/Scholarapp/services/searchfin.php",
        data: {act: 'grab',kat: $('#kategori').val(),pro: $('#program').val(),neg: $('#negara').val(),update: update},
					 // data: $.param({
					 // 	filterdata : filter
					 // }),
					 dataType: 'json',
					 success: function(result){
					 	//alert("suskses");
					 	alert(result);
             			console.log(result)
					 	var cek = JSON.stringify(result);
					 	if(cek=='"No rows found"'){
							alert('Tidak ada pesanan')
							location.reload();
							//get_pesanan();
						}
						else{
							//$('#filtertampil').bind('pageinit', function(result){
								$('#loading').hide()
							 	$('#beasiswalist li').remove();
							 	var beasiswa = result.items;
							 	$.each(beasiswa, function(index, beasiswa) {
									// $('#beasiswalist').append('<li><a href="beasiswadetail.html?id=' + beasiswa.id + '">' +
									// 		'<img src="img/' + beasiswa.pic_normal + '"/>' +
									// 		'<h1>' + beasiswa.nama_beasiswa + '</h1>' +
									// 		'<p>' + beasiswa.deskripsi + '</p>' +
									// 		'<p>' + beasiswa.kategori + '</p>' +
									// 		'<p>' + beasiswa.negara + '</p>' +
									// 		'<p>' + beasiswa.jurusan + '</p>' +
									// 		'<p>' + '<b>Deadline :</b>' + ' ' + beasiswa.deadline +'<b>' + ' ' + 'Tag:' + ' ' + beasiswa.array_tag +'</b></p></li>'); 
									// 	});
									// $('#beasiswalist').listview('refresh');
									$('#beasiswalist').append('<li><a href="beasiswadetail.html?id=' + beasiswa.id + '">' +
											'<img src="img/' + beasiswa.pic_normal + '"/>' +
											'<h1>' + beasiswa.nama_beasiswa + '</h1>' +
                                            '<p>' + '<b>Jenjang Pendidikan :</b>' + beasiswa.jenjang + '</p>' +
                                            '<p>' + '<b>Negara :</b>' + beasiswa.negara + '</p>' +
                                            '<p>' + '<b>Universitas :</b>' + beasiswa.univ + '</p>' +
											// '<p>' + beasiswa.deskripsi + '</p>' +
                                            //'<p class="ui-li-aside" style="margin-top:7px;">' + '<b>Deadline :</b>' + ' ' + beasiswa.deadline +'<b>' + ' ' + '</p><p class="ui-li-aside" style="margin-top:50px;">' +'<b>Tag:</b>' + ' ' + beasiswa.array_tag +'</p></li>');
											'<p class="ui-li-aside" style="margin-top:35px;">' + '<b>Deadline :</b>' + ' ' + beasiswa.deadline +'<b>' + ' ' + '</p></li>'); 
										});
									$('#beasiswalist').listview('refresh');
									
								//});
						}
					}
						
				 });
		});

//});
//SerializeObjct ver.1
$.fn.serializeObject = function() {
    var o = Object.create(null),
        elementMapper = function(element) {
            element.name = $.camelCase(element.name);
            return element;
        },
        appendToResult = function(i, element) {
            var node = o[element.name];

            if ('undefined' != typeof node && node !== null) {
                o[element.name] = node.push ? node.push(element.value) : [node, element.value];
            } else {
                o[element.name] = element.value;
            }
        };

    $.each($.map(this.serializeArray(), elementMapper), appendToResult);
    return o;
};
}
//serializeObjct ver.2

/*$.fn.serializeObject = function(){
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};*/
	