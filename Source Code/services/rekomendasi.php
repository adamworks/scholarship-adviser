<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include 'config.php';
  //$getid = $_GET['id'];
	
  $detail = mysql_query("SELECT * FROM db_scholarship WHERE id=".$_GET['id']);
	$d   = mysql_fetch_array($detail);
  $pisah_kata  = explode(",",$d['jurusan_tag']);
  $jml_katakan = (integer)count($pisah_kata);

  $jml_kata = $jml_katakan-1; 
  $ambil_id = $d['id'];

// rekomendasi berita //  
  // $cari = "SELECT * FROM db_scholarship b 
  // INNER JOIN db_katpendidikan p on b.id_pendidikan = p.id_pendidikan 
  // INNER JOIN db_katnegara n  on b.id_negara = n.id_negara 
  // INNER JOIN db_katjurusan j on b.id_jurusan = j.id_jurusan 
  // WHERE (b.id!=$ambil_id) and (" ;
  //   for ($i=0; $i<=$jml_kata; $i++){
  //     $cari .= "b.array_tag LIKE '%$pisah_kata[$i]%'";
  //         if ($i < $jml_kata ){
  //             $cari .= " OR ";}
  //           }
  // $cari .= ") ORDER BY id DESC LIMIT 5";

$cari = "SELECT b.id, b.judul_beasiswa, b.deadline2 , b.pic_normal ,b.univ, b.jurusan_tag,b.penyedia,
    GROUP_CONCAT(DISTINCT p.nama_pendidikan) as jenjang ,
    GROUP_CONCAT(DISTINCT n.nama_negara) as negara
    from db_scholarship b 
    INNER JOIN db_katpendidikan_hub ph on b.id = ph.id_beasiswa
    INNER JOIN db_katpendidikan p on ph.id_pendidikan = p.id_pendidikan 
    INNER JOIN db_katnegara_hub nh on b.id = nh.id_beasiswa
    INNER JOIN db_katnegara n on nh.id_negara = n.id_negara
    WHERE (b.id!=$ambil_id) and (" ;
    for ($i=0; $i<=$jml_kata; $i++){
      $cari .= "b.jurusan_tag LIKE '%$pisah_kata[$i]%'";
          if ($i < $jml_kata ){
              $cari .= " OR ";}
            }
  $cari .= ") GROUP BY id DESC LIMIT 5";
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