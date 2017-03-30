//var serviceURL = "http://localhost/temporary/Scholarapp/services/";
//var serviceURL = "http://dbbeasiswa.site50.net/services/";
var serviceURL = "http://dbbeasiswa.16mb.com/services/";
var loginpage = "http://localhost/temporary/Scholarapp/assets/login.html";
// localStorage.setItem("username",adam);
//localStorage.getItem("username");

$(document).on('pagebeforeshow','#filter', function () {
    /*if(localStorage.getItem("username") === undefined || localStorage.getItem("username") == null){
           // $.mobile.changePage("login.html");
        	//window.location = loginpage;
        	alert("kamu harus login dulu");
        	location.href ="../www/login.html";
        	e.preventDefault();
        }else{
            //$.mobile.changePage("#pageYYY");*/
        filterpage();
    	/*}*/
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
      // var dead = $("#deadline").val()
      // var tipe = $("#program").val()
      //console.log(tipe);
      //var dataarray = data.split(",");

      //backup program
       //$('#sertifikat').val().join(",")
        //console.log($('#sertifikat').val());
        // var sertifikat   = $('input[name=sertifikat]:checked').map(function(){
        //                 return $(this).val();
        //          }).get();
        var sertifikat = new Array();
        $("input[name=sertifikat]:checked").each(function() {
           sertifikat.push($(this).val());
        });
        //$('#sertifikat').val().join(",")
        //tipe:$("#tipex").val()

      //console.log(sertifikat);
      //var pro= $('#program').val();
        
//$('.val').click(function() {
  var val;
    $("input[data-type='search']").each(function () {
        val = $(this).val();
        //$('.values').append('Value: '+val);
    });
//});
        console.log(val);
         $('#loading').show();
        $.ajax({
        type: "GET",
        url:  serviceURL + "searchfin.php",
        data: {act: 'grab',kat: $('#kategori').val(),pro: val,neg: $('#negara').val(),update: 0 ,sertifikat:sertifikat,deadline:$("#deadlinex").val(),tipe:$('#tipex').val()},
					 // data: $.param({
					 // 	filterdata : filter
					 // }),
					 dataType: 'json',
					 success: function(result){
					 	//alert("suskses");
					 	//alert(result);
             			//console.log(result)
                       var jum =$(result.items).length;
                       console.log(result);
					 	var cek = JSON.stringify(result.items);
					 	if(cek=='"Data tidak ditemukan"'){
							alert(cek);
							//location.reload();
							//get_pesanan();
						}
						else{
							//$('#filtertampil').bind('pageinit', function(result){
                alert("terdapat"+" "+ jum +" "+"beasiswa");
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
											'<h4>' + beasiswa.judul_beasiswa + '</h4>' +
                      '<p>' + '<b>id:</b>' + beasiswa.id + '</p>' +
                                            '<p>' + '<b>Jenjang Pendidikan :</b>' + beasiswa.jenjang + '</p>' +
                                            '<p>' + '<b>Negara :</b>' + beasiswa.negara + '</p>' +
                                            '<p>' + '<b>Universitas :</b>' + beasiswa.univ + '</p>' +
                                            '<p>' + '<b>Deadline :</b>' + ' ' +'<b>'+ beasiswa.deadline2 +'</b>' + ' ' + '</p></li>');
											// '<p>' + beasiswa.deskripsi + '</p>' +
                                            //'<p class="ui-li-aside" style="margin-top:7px;">' + '<b>Deadline :</b>' + ' ' + beasiswa.deadline +'<b>' + ' ' + '</p><p class="ui-li-aside" style="margin-top:50px;">' +'<b>Tag:</b>' + ' ' + beasiswa.array_tag +'</p></li>');
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
	