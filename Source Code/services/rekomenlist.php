<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include 'config.php';
  //$fnama = "icon";
  $fnama = $_GET['fnama'];
  //$id = mysql_query("SELECT * FROM db_userdetail WHERE fnama='icon'");
  // $id = mysql_query("SELECT * FROM db_userdetail WHERE fnama='$fnama'");
  // $d   = mysql_fetch_array($id);
  // $idjur = $d["id_jurusan"];
  //echo $idjur;
  $user = mysql_query("SELECT * FROM db_user WHERE username='$fnama'");
  $d   = mysql_fetch_array($user);
  $uid = $d['id'];

  $detail = mysql_query("SELECT * FROM db_userdetail WHERE user_id='$uid'");
  $e   = mysql_fetch_array($detail);
  $idjur = $e['id_jurusan'];

  $jur = mysql_query("SELECT * FROM db_katjurusan WHERE id_jurusan='$idjur'");
  $f   = mysql_fetch_array($jur);
  $jurnam = $f['nama_jurusan'];
  //$idfak = $f['id_fakultas'];
  //echo $jurnam;

  //GANTI OREDER JADI TANGGAL//  
  // $cari = "SELECT  * FROM db_beasiswa b 
  // INNER JOIN  db_katpendidikan p on b.id_pendidikan = p.id_pendidikan 
  // INNER JOIN db_katnegara n  on b.id_negara = n.id_negara 
  // INNER JOIN db_katjurusan j on b.id_jurusan = j.id_jurusan 
  // WHERE b.array_tag LIKE '%$jurnam%' ORDER BY id LIMIT 5";

  //GANTI OREDER JADI TANGGAL//  
  $cari = "SELECT b.id, b.judul_beasiswa, b.deadline2 , b.pic_normal ,b.univ, b.jurusan_tag,b.penyedia,
    GROUP_CONCAT(DISTINCT p.nama_pendidikan) as jenjang ,
    GROUP_CONCAT(DISTINCT n.nama_negara) as negara
    from db_scholarship b 
    INNER JOIN db_katpendidikan_hub ph on b.id = ph.id_beasiswa
    INNER JOIN db_katpendidikan p on ph.id_pendidikan = p.id_pendidikan 
    INNER JOIN db_katnegara_hub nh on b.id = nh.id_beasiswa
    INNER JOIN db_katnegara n on nh.id_negara = n.id_negara
  WHERE b.jurusan_tag LIKE '%$jurnam%' GROUP BY b.id LIMIT 5";
  

  //$cetak = mysql_query($cari);
  //echo $cetak;
  // echo $cetak;
//!--UNTUK MENAMPILKAN DI PHP SAJA + HITUNG JUMLAH VIEW--!
  /*$hasil  = mysql_query($cari);
   if($hasil === FALSE) {
    die(mysql_error()); // TODO: better error handling
}
  while($h=mysql_fetch_array($hasil)){
  echo "<li><a href='#'>$h[nama_beasiswa]</a></li>";}      
  echo "</ul>";*/
  //mysql_query("UPDATE berita SET dibaca=$d[dibaca]+1 WHERE judul_seo='$_GET[judul]'");

//!--MENGIRIMKAN SEBAGAI ARRAY+JSON--!
  //echo $rek;
    /*$rek[]  = array('id' => $h['id'],
                'gambartemp' => $h['gambertemp'],
                'nama_beasiswa' => $h['nama_beasiswa'],
                'deskripsi' => $h['deskripsi'],
                'deadline' => $h['deadline'],
                'kategoritemp' => $h['kategoritemp'],
                );
    };
    /*header('Content-type: application/json');
    echo '{"items":'.json_encode($rek).'}';*/

//!--MENGIRIMKAN SEBAGAI JSON DENGAN PHP OBJEK--!
    try {
        $dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);  
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $dbh->query($cari);  
        $rekomendasi = $stmt->fetchAll(PDO::FETCH_OBJ);
        $dbh = null;
        echo '{"items":'. json_encode($rekomendasi) .'}'; 
        } 
    catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
        }


  		//mysql_query("UPDATE berita SET dibaca=$d[dibaca]+1 WHERE judul_seo='$_GET[judul]'");
?>