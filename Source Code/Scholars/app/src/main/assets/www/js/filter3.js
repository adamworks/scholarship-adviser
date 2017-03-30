var serviceURL = "http://localhost/intergrasi/Scholarapp/services/";

$(document).on('pagebeforeshow', '#filter', function(){  
	 //var kategori = $('#').val();

    	$(document).on('click', '#submitfil', function(event) {
		 //$('#submitfil').click(function(event){
		 	//$('input, select').change(function(){
		 	event.preventDefault();
		 	 var filter = $("#filterform").serializeObject();
		 	 console.log(filter);
			 //$('#result').text(JSON.stringify(data));
			 $.ajax({
					 type: 'POST',
					 url: 'http://localhost/skripsiku/scholar/scholarapp/services/filter.php',
					 data: $.param({
					 	filterdata : filter
					 }),
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
								$.mobile.changePage('second.html', { dataUrl : "result", data : cek , reloadPage : false, changeHash : true });
								//});
						}
					}
						
				 });
		});
});

$(document).on('pageshow', "#second",function () {
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
            // //alert(parameter);
        });

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
	