var serviceURL = "http://localhost/intergrasi/Scholarapp/services/searchsawt.php";
var loginpage = "http://localhost/intergrasi/Scholarapp/assets/login.html";
// localStorage.setItem("username",adam);
//localStorage.getItem("username");

$(document).on('pagebeforeshow','#filter', function () {
    if(localStorage.getItem("username") === undefined || localStorage.getItem("username") == null){
           // $.mobile.changePage("login.html");
          //window.location = loginpage;
          alert("kamu harus login dulu");
          location.href = "login.html";
          //e.preventDefault();
        }else{
            //$.mobile.changePage("#pageYYY");
        filterpage();
      }
});
 
function filterpage(){

      $(document).on('click', '#submitfil', function(event) {
      if($("#update:checked").length == 1) update =1; else update = 0;
      //ar buttonLeech = $("#simpan");
      //var filter = $("#filterform").serializeObject();
      event.preventDefault();
      //console.log(filter);
         $('#loading').show();
        $.ajax({
        type: "GET",
        url:  "http://localhost/intergrasi/Scholarapp/services/searchsawt.php",
        data: {act: 'grab',kat: $('#kategori').val(),jur: $('#program').val(),neg: $('#negara').val(),update: update},
        // beforeSend: function(){
        //     buttonLeech.addClass('btn-warning').val('Wait').attr('disabled','disabled');
        //   },
        dataType : 'json',
        success: function (result) {
              alert(result);
              console.log(result)
              //alert("suskses");
              var cek = JSON.stringify(result);
              if(cek=='"No rows found"'){
                alert('Tidak ada pesanan')
                location.reload();
                //get_pesanan();
              }
              else{
                //$('#filtertampil').bind('pageinit', function(result){
                  $('#beasiswalist li').remove();
                  var beasiswa = result.items;
                  $.each(beasiswa, function(index, beasiswa) {
                    $('#beasiswalist').append('<li><a href="beasiswadetail.html?id=' + beasiswa.id + '">' +
                        // '<img src="img/' + beasiswa.pic_normal + '"/>' +
                        '<h1>' + beasiswa.nama_beasiswa + '</h1>' +
                        '<p>' + beasiswa.jurusan + '</p>' +
                        '<p>' + beasiswa.negara + '</p>' +
                        '<p>' + beasiswa.univ + '</p>' +
                        // '<p>' + beasiswa.jurusan + '</p>' +
                        '<p>' + '<b>Deadline :</b>' + ' ' + beasiswa.deadline +'/p></li>'); 
                      });
                    $('#beasiswalist').listview('refresh');
                     $('#loading').hide();
                  //});
              }
        },
        // error: function(d) {
        //   console.log(d);
        //   buttonLeech.addClass('btn-danger').val('error');
        //   setTimeout(function () {
        //     buttonLeech.removeAttr('disabled').removeClass('btn-danger btn-warning').html('<i class="icon-ok-circle"></i> Proses'); 
        //   }, 2000);
        // }
      });
  });
}