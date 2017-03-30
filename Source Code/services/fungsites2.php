<?php
include("config.php");

$kategori = 5; //sarjana
//$program = array(1,18);
$program = 3; //ekonomi
$progf = 6; //fakultas
$negara = 4; //AUSTRALIA
//$tipe = 'Beasiswa';
$deadline = 2;

$sertifikat = array("ipk");
// foreach ($program as $key => $value) {
// 	echo $value . "<br/>";
// }
$sercek = count($sertifikat);
echo $sercek;
//$pro = count($program);
//echo $pro;
//$bobot = array(0.35, 0.35, 0.30);
//$bobot = array(0.255, 0.055, 0.053,0.050,0.040);
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
// }
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
		WHERE (p.id_pendidikan = '$kategori' and n.id_negara= '$negara' ) 
			  and ((j.id_jurusan = '$program' or j.id_fakultas='$fak' or j.id_jurusan=32) and n.id_negara= '$negara' and p.id_pendidikan = '$kategori' )
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

		foreach($beasiswa as $key=>$value){
			echo $key ."=>".$value ."<br/>";
			}// $baru = $value['tipe'];
			// $baru2[] = explode(",",$baru);
			//echo $baru2;

		// 	// foreach($value as $key=>$isi){
		// 	// 	echo "<br/>";
		// 	// 	echo $key."->". $isi . "<br/>";
		// 	// }
		// }
		// foreach($baru2 as $val){
		// 	//echo $key ."=>".$val ."<br/>";
		// 	foreach($val as $k=> $v){
		// 		//echo $k."=>".$v."<br/>";
		// 	}
		// }


		date_default_timezone_set('Asia/Jakarta'); 
		$waktu = date("Y-m-d");	
		$bobotped = array(0.75,0.25);

		//MEMBERIKAN BOBOT SESUAI DATA QUERY
		for($i=0; $i < count($beasiswa); $i++){
			$bobotx = $bobotped[0];
			$boboty = $bobotped[1];
			if($beasiswa[$i]['IDkategori'] == $kategori  ){
				$beasiswa[$i]['bobkat'] = $bobotx;
			}
			else{
				$beasiswa[$i]['bobkat'] = $boboty;
			}
			///$id_benua = 
			if($negara == $beasiswa[$i]['IDnegara']){
				$beasiswa[$i]['bobneg'] = $bobotx;
			}
			else{
				$beasiswa[$i]['bobneg'] = $boboty;
			}

			// if($beasiswa[$i]['ibt']==$ibt){
			// 	$beasiswa[$i]['bobibt'] = $boboty;
			// }
			// else{
			// 	$beasiswa[$i]['bobibt'] = $boboty;
			// }

			// if($beasiswa[$i]['pbt']==$ibt){
			// 	$beasiswa[$i]['bobpbt'] = $boboty;
			// }
			// else{
			// 	$beasiswa[$i]['bobpbt'] = $boboty;
			// }

			// if($beasiswa[$i]['ielts']==$ibt){
			// 	$beasiswa[$i]['bobielts'] = $boboty;
			// }
			// else{
			// 	$beasiswa[$i]['bobielts'] = $boboty;
			// }
			/*GUNAKAN INI JIKA MULTIPLE */

			//$hit = count($program);
			// $cek = explode(",",$beasiswa[$i]['IDjurusan']);
			
			// // echo "<pre>\n";
   // //          echo "<h1>ini s2</h1>\n";
   // //          print_r($cek) ."\n";
   // //          echo "</pre>"; 
   // 				$count = array_intersect($program, $cek);
   // 				print_r($count);     
			// if ($program == $count ) {
			// 	    // All elements of arr1 are in arr2
			// 	$beasiswa[$i]['bobjur'] = 0.611;
			// 	}
			// elseif(count($count)<$pro && count($count)!=0){
			// 	$beasiswa[$i]['bobjur'] =0.278;
			// }
			// else{
			// 	$beasiswa[$i]['bobjur'] = 0.111;
			// }

			/*END SECTION */

//$beasiswa[$i]['bobdead'] = 

			// foreach ($program as $key => $value) {
			// 	//echo count($program);
			// 	// foreach ($value as $val) {
			// 		echo $value . "<br/>";
			// 	// }
			// 	 //echo $key . $value . "<br/>";
			// 	//echo count($key);
			// 		if($value == $beasiswa[$i]['IDjurusan']){
			// 		$beasiswa[$i]['bobjur'] = $bobotx;
			// 		//echo count($beasiswa[$i]['bobjur']) . "<br/>";
			// 	}
			// 	else{
			// 		$beasiswa[$i]['bobjur'] = $boboty;
			// 	}
			// }
			// }
			$cek = explode(",",$beasiswa[$i]['IDjurusan']);
			$cekf = explode(",",$beasiswa[$i]['IDfak']);
			// if($program == $beasiswa[$i]['IDjurusan']){
			// if(in_array($program,$cek)){
			// 	$beasiswa[$i]['bobjur'] = $bobotx;
			// }
			// else{
			// 	$beasiswa[$i]['bobjur'] = $boboty;
			// }

			if(in_array($program,$cek)||in_array(32,$cek)){
				$beasiswa[$i]['bobjur'] = 0.611;
			}
			elseif(in_array($fak,$cekf)){
				$beasiswa[$i]['bobjur'] = 0.278;
			}
			else{
				$beasiswa[$i]['bobjur'] = 0.111;
			}

			//MENGHITUNG BOBOT TIPE PENDIDIKAN
		// 	$baru = $beasiswa[$i]['tipe_beasiswa'];
		// 	$baru2[] = explode(",",$baru);
		// 	foreach($baru2 as $val){
		// 	//echo $key ."=>".$val ."<br/>";
		// 	foreach($val as $k=> $v){
		// 		if(count($tipe == $v[$K])>0){
		// 			$beasiswa[$i]['bobtip'] = $bobotx;
		// 			}	
		// 		else{
		// 			$beasiswa[$i]['bobtip'] = $boboty;
		// 			}
		// 	}
		// }


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

		// $cek = explode(",",$beasiswa[$i]['sertifikat']);
  //  			$count = array_intersect($sertifikat, $cek);    
		// 	if ($sertifikat == $count ) {
		// 		    // All elements of arr1 are in arr2
		// 		$beasiswa[$i]['bobser'] = 0.611;
		// 		}
		// 	elseif(count($count)<$sercek && count($count)!=0){
		// 		$beasiswa[$i]['bobser'] =0.278;
		// 	}
		// 	else{
		// 		$beasiswa[$i]['bobser'] = 0.111;
		// 	}
			
			$deadlinex = $beasiswa[$i]['deadline2'];
			$date_diff=strtotime($deadlinex)-strtotime($waktu);
 			$selisih = floor(($date_diff)/2628000);
			//$selisih = (int)abs((strtotime($beasiswa[$i]['deadline2']) - strtotime($waktu))/(60*60*24*30));

			// $beasiswa[$i]['selisih'] = "tersisa" . " ". $selisih;
			// if($selisih >= $deadline){
			// 	$beasiswa[$i]['bobdead'] = $bobotx;
			// }
			// else{
			// 	$beasiswa[$i]['bobdead'] = $boboty;
			// }

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
			//}
			// else{
			// 	if($selisih >=0 && $selisih <=1){
			// 		$beasiswa[$i]['bobdead'] = 0.611;
			// 	}
			// 	elseif($selisih > 1){
			// 		$beasiswa[$i]['bobdead'] = 0.278;
			// 	}
			// 	elseif($selisih<0){
			// 		$beasiswa[$i]['bobdead'] = 0.111;
			// 	}
			// }
			//if($beasiswa[$i]['deadline2'])
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

		//MENGHITUNG RATING AKHIR
		for($i=0; $i < count($beasiswa); $i++){
				$beasiswa[$i]['rating'] = round((($beasiswa[$i]['bobkat']/$beasiswa[$i]['katmaxnow'])*$bobot[0])+
					(($beasiswa[$i]['bobjur']/$beasiswa[$i]['negmaxnow'])*$bobot[1])+
					(($beasiswa[$i]['bobneg']/$beasiswa[$i]['jurmaxnow'])*$bobot[2])+
					(($beasiswa[$i]['bobser']/$beasiswa[$i]['sermaxnow'])*$bobot[3])+
					(($beasiswa[$i]['bobdead']/$beasiswa[$i]['deadmaxnow'])*$bobot[4]),2);
		}

		// //PERANGKINGAN DAN DI ORDER BERDASARKAN 
		// function sortByOrder($a, $subkey) {
		// 	foreach ($a as $key => $value) {
		// 		$b[$key]=strtolower($value[$subkey]);
		// 	}
		// 	arsort($b); //mengurutkan nilai index array secara descending (dari besar ke kecil)
		// 	foreach ($b as $key => $value) {
		// 		fc$c[]=$a[$key];
		// 	}
		// 	return $c;
		// }
		// $beasiswa=sortByOrder($beasiswa,'rating');

		function sortdata($data,$d,$d2){
		foreach ($data as $key => $row) {
		    $rating[$key]  = $row[$d];
		    $selisih[$key] = $row[$d2];
		}
		array_multisort($rating, SORT_DESC, $selisih, SORT_DESC, $data);
		return $data;
		
		}
		$beasiswa=sortdata($beasiswa,'rating','selisih');





		echo "<pre>\n";
		print_r($beasiswa)."\n";
		echo "<pre>\n";	
		
	}//end else
	return $beasiswa;
// }
?>