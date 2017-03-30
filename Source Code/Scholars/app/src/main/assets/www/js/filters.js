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
      var katg = $('#kategori').val();
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
                   //result.preventDefault();

                   
                   $('#loading').hide();
                  tampil(katg);
        }
        // error: function(d) {
        //   console.log(d);
        //   buttonLeech.addClass('btn-danger').val('error');
        //   setTimeout(function () {
        //     buttonLeech.removeAttr('disabled').removeClass('btn-danger btn-warning').html('<i class="icon-ok-circle"></i> Proses'); 
        //   }, 2000);
        // }
      },
      });
      function tampil(katg){
            $.ajax({
                type : 'POST',
                url : 'http://localhost/intergrasi/Scholarapp/services/tampilsaw.php',
                async: true,
                beforeSend: function(x) {
                    if(x && x.overrideMimeType) {
                         x.overrideMimeType("application/j-son;charset=UTF-8");
                    }
                },
                data:{
                    kategori : countercari
                    //s : $('#s').val()
                },
                dataType : 'json',
                success : function(data){
                    var AmbilData = data.items;
                    if(data=='No rows found'){
                      alert("Data resep tidak ditemukan");
                       // $('#loading').hide();
                    }
                    else{
                        
                          $('#beasiswalist li').remove();
                          var beasiswa = data.items;
                          $.each(beasiswa, function(index, beasiswa) {
                          //   $('#beasiswalist').append('<li><a href="beasiswadetail.html?id=' + beasiswa.id + '">' +
                          //     '<img src="img/' + beasiswa.pic_normal + '"/>' +
                          //     '<h1>' + beasiswa.nama_beasiswa + '</h1>' +
                          //     '<p>' + beasiswa.deskripsi + '</p>' +
                          //     '<p>' + beasiswa.kategori + '</p>' +
                          //     '<p>' + beasiswa.negara + '</p>' +
                          //     '<p>' + beasiswa.jurusan + '</p>' +
                          //     '<p>' + '<b>Deadline :</b>' + ' ' + beasiswa.deadline +'<b>' + ' ' + 'Tag:' + ' ' + beasiswa.array_tag +'</b></p></li>'); 
                          //   });
                          // $('#beasiswalist').listview('refresh');


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
                            
                          //});
                      }
                    },
                //},
            });
            return false;
        }
          
    });
}