$(document).on('pageshow', '#login', function(){  
    $(document).on('click', '#btnLogin', function() {

    //Ubah alamat url berikutl, sesuaikan dengan alamat script pada komputer anda
    //var url_login    = "http://dbbeasiswa.site50.net/services/login.php";
    //var serviceURL = "http://dbbeasiswa.16mb.com/services/";
    //var url_login    = "http://dbbeasiswa.site50.net/services/login.php";
    var url_login    = "http://dbbeasiswa.16mb.com/services/login.php";
    //var url_admin    ='http://localhost/temporary/Scholarapp/assets/www/home.html';
    
    if($('#txt_username').val().length > 0 && $('#txt_password').val().length > 0){
    //Mengambil value dari input username & Password
    var username = $('#txt_username').val();
    var password = $('#txt_password').val();
    //var combobox = $().serilize
    //Ubah tulisan pada button saat click login
    //$('#btnLogin').attr('value','Silahkan tunggu ...');
     
    //Gunakan jquery AJAX
    $.ajax({
        url     : url_login,
        type    : 'POST',
        data: { 
                username : username,
                password : password
                },
        async: 'true',
                dataType: 'json',
                cache: false,
        //dataType: 'html',
        //Respon jika data berhasil dikirim
        success: function (result) {
                    if(result.status==true) {
                        //$.mobile.changePage("homenew.html");
                        //window.location.href = url_admin;
                        alert("selamat datang");
                        window.location.href ="../www/home.html";
                        //$.mobile.loadPage("home.html");
                        // sessionStorage.setItem('username', username);
                        // sessionStorage.setItem('password', password);
                        localStorage.setItem('username', username);
                        //localStorage.setItem('password', password);
                        
                                                
                    } else {
                        alert('Logon unsuccessful!'); 
                    }
                },
                error: function (request,error) {
                    // This callback function will trigger on unsuccessful action                
                    alert('Logon unsuccessful');
                }
            });
        }
    });

$(document).on('click', '#logout', function() {
        $.mobile.changePage("index.html");
        
        
    });
    
// function checkPreAuth() {
//     //var form = $("#loginForm");
//     if(window.localStorage["username"] != undefined && window.localStorage["password"] != undefined) {
//     $("#username", form).val(window.localStorage["username"]);
//     $("#password", form).val(window.localStorage["password"]);
//     handleLogin();
//     }
// }

// function handleLogin() {
// var form = $("#loginForm");
// //disable the button so we can't resubmit while we wait
// $("#submitButton",form).attr("disabled","disabled");
// var username = $("#username", form).val();
// var password = $("#password", form).val();
// console.log("click");
// if(username != '' && password!= '') {
// //$.post("http://www.coldfusionjedi.com/demos/2011/nov/10/service.cfc?method=login&returnformat=json", {username:u,password:p}, function(res) {
// $.post(serviceURL + 'localcek.php', {username:username,password:password}, function(res) {
//     if(res == true) {
//     //if(result.status==true) {
//     //store
//     window.localStorage["username"] = username;
//     window.localStorage["password"] = password;
//     $.mobile.changePage("some.html");
//     } else {
//     navigator.notification.alert("Your login failed", function() {});
//     }
//     $("#submitButton").removeAttr("disabled");
// },"json");
// } else {
// //Thanks Igor!
// navigator.notification.alert("You must enter a username and password", function() {});
// $("#submitButton").removeAttr("disabled");
// }
// return false;
// }

// function checkPreAuth() {  
//     if(window.localStorage["username"] != undefined && window.localStorage["password"] != undefined) {  
//         var u = window.localStorage["username"];  
//         var p = window.localStorage["password"];  
//         // ajaxData = "username=" + u + "&password=" + p ;  
//         // makerequest('rest/user/login', ajaxData).then(  
//             //Gunakan jquery AJAX
    
//     $.ajax({
//         url     : url_login,
//         type    : 'POST',
//         data: { 
//                 username : u,
//                 password : p
//                 },
//         async: 'true',
//                 dataType: 'json',
//                 cache: false,
//         //dataType: 'html',
//         //Respon jika data berhasil dikirim

//             function(data) {  
//                 if(result.status == true) {  
//                     //store  
//                     localStorage.setItem('username', username);
//                         localStorage.setItem('password', password);
//                     // window.localStorage["username"] = username;  
//                     // window.localStorage["password"] = password;               
//                     $.mobile.changePage("home.html");  
//                 } else {  
//                     $.mobile.changePage("login.html");  
//                 }  
//             }  
//         //     function() {  
//         //     // onFail - jqxhr_error }  
//         //     },  
//         //     function() {  
//         //     // allways  
//         //     }  
//         // );             
//          });
//     }  
// }  

});