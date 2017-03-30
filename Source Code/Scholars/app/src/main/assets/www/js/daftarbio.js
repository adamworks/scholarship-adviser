$(document).on('pageshow', '#daftarbio', function(){ 
$(document).on('click', '#submitbio', function(event){


// function register() {
	//var url_admin    ='../www/home.html';
	//var biodatapage    ='http://localhost/intergrasi/scholarapp/assets/www/daftarbio.html';
	//var filter = $("#login").serializeObject();
	//console.log(filter);
	 // if(localStorage.getItem("status") === undefined || localStorage.getItem("status") == null){
	 // 	var status = 0;
	 // }
	 // else{
	 // 	var status = localStorage.getItem("status");
	 // }

	var username = window.localStorage.getItem('username');
	//if($("#gender:checked").length == 0) pilih ="laki"; else pilih = "perempuan";
	var pilih = $('input[name="gender"]:checked').val();
	//var gender = $('input:radio[gender]:checked').val();
	var fname = $('#fname').val();
	var lname = $('#lname').val();
	// var alamat = $('#alamat').val();
	var birth = $('#bday').val();
	var pend = $('#kategori').val();
	var univ = $('#universitas').val();
	// var univ = $('input[id="univ"]').val();
	var prodi = $('#program').val();
	//var alamat = $('$alamat').val();

	// var email = $('#email').val();
 //    var password = $('#pass').val();
    //console.log(event);
    
	//hideshow('loading',1);
	// error(0);
	// sukses(0);

	//backup data
	// alamat: alamat,
			//birth : birth,
			//gender : gender,
	console.log(pilih);
	$.ajax({
		type: "GET",
		//url: "http://dbbeasiswa.site50.net/services/daftarbio.php",
		url: "http://dbbeasiswa.16mb.com/services/daftarbio.php",
		data: {
			fnama : fname,
			lnama : lname,
			univ : univ,
			user : username,
			pend : pend,
			prodi : prodi,
			gender: pilih,
			birth : birth
			// status : status
		},
		dataType: 'json',
		success: function(msg) {
			if(parseInt(msg.status)==1) {
			//console.log(filter);
			   // sukses(1,msg.txt);
			   // $('#error').removeClass('error').addClass('sukses');
			   // $("#userid").val('');
			   // $("#email").val('');
			   // $("#pass").val('');
			   alert("data berhasil");
			   //localStorage.setItem('status', 1);
			   window.location.href = '../www/home.html';
			   //event.preventDefault();
			  // window.localStorage.setItem('username',username);
			   //sessionStorage.setItem('username', username);
			   // $("#gender").val('Pilih Gender;');
			   // $("#tgl").val('Tanggal:');
			   // $("#bulan").val('Bulan:');
			   // $("#tahun").val('Tahun:');			
			}
			else if(parseInt(msg.status)==0) {
				alert('Logon unsuccessful!');
				// error(1,msg.txt);
				// $('#error').removeClass('sukses').addClass('error');
			}			
			//hideshow('loading',0);			
	 }
	});
//}
});
});
// //SerializeObjct ver.1
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