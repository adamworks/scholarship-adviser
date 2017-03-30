$(document).on('pageshow', '#login', function(){ 
$(document).on('click', '#submitid', function(event){
// $(document).ready(function() {
// 	//$('#submitid').submit(function(e) {
// 		register();
// 		event.preventDefault();
// 	});
// //});

// function register() {
	//var url_admin   = 'http://localhost/intergrasi/scholarapp/assets/www/home.html';
	var biodatapage    ='http://localhost/temporary/scholarapp/assets/www/daftarbio.html';
	//var filter = $("#login").serializeObject();
	//console.log(filter);
	var username = $('#userid').val();
	var email = $('#email').val();
    var password = $('#pass').val();
    console.log();
	//hideshow('loading',1);
	// error(0);
	// sukses(0);		
	$.ajax({
		type: "POST",
		url: "http://dbbeasiswa.16mb.com/services/daftar.php",
		//data: $('#login').serialize(),
		// data: $.param({
		// 	daftar : filter
		// }),
		data: {
			username : username,
			email : email,
            password : password
		},
		dataType: 'json',
		success: function(msg) {
			if(parseInt(msg.status)==1) {
			   window.location.href ='../www/daftarbio.html';
			   window.localStorage.setItem('username',username);		
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