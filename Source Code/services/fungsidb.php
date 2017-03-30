<?php
// function domain_exists($domain){
// 	$sql = mysql_query("SELECT id_media FROM db_media WHERE domain = '$domain'");

// 	if(mysql_num_rows($sql) == 1){      
// 		$row = mysql_fetch_row($sql);
// 		return $row[0];
// 	}
// 	else{
// 		return false;
// 	}
// }

function kategori_exists($kategori){
	$sql = mysql_query("SELECT id_pendidikan FROM db_katpendidikan WHERE nama_pendidikan = '$kategori'");

	if(mysql_num_rows($sql) == 1){
		$row = mysql_fetch_row($sql);
		return $row[0];
	}
	else{
		return false;
	}
}

function program_exists($program){
	//$sql = mysql_query("SELECT id_jurusan FROM db_katjurusan WHERE nama_jurusan_en ='$program' ");
	$sql = mysql_query("SELECT id_jurusan FROM db_katjurusan WHERE find_in_set('$program',nama_jurusan_en)");

	if(mysql_num_rows($sql) == 1){
		$row = mysql_fetch_row($sql);
		return $row[0];
	}
	else{
		return false;
	}
}

function fak_exists($program){
	//$sql = mysql_query("SELECT id_jurusan FROM db_katjurusan WHERE nama_jurusan_en ='$program' ");
	$sql = mysql_query("SELECT id_fakultas FROM db_katjurusan WHERE find_in_set('$program',nama_jurusan_en)");

	if(mysql_num_rows($sql) == 1){
		$row = mysql_fetch_row($sql);
		return $row[0];
	}
	else{
		return false;
	}
}

// function program_exists($program){
// 	$pro = explode(",",$program);
// 	$list = array();
// 	foreach($pro as $value){
// 		//echo $value;
// 	$sql = mysql_query("SELECT id_jurusan FROM db_katjurusan WHERE find_in_set('$value',nama_jurusan_en)");
// 	}
// 	//echo $sql;
// 	if($row = mysql_fetch_array($sql) > 0){
// 		 //$row = mysql_fetch_array($sqljen);
// 		 $list[] = $row['id_jurusan'];
// 		//$row[] = mysql_fetch_row($sql);
// 		return $list;
// 	}
// 	else{
// 		return false;
// 	}
// }

function negara_exists($negara){
	//$sql = mysql_query("SELECT id_negara FROM db_katnegara WHERE nama_negara = '$negara'");
	$sql = mysql_query("SELECT id_negara FROM db_katnegara WHERE find_in_set('$negara',nama_negara_en)");

	if(mysql_num_rows($sql) == 1){
		$row = mysql_fetch_row($sql);
		return $row[0];
	}
	else{
		return false;
	}
}

function url_exists($url){
	$sql = mysql_query("SELECT url FROM db_ WHERE url = '$url'");

	if(mysql_num_rows($sql) > 0){
		$row = mysql_fetch_row($sql);
		return $row[0];
	}
	else{
		return false;
	}
}

// function save_konten($domain,$idd,$judul, $deadline, $jenjang,$jurusanid,$jurusan, $negara, $univ,$konten,$tipe,$penyedia,$pick,$picb){
// //function save_konten($domain_id, $kategori_id, $url, $judul, $deadline, $univ, $negara, $isi,$jurusan,$thumb,$img){
// 	$negaraid =negara_exists($negara);
// 	$programid= program_exists($jurusan);
// 	$sql = mysql_query("SELECT id FROM db_beasiswa WHERE url='$url'");
// 	if(mysql_num_rows($sql) > 0){
// 		$row=mysql_fetch_array($sql);

// 		//unlink("../images/".$row['gambar']); //hapus gambar lama
// 		mysql_query("UPDATE db_beasiswa SET id_media='$domain_id', id_pendidikan='$kategori_id',id_jurusan='$programid',id_negara='$negaraid', url='$url', nama_beasiswa='$judul', detail='$isi', univ='$univ', negara='$negara', deadline='$deadline', array_tag='$jurusan',pic_normal='$thumb',pic_besar='$img' WHERE id='".$row['id']."'") or die("cant update konten");

// 		//mysql_query("UPDATE db_beasiswa SET id_media='$domain_id', id_kategori='$kategori_id', url='$url', judul='$judul', isi='$isi', univ='$univ', negara='$negara', deadline='$deadline', jurusan='$jurusan' WHERE id='".$row['id']."'") or die("cant update konten");

// 		// die("Update data berhasil");
// 	}
// 	else{
// 		//mysql_query("INSERT INTO db_beasiswa (id_media, id_kategori, url, judul, isi, univ, negara, deadline,jurusan) VALUES ('$domain_id', '$kategori_id', '$url','$judul', '$isi','$univ','$negara','$deadline','$jurusan')") or die("cant insert konten");
// 		mysql_query("INSERT INTO db_beasiswa (id_media, id_pendidikan,id_negara,id_jurusan, url, nama_beasiswa, detail, univ, negara, deadline, array_tag) VALUES ('$domain_id', '$kategori_id','$negaraid','$programid', '$url','$judul', '$isi','$univ','$negara','$deadline','$jurusan')") or die("cant insert konten");
// 	}
// }
// function save_konten2($domain_id, $kategori_id, $url, $judul, $deadline, $univ, $negara, $isi, $jurusan){
// 	$sql = mysql_query("SELECT id FROM db_beasiswa WHERE url='$url'");
// 	if(mysql_num_rows($sql) > 0){
// 		$row=mysql_fetch_array($sql);

// 		//unlink("../images/".$row['gambar']); //hapus gambar lama

// 		mysql_query("UPDATE db_beasiswa SET id_media='$domain_id', id_pendidikan='$kategori_id', url='$url', nama_beasiswa='$judul', detail='$isi', univ='$univ', array_tag='$negara', deadline='$deadline', jurusan='$jurusan' WHERE id='".$row['id']."'") or die("cant update konten");

// 		// die("Update data berhasil");
// 	}
// 	else{
// 		mysql_query("INSERT INTO db_beasiswa (id_media, id_pendidikan, url, nama_beasiswa, detail, univ, negara, deadline,jurusan) VALUES ('$domain_id', '$kategori_id', '$url','$judul', '$isi','$univ','$negara','$deadline','$jurusan')") or die("cant insert konten");
// 	}
//}

function filtersearch($kategori,$program,$negara=NULL,$deadline=NULL,$fak,$sertifikat=NULL){
//$bobot = array(0.255, 0.055, 0.053,0.050,0.040);
// 	//$sql = "SELECT * from db_beasiswa where id_pendidikan = '$kategori' or id_jurusan  = '$program' or id_negara = '$negara' "; 
// 	// $sql = "SELECT * from db_beasiswa b 
// 	// INNER JOIN db_katpendidikan p on b.id_pendidikan = p.id_pendidikan 
// 	// INNER JOIN db_katnegara n on b.id_negara = n.id_negara 
// 	// where b.id_pendidikan = $kategori or b.id_jurusan  = $program or b.id_negara = $negara "; 
// if(NULL === $tipe){
// 	$tipe = 'Beasiswa';
// }
if(NULL === $deadline){
	$deadline = 0;
}
if(NULL === $sertifikat){
	$sertifikat = array();
}
// if(NULL === $ibt){
// 	$ibt = NULL;
// }	
// if(NULL=== $pbt){
// 	$pbt = NULL;
// }
// if(NULL=== $ielts){
// 	$ielts = NULL;
// }
// if(NULL=== $ipk){
// 	$ipk = NULL;
// }
	$sercek = count($sertifikat);
	$pro = count($program);
//echo $pro;
//$bobot = array(0.35, 0.35, 0.30);


$bobot = array(0.457, 0.255, 0.157,0.090,0.040);
//$bobot = array(0.255, 0.055, 0.053,0.050,0.040);
//$sql2 = mysql_query("SELECT * FROM db_bobot");

$sql = "SELECT  b.id, b.judul_beasiswa, b.deadline2 , b.pic_normal ,b.univ, b.jurusan_tag,b.penyedia,b.tipe_beasiswa,b.sertifikat,
				b.more_url,p.id_pendidikan,n.id_negara,
		GROUP_CONCAT(DISTINCT j.id_jurusan) as id_jurusan,
		GROUP_CONCAT(DISTINCT p.nama_pendidikan) as jenjang ,
		GROUP_CONCAT(DISTINCT j.id_fakultas) as fak,
		GROUP_CONCAT(DISTINCT n.nama_negara) as negara
		from db_scholarship b 
		INNER JOIN db_katpendidikan_hub ph on b.id = ph.id_beasiswa
		INNER JOIN db_katpendidikan p on ph.id_pendidikan = p.id_pendidikan 
		INNER JOIN db_katnegara_hub nh on b.id = nh.id_beasiswa
		INNER JOIN db_katnegara n on nh.id_negara = n.id_negara
		INNER JOIN db_katjurusan_hub jh on b.id = jh.id_beasiswa
		INNER JOIN db_katjurusan j on jh.id_jurusan = j.id_jurusan
		WHERE (n.id_negara= '$negara' ) 
			  and ((j.id_jurusan = '$program' or j.id_fakultas='$fak' or j.id_jurusan=32) and n.id_negara= '$negara')
		GROUP BY b.id";


//LAMA//
//echo $pro;
//$bobot = array(0.35, 0.35, 0.30);
// $bobot = array(0.255, 0.055, 0.053,0.050,0.040);

// $sql = "SELECT  b.id, b.judul_beasiswa, b.deadline2 , b.pic_normal ,b.univ, b.jurusan_tag,b.penyedia,b.tipe_beasiswa,b.sertifikat,
// 			b.more_url,p.id_pendidikan,n.id_negara,
// 		GROUP_CONCAT(DISTINCT j.id_jurusan) as id_jurusan,
// 		GROUP_CONCAT(DISTINCT p.nama_pendidikan) as jenjang ,
// 		GROUP_CONCAT(DISTINCT j.id_fakultas) as fak,
// 		GROUP_CONCAT(DISTINCT n.nama_negara) as negara
// 		from db_scholarship b 
// 		INNER JOIN db_katpendidikan_hub ph on b.id = ph.id_beasiswa
// 		INNER JOIN db_katpendidikan p on ph.id_pendidikan = p.id_pendidikan 
// 		INNER JOIN db_katnegara_hub nh on b.id = nh.id_beasiswa
// 		INNER JOIN db_katnegara n on nh.id_negara = n.id_negara
// 		INNER JOIN db_katjurusan_hub jh on b.id = jh.id_beasiswa
// 		INNER JOIN db_katjurusan j on jh.id_jurusan = j.id_jurusan
// 		WHERE (p.id_pendidikan = '$kategori' and n.id_negara= '$negara' and (find_in_set('indonesia',b.openfor) or find_in_set('semua negara',b.openfor) or find_in_set('overseas',b.openfor)) ) 
// 			  and ((j.id_jurusan = '$program' or j.id_fakultas='$progf' or j.id_jurusan=32) and n.id_negara= '$negara' and p.id_pendidikan = '$kategori' and (find_in_set('indonesia',b.openfor) or find_in_set('semua negara',b.openfor) or find_in_set('overseas',b.openfor)) )
// 		GROUP BY b.id";
		//WHERE (p.id_pendidikan = '$kategori' and n.id_negara= '$negara' and (find_in_set('indonesia',b.openfor) or find_in_set('semua negara',b.openfor) or find_in_set('overseas',b.openfor)) ) or (j.id_jurusan IN('".implode(',',$program)."') and n.id_negara= '$negara' and (find_in_set('indonesia',b.openfor) or find_in_set('semua negara',b.openfor) or find_in_set('overseas',b.openfor)) )
	//echo $sql;
		//WHERE p.id_pendidikan = '$kategori' and n.id_negara='$negara'

	$result = mysql_query($sql);
	 //echo $result;
		if(!isset($result)||mysql_num_rows($result) == 0){
			$beasiswa = "Data tidak ditemukan";
			//echo json_encode($err);
			//return $beasiswa;
		}
	else{
		while ($row = mysql_fetch_array($result)) {
			$beasiswa[] 	= array('id' => $row['id'],
								'judul_beasiswa' => $row['judul_beasiswa'],
								'pic_normal' => $row['pic_normal'],
								'jurusan_tag' => $row['jurusan_tag'],
								'deadline2' => $row['deadline2'],
								'jenjang' => $row['jenjang'],
								'univ' => $row['univ'],
								'penyedia'=>$row['penyedia'],
								'negara' => $row['negara'],
								'IDkategori' => $row['id_pendidikan'],
								'IDnegara' => $row['id_negara'],
								'IDjurusan' => $row['id_jurusan'],
								'IDfak' => $row['fak'],
								'tipe_beasiswa' => $row['tipe_beasiswa'],
								'link' => $row['more_url'],
								'sertifikat' => $row['sertifikat']

								);
			}//end while
		date_default_timezone_set('Asia/Jakarta'); 
		$waktu = date("Y-m-d");	
		$bobotped = array(0.75,0.25);

		//MEMBERIKAN BOBOT SESUAI DATA QUERY
		for($i=0; $i < count($beasiswa); $i++){
			$bobotx = $bobotped[0];
			$boboty = $bobotped[1];

			//JENJANG
			if($beasiswa[$i]['IDkategori'] == $kategori  ){
				$beasiswa[$i]['bobkat'] = $bobotx;
			}
			else{
				$beasiswa[$i]['bobkat'] = $boboty;
			}

			///NEGARA
			if($negara == $beasiswa[$i]['IDnegara']){
				$beasiswa[$i]['bobneg'] = $bobotx;
			}
			else{
				$beasiswa[$i]['bobneg'] = $boboty;
			}

			///JURUSAN
			$cek = explode(",",$beasiswa[$i]['IDjurusan']);
			$cekf = explode(",",$beasiswa[$i]['IDfak']);
			

			if(in_array($program,$cek)||in_array(32,$cek)){
				$beasiswa[$i]['bobjur'] = 0.611;
			}
			elseif(in_array($fak,$cekf)){
				$beasiswa[$i]['bobjur'] = 0.278;
			}
			else{
				$beasiswa[$i]['bobjur'] = 0.111;
			}

			//SERTIFIKAT
			$cek = explode(",",$beasiswa[$i]['sertifikat']);
   			$count = array_intersect($sertifikat, $cek);    
			if ($sertifikat == $count && $count!=NULL && count($count)!=0 ) {
				    // All elements of arr1 are in arr2
				$beasiswa[$i]['bobser'] = 0.611;
				}
			elseif(count($count)<$sercek && count($count)!=0){
				$beasiswa[$i]['bobser'] =0.278;
			}
			else{
				$beasiswa[$i]['bobser'] = 0.111;
			}		
			//DEADLINE
			$deadlinex = $beasiswa[$i]['deadline2'];
			$date_diff=strtotime($deadlinex)-strtotime($waktu);
 			$selisih = floor(($date_diff)/2628000);
			$beasiswa[$i]['selisih'] = $selisih;
			//if($deadline!==NULL){
				
				if($selisih <= $deadline && $selisih >=0){
					$beasiswa[$i]['bobdead'] = 0.611;
				}
				elseif($selisih > $deadline){
					$beasiswa[$i]['bobdead'] = 0.278;
				}
				else{
					$beasiswa[$i]['bobdead'] = 0.111;
				}
			}

		//SATUKAN DATA BOBOT TIAP BEASISWA KE DALAM ARRAY
		foreach ($beasiswa as $k => $v) {
			  $tArray[$k] = $v['bobkat'];
			  $uArray[$k] = $v['bobneg'];
			  $vArray[$k] = $v['bobjur'];
			  $sArray[$k] = $v['bobser'];
			  $dArray[$k] = $v['bobdead'];
			}

			// foreach ($tArray as $key => $value) {
			// 	echo $key . "->" .$value ."<br/>";
			// }


			//MENGHITUNG MAXIMAL DARI SETIAP KATEGORI YANG DICARI
			for($i=0; $i < count($beasiswa); $i++){
			$beasiswa[$i]['katmaxnow'] = max($tArray);
			$beasiswa[$i]['negmaxnow'] = max($uArray);
			$beasiswa[$i]['jurmaxnow'] = max($vArray);
			$beasiswa[$i]['sermaxnow'] = max($sArray);
			$beasiswa[$i]['deadmaxnow'] = max($dArray);
		}

		//MENGHITUNG RATING AKHIR (NORMALISASI DIKALIKAN BOBOT KRITERIA)
		for($i=0; $i < count($beasiswa); $i++){
				$beasiswa[$i]['rating'] = round((($beasiswa[$i]['bobkat']/$beasiswa[$i]['katmaxnow'])*$bobot[0])+
					(($beasiswa[$i]['bobneg']/$beasiswa[$i]['negmaxnow'])*$bobot[1])+
					(($beasiswa[$i]['bobjur']/$beasiswa[$i]['jurmaxnow'])*$bobot[2])+
					(($beasiswa[$i]['bobser']/$beasiswa[$i]['sermaxnow'])*$bobot[3])+
					(($beasiswa[$i]['bobdead']/$beasiswa[$i]['deadmaxnow'])*$bobot[4]),2);
		}

		function sortdata($data,$d,$d2){
		foreach ($data as $key => $row) {
		    $rating[$key]  = $row[$d];
		    $selisih[$key] = $row[$d2];
		}
		array_multisort($rating, SORT_DESC, $selisih, SORT_DESC, $data);
		return $data;
		
		}
		$beasiswa=sortdata($beasiswa,'rating','selisih');
		// echo "<pre>\n";
		// print_r($beasiswa)."\n";
		// echo "<pre>\n";	
		
	}//end else
	return $beasiswa;
}
?>