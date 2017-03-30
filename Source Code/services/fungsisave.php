<?php
function ceknegara($valuex4,$id){
   $negara = array();
   $sql = mysql_query("SELECT * FROM db_katnegara");
   // $row = mysql_fetch_array($sql);
   // $negaralist = $row['nama_negara_en'];

   while($row = mysql_fetch_array($sql)){
      //echo $row['nama_jurusan']."\n";
    if($id==4 || $id==1){
      $nama = explode(",",$row['nama_negara_en']);
        //echo $nama . "\n";
        foreach ($nama as $key => $value) {
          //echo $value . "\n";
         if(preg_match("/\b".$value."\b/i", $valuex4))
                {
                  //$negara[] = strtolower($value);
                  //$jurusan = cekjurusan($list);
                  // break;
                  $ubah = strtolower($value);
                  $indosql = mysql_query("SELECT nama_negara FROM db_katnegara WHERE find_in_set('$ubah',nama_negara_en)");
                  $indo = mysql_fetch_array($indosql);
                  $negara[] = $indo['nama_negara'];
                 }
        }
        
      // $nama = $row["nama_negara_en"];
      // echo $nama . "\n";
      // if(preg_match("/\b".$nama."\b/i", $valuex4))
      //           {
      //             $negara[] = strtolower($nama);
      //             //$jurusan = cekjurusan($list);
      //             // break;    
      //            }
          
        }
    elseif($id==2){
      $nama = $row["nama_negara"];
      echo $nama . "\n";
            if(preg_match("/\b".$nama."\b/i", $valuex4))
                {
                  $negara[] = strtolower($nama);
                  //$jurusan = cekjurusan($list);
                  // break;    
                 }
        }
    }//END WHILE

    if($id==3){
      $sql = mysql_query("SELECT * FROM db_katnegara WHERE nama_negara_en!='indonesia'");
      while($row = mysql_fetch_array($sql)){
      // $nama = $row["nama_negara"];
      // echo $nama . "\n";
        $nama = explode(",",$row['nama_negara_en']);
        //echo $nama . "\n";
        foreach ($nama as $key => $value) {
          //echo $value . "\n";
         if(preg_match("/\b(di|institusi|universitas)\s*".$value."\b/i", $valuex4))
                {
                  $negara[] = strtolower($value);
                  //$jurusan = cekjurusan($list);
                  // break;    
                 }
        }
       
      }
   }
    return $negara;
}

/* 
  KHUSUS PASCA ID=3
*/

function ceknegarax($valuex4,$id){
   $negara = array();
   if($id==3){
      $sql = mysql_query("SELECT * FROM db_katnegara WHERE nama_negara_en!='indonesia'");
      while($row = mysql_fetch_array($sql)){
      // $nama = $row["nama_negara"];
      // echo $nama . "\n";
        $nama = explode(",",$row['nama_negara_en']);
        //echo $nama . "\n";
        foreach ($nama as $key => $value) {
          //echo $value . "\n";
        if(preg_match("/\b(".$value.")\b/i", $valuex4))
                {
                  $negara[] = strtolower($value);
                  //$jurusan = cekjurusan($list);
                  // break;    
                 }
        }
      }
                 //elseif(preg_match("/".$nama."/i", $valuex4)){
                //   $negara[] = strtolower($nama);
                // }
   }
   return $negara;

}
function cekjurusan($valuex4,$id){
  $jurusan = array();
   $sql = mysql_query("SELECT * FROM db_katjurusan");
   // $row = mysql_fetch_array($sql);
   // //$jurusanlist = $row['nama_jurusan_en'];
   // $jurusanlist[] = $row['nama_jurusan'];

    while($row = mysql_fetch_array($sql)){
      //echo $row['nama_jurusan']."\n";
      if($id==2){
      $nama = $row["nama_jurusan"];
      if(preg_match("#".$nama."#i", $valuex4))
                {
                  $jurusan[] = strtolower($nama);
                  //$jurusan = cekjurusan($list);
                  // break;    
                }elseif(preg_match("#\b".$nama."\b#i", $valuex4)){
                  $jurusan[] = strtolower($nama);
                }
                // else{
                //   $jurusan[] = "semua jurusan/tertentu";
                // }
      }
      else{
        $nama = explode(",",$row['nama_jurusan_en']);
        //echo $nama . "\n";
        foreach ($nama as $key => $value) {
          //echo $value . "\n";
        if(preg_match("/".$value."/i", $valuex4)==true)
                {
                  $jurusan[] = strtolower($value);
                  //$jurusan = cekjurusan($list);
                  // break;    
                 }
        // else{
        //     $jurusan[]='any subject';
        //   }
        //}

        }
        //$nama = $row["nama_jurusan_en"];
        // if(preg_match("/".$nama."/i", $valuex4))
        //         {
        //           $jurusan[] = strtolower($nama);
        //           //$jurusan = cekjurusan($list);
        //           // break;    
        //         }
                // elseif(preg_match("/\b".$nama."\b/i", $valuex4)){
                //   $jurusan[] = strtolower($nama);
                // }
                // else{
                //   $jurusan[] = "any subject";
                // }
      }
   }


    return $jurusan;
}

//*SEMUA REGEX MENGGUNAKAN INI //

function jenjangid($jen){
  $k = count($jen);
    $list = array();
    //echo $k;
    if($k>0){
    for ($l = 0; $l < $k; $l++)
    {
        $jenx = mysql_real_escape_string($jen[$l]);
        $sqljen= mysql_query("SELECT id_pendidikan FROM db_katpendidikan WHERE nama_pendidikan='$jenx'") or die(mysql_error());
        $row = mysql_fetch_array($sqljen);
        $list[] = $row['id_pendidikan'];
          
    }
  }else{
    $jenx = mysql_real_escape_string($jen[$l]);
        $sqljen= mysql_query("SELECT id_pendidikan FROM db_katpendidikan WHERE nama_pendidikan='kategori lainnya'") or die(mysql_error());
        $row = mysql_fetch_array($sqljen);
        $list[] = $row['id_pendidikan'];
  }
    return $list;
}
//END FUNCTION //

/* SEMUA REGEX MENGGUNAKAN INI 
  KHUSUS PASCA ID=2 CEK MENGGUNAKAN 
  NAMA JURUSAN VERSI INDONESIA
*/
function jurcon($jen,$id){
$k = count($jen);
$nama = array();
    //echo $k;
    if($k>0){
    for ($l = 0; $l < $k; $l++)
    {
      $jenx =$jen[$l];
        if($id==4 || $id==1 || $id==3){

           $sqljen= mysql_query("SELECT nama_jurusan FROM db_katjurusan WHERE find_in_set('$jenx',nama_jurusan_en)") or die(mysql_error());
           $row = mysql_fetch_array($sqljen);
            
           $nama[] = $row['nama_jurusan'];
        }
    }
    }
      return $nama;

}

function jurusanid($jen,$id){
  $k = count($jen);
    $list = array();
    //echo $k;
    if($k>0){
    for ($l = 0; $l < $k; $l++)
    {
        //$jenx = mysql_real_escape_string($jen[$l]);
      $jenx =$jen[$l];
        if($id==2){
        $sqljen= mysql_query("SELECT id_jurusan FROM db_katjurusan WHERE nama_jurusan='$jenx'") or die(mysql_error());
        $row = mysql_fetch_array($sqljen);
        // $securityname = $securitynamearray['id_kategori'];

        //echo "<td>$securityname</td>";
        
        // while ($row = mysql_fetch_array($selectsecurityname)) {
          $list[] = $row['id_jurusan'];
          // $beasiswalist_array = implode(",", $beasiswalist);
          // echo $beasiswalist;
          // }
        }
        else{
          
             // $sqljen= mysql_query("SELECT id_jurusan FROM db_katjurusan WHERE nama_jurusan_en='$jenx'") or die(mysql_error());
           $sqljen= mysql_query("SELECT id_jurusan FROM db_katjurusan WHERE find_in_set('$jenx',nama_jurusan_en)") or die(mysql_error());
              $row = mysql_fetch_array($sqljen);
              // $securityname = $securitynamearray['id_kategori'];

              //echo "<td>$securityname</td>";
              
              // while ($row = mysql_fetch_array($selectsecurityname)) {
                $list[] = $row['id_jurusan'];
          }
    }
  }
  else{
        $sqljen= mysql_query("SELECT id_jurusan FROM db_katjurusan WHERE nama_jurusan_en='any subject'") or die(mysql_error());
        $row = mysql_fetch_array($sqljen);
        // $securityname = $securitynamearray['id_kategori'];

        //echo "<td>$securityname</td>";
        
        // while ($row = mysql_fetch_array($selectsecurityname)) {
          $list[] = $row['id_jurusan'];
          // $beasiswalist_array = implode(",", $beasiswalist);
          // echo $beasiswalist;
          // }
  }
    return $list;
}
//END FUCNTION//

/* SEMUA REGEX MENGGUNAKAN INI 
*/

function negaraid($jen,$id){
  $k = count($jen);
    $list = array();
    //echo $k;
    if($k>0){
    for ($l = 0; $l < $k; $l++)
    {
        $jenx = mysql_real_escape_string($jen[$l]);
        if($id==2 || $id==3 || $id==4 || $id==1){
        $sqljen= mysql_query("SELECT id_negara FROM db_katnegara WHERE find_in_set('$jenx',nama_negara_en) ") or die(mysql_error());
        $row = mysql_fetch_array($sqljen);
        // $securityname = $securitynamearray['id_kategori'];

        //echo "<td>$securityname</td>";
        
        // while ($row = mysql_fetch_array($selectsecurityname)) {
          $list[] = $row['id_negara'];
          // $beasiswalist_array = implode(",", $beasiswalist);
          // echo $beasiswalist;
        } // }
        // else{
        // $sqljen= mysql_query("SELECT id_negara FROM db_katnegara WHERE nama_negara_en='$jenx'") or die(mysql_error());
        // $row = mysql_fetch_array($sqljen);
        // // $securityname = $securitynamearray['id_kategori'];

        // //echo "<td>$securityname</td>";
        
        // // while ($row = mysql_fetch_array($selectsecurityname)) {
        //   $list[] = $row['id_negara'];
        // }  
    }
  }
  else{
        $sqljen= mysql_query("SELECT id_negara FROM db_katnegara WHERE nama_negara='internasional'") or die(mysql_error());
        $row = mysql_fetch_array($sqljen);
        // $securityname = $securitynamearray['id_kategori'];

        //echo "<td>$securityname</td>";
        
        // while ($row = mysql_fetch_array($selectsecurityname)) {
          $list[] = $row['id_negara'];
          // $beasiswalist_array = implode(",", $beasiswalist);
          // echo $beasiswalist;
          // }
  }
    return $list;
}


//function save_konten($domain,$idd,$judul, $deadline, $jenjang,$jurusanid,$jurusan, $negara,$negara2, $univ,$konten,$tipe,$penyedia,$pick,$picb,$openfor,$ibt=NULL,$pbt=NULL,$ielts=NULL,$ipk=NULL,$more_url=NULL){
function save_konten($domain,$idd,$judul, $deadline, $jenjang,$jurusanid,$jurusan, $negara,$negara2, $univ,$konten,$tipe,$penyedia,$pick,$picb,$openfor,$sertifikat,$more_url=NULL){
if (!preg_match('/^(cara|daftar|peluangnya|lihat)/i', $judul) && !empty($deadline) && $deadline!= NULL && $deadline!='1970-01-01'){
$sql = mysql_query("SELECT id FROM db_scholarship WHERE url='$domain'");
           //  if(count($deadline)<=2 && count($deadline)>=1){
           //    $deadlinebaru = implode(" ",$deadline);
           //   }
           // else{
           //    $deadlinebaru = date('Y');
           //    //$deadlinebaru = "2015";
           //     //$deadlinebaru = $info["deadline"]
           //  }

            // if(count($jenjang)>=1){
            //   $jenjangbaru = implode(",", $jenjang);
            // }
            // else{
            //   $jenjangbaru = "tidak terkategori";
            // }
            // if(null === $ibt){
            //   $ibt = 0;
            // }
            // if(null === $pbt){
            //   $pbt = 0;
            // }
            // if(null === $ielts){
            //   $ielts = 0;
            // }
            // if(null === $ipk){
            //   $ipk = 0;
            // }
            if(NULL === $more_url){
              $more_url = $domain;
            }
            if(count($sertifikat)>=1){
              $sertifikatbaru = implode(",", $sertifikat);
            }
            else{
              $sertifikatbaru = "sertifikat lainnya";
            }
            if(count($jurusan)>=1){
              $jurusanbaru = implode(",", $jurusan);
            }
            else{
              $jurusanbaru = "jurusan lainnya";
            }

            // if(count($negara)>=1){
            //   $negarabaru = implode(",", $negara);
            // }
            // else{
            //   $negarabaru = "test";
            // }

            if(count($univ)>=1){
              $univbaru = implode(",", $univ);
            }
            else{
              foreach($negara2 as $value){
                if($value!="internasional"){
                    $univb[] =  $value;
                    $univba = implode(",",$univb);
                    $univbaru = "Instansi pendidikan di" ." ". $univba;
                }
                else{
                  $univbaru = "Instansi pendidikan lainnya";
                }
              }

            }
            if(count($tipe)>=1){
              $tipebaru = implode(",", $tipe);
            }
            else{
              $tipebaru = "tidak terkategori";
            }
            if(count($penyedia)>=1){
              $penyediabaru = implode(",",$penyedia);
            }
            else{
              $penyediabaru = "universitas/swasta";
            }
            if(count($openfor)>=1){
              $openforbaru = implode(",",$openfor);
            }
            else{
              $openforbaru = "indonesia";
            }

  
  if(mysql_num_rows($sql)>0){
    $row=mysql_fetch_array($sql);
      $idrow = $row["id"];

    //unlink("../images/".$row['gambar']); //hapus gambar lama

    //mysql_query("UPDATE db_scholarship SET url='$domain',id_url='$idd',judul_beasiswa='$judul',deadline2='$deadline',jurusan_tag='$jurusanbaru',univ='$univbaru',detail='$konten',penyedia='$penyediabaru',tipe_beasiswa='$tipebaru',pic_normal='$pick',pic_besar='$picb',openfor='$openforbaru',ibt='$ibt',pbt='$pbt',ielts='$ielts',ipk='$ipk',more_url='$more_url' WHERE id='$idrow'") or die("ga bisa update");
    mysql_query("UPDATE db_scholarship SET url='$domain',id_url='$idd',judul_beasiswa='$judul',deadline2='$deadline',jurusan_tag='$jurusanbaru',univ='$univbaru',detail='$konten',penyedia='$penyediabaru',tipe_beasiswa='$tipebaru',pic_normal='$pick',pic_besar='$picb',openfor='$openforbaru',sertifikat='$sertifikatbaru',more_url='$more_url' WHERE id='$idrow'") or die("ga bisa update");
     //id_kategori='$kategori_id', url='$url', judul='$judul', isi='$isi', univ='$univ', negara='$negara', deadline='$deadline' WHERE id='".$row['id']."'") or die("cant update konten");

    // die("Update data berhasil");
    
    // if(is_array($jenjang) || !empty($jenjang) || is_array($jurusanid) || !empty($jurusanid) || is_array($negara) || !empty($negara)){
    //   foreach($jenjang as $isi){
    //   $sqlregkat = mysql_query("UPDATE db_katpendidikan_hub SET id_pendidikan='$isi' WHERE id_beasiswa='$idrow' AND id_pendidikan='$isi'");
    //   }
    //   foreach($jurusanid as $isi){
    //   $sqlregkat = mysql_query("UPDATE db_katjurusan_hub SET id_jurusan='$isi' WHERE id_beasiswa='$idrow' AND id_jurusan='$isi'");
    //   }
    //   foreach($negara as $isi){
    //   $sqlregkat = mysql_query("UPDATE db_katnegara_hub SET id_negara='$isi' WHERE id_beasiswa='$idrow' AND id_negara='$isi'");
    //   }
    // }

    // foreach($jenjang as $isi){
    //         $sqlregkat = mysql_query("INSERT INTO db_katpendidikan_hub(id_beasiswa,id_pendidikan) VALUES ('".$idrow."','".$isi."')");
    //       }
  }
  else{
    //if(preg_match("/(cara|penerjemahan)/i",$judul)==false){
    date_default_timezone_set('Asia/Jakarta');
    $waktu = date('Y-m-d H:i:s');
      //mysql_query("INSERT INTO db_scholarship (id_url,url,judul_beasiswa,deadline2,jurusan_tag,univ,detail,tipe_beasiswa,penyedia,pic_normal,pic_besar,tanggal_scrap,openfor,ibt,pbt,ielts,ipk,more_url) VALUES ('".$idd."','".$domain."','".$judul."','".$deadline."','".$jurusanbaru."','".$univbaru."','".$konten."','".$tipebaru."','".$penyediabaru."','".$pick."','".$picb."','".$waktu."','".$openforbaru."','".$ibt."','".$pbt."','".$ielts."','".$ipk."','".$more_url."' )") or die("cant insert konten");
      mysql_query("INSERT INTO db_scholarship (id_url,url,judul_beasiswa,deadline2,jurusan_tag,univ,detail,tipe_beasiswa,penyedia,pic_normal,pic_besar,tanggal_scrap,openfor,sertifikat,more_url) VALUES ('".$idd."','".$domain."','".$judul."','".$deadline."','".$jurusanbaru."','".$univbaru."','".$konten."','".$tipebaru."','".$penyediabaru."','".$pick."','".$picb."','".$waktu."','".$openforbaru."','".$sertifikatbaru."','".$more_url."' )") or die("cant insert konten");
      // //}
      $sql2 = mysql_query("SELECT id FROM db_scholarship WHERE url='$domain'");
        $row=mysql_fetch_array($sql2);
        $idrow = $row["id"];
        
          foreach($jenjang as $isi){
            //if(!empty($isi)){
            $sqlregkat = mysql_query("INSERT INTO db_katpendidikan_hub(id_beasiswa,id_pendidikan) VALUES ('".$idrow."','".$isi."')");
          //}
        }
          foreach($jurusanid as $isi){
            $sqlregkat = mysql_query("INSERT INTO db_katjurusan_hub(id_beasiswa,id_jurusan) VALUES ('".$idrow."','".$isi."')");
          }
          foreach($negara as $isi){
            $sqlregkat = mysql_query("INSERT INTO db_katnegara_hub(id_beasiswa,id_negara) VALUES ('".$idrow."','".$isi."')");
          }

    }
}
}
//function save_kontenx($domain,$idd,$judul, $deadline, $jenjang, $jurusan, $negara, $univ,$konten,$tipe,$penyedia){
function save_kontenx($domain, $judul, $deadline, $jenjang, $jurusan, $negara, $univ,$konten){
//function save_kontenx($domain,$idd,$judul, $deadline, $jenjang, $jurusan, $negara, $univ,$konten,$tipe,$penyedia){
$sql = mysql_query("SELECT id FROM db_scholarship WHERE url='$domain'");
            if(!empty($deadline)){
              $deadlinebaru = $deadline;
            }
            else{
              $deadlinebaru = "2015";
               //$deadlinebaru = $info["deadline"]
            }
            if(count($jenjang)>=1){
              $jenjangbaru = implode(",", $jenjang);
            }
            else{
              $jenjangbaru = "test";
            }

            if(count($jurusan)>=1){
              $jurusanbaru = implode(",", $jurusan);
            }
            else{
              $jurusanbaru = "test";
            }

            if(count($negara)>=1){
              $negarabaru = implode(",", $negara);
            }
            else{
              $negarabaru = "test";
            }

            if(count($univ)>=1){
              $univbaru = implode(",", $univ);
            }
            else{
              $univbaru = "test";
            }
            if(count($penyedia)>=1){
              $penyediabaru = implode(" ",$penyedia);
            }
            else{
              $penyediabaru = "test";
            }
  
  if(mysql_num_rows($sql)>0){
    $row=mysql_fetch_array($sql);
      $idrow = $row["id"];

    //unlink("../images/".$row['gambar']); //hapus gambar lama

    mysql_query("UPDATE db_scholarship SET url='$domain',id_url='$idd',judul_beasiswa='$judul',deadline='$deadlinebaru',jurusan_tag='$jurusanbaru',univ='$univbaru',detail='$konten',penyedia='$penyediabaru',tipe_beasiswa='$tipebaru' WHERE id='$idrow'") or die("ga bisa update");
     //id_kategori='$kategori_id', url='$url', judul='$judul', isi='$isi', univ='$univ', negara='$negara', deadline='$deadline' WHERE id='".$row['id']."'") or die("cant update konten");

    // die("Update data berhasil");
    // foreach($jenjang as $isi){
    //   $sqlregkat = mysql_query("UPDATE db_katpendidikan_hub SET id_pendidikan='$isi' WHERE='$idrow'");
    //   }
    // foreach($jenjang as $isi){
    //         $sqlregkat = mysql_query("INSERT INTO db_katpendidikan_hub(id_beasiswa,id_pendidikan) VALUES ('".$idrow."','".$isi."')");
    //       }
  }
  else{
    //if(preg_match("/(cara|penerjemahan)/i",$judul)==false){
      mysql_query("INSERT INTO db_scholarship (id_url,url,judul_beasiswa,deadline,jurusan_tag,univ,detail,tipe_beasiswa,penyedia,tanggal_scrap) VALUES ('".$idd."','".$domain."','".$judul."','".$deadlinebaru."','".$jurusanbaru."','".$univbaru."','".$konten."','".$tipebaru."','".$penyediabaru."','".NOW()."')") or die("cant insert konten");
      //}
      // $sql2 = mysql_query("SELECT id FROM db_beasiswa WHERE url='$domain'");
      //   $row=mysql_fetch_array($sql2);
      //   $idrow = $row["id"];
      //     foreach($jenjang as $isi){
      //       $sqlregkat = mysql_query("INSERT INTO db_katpendidikan_hub(id_beasiswa,id_pendidikan) VALUES ('".$idrow."','".$isi."')");
      //     }
      //     foreach($jurusan as $isi){
      //       $sqlregkat = mysql_query("INSERT INTO db_katjurusan_hub(id_beasiswa,id_jurusan) VALUES ('".$idrow."','".$isi."')");
      //     }
      //     foreach($negara as $isi){
      //       $sqlregkat = mysql_query("INSERT INTO db_katnegara_hub(id_beasiswa,id_negara) VALUES ('".$idrow."','".$isi."')");
      //     }

    }
}

?>