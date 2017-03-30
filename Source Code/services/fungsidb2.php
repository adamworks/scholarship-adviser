<?php
require_once ("config.php");
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

// function kategori_exists($kategori){
// 	$sql = mysql_query("SELECT id_pendidikan FROM db_katpendidikan WHERE nama_pendidikan = '$kategori'");

// 	if(mysql_num_rows($sql) == 1){
// 		$row = mysql_fetch_row($sql);
// 		return $row[0];
// 	}
// 	else{
// 		return false;
// 	}
// }

// function program_exists($program){
// 	foreach($program)

// $program = array("semua jurusan","Economics");	
// // (\''. join("', '", $courses). '\')
// 	$sql = mysql_query("SELECT id_jurusan FROM db_katjurusan WHERE nama_jurusan IN('semua jurusan','Economics')");
// 	echo $sql;
// 	while ($row = mysql_fetch_array($sql)) {
// 				$jur[] = $row['id_jurusan'];
// 			}
// 	// if(mysql_num_rows($sql) == 1){
// 	// 	$row = mysql_fetch_array($sql);
// 	// 	$jur = $row['id_jurusan'];
// 	// 	//return $row[0];
// 	// }
// 	// else{
// 	// 	//return false;
// 	// }
// 	foreach ($jur as $key => $value) {
// 		echo "<br/>";
// 		echo $value . "<br/>";
// 	}


// function program_exists($program){
// 	$sql = mysql_query("SELECT id_jurusan FROM db_katjurusan WHERE nama_jurusan = '$program'");

// 	if(mysql_num_rows($sql) == 1){
// 		$row = mysql_fetch_row($sql);
// 		return $row[0];
// 	}
// 	else{
// 		return false;
// 	}
// }

// function program_exists($program){
$_GET['jurusan'] = array("semua jurusan","Economics");	
echo count($_GET['jurusan']);
$program = $_GET['jurusan'];
// (\''. join("', '", $courses). '\')
	$sql = mysql_query("SELECT id_jurusan FROM db_katjurusan WHERE nama_jurusan IN('".implode("','",$program)."')");
	echo $sql;
	if(mysql_num_rows($sql) > 0){
	while ($row = mysql_fetch_array($sql)) {
				$jur[] = $row['id_jurusan'];
			}
	// if(mysql_num_rows($sql) == 1){
	// 	$row = mysql_fetch_array($sql);
	// 	$jur = $row['id_jurusan'];
	// 	//return $row[0];
	// }
	// else{
	// 	//return false;
	// }
	foreach ($jur as $key => $value) {
		echo "<br/>";
		echo $value . "<br/>";
	}
}
//}

// function negara_exists($negara){
// 	$sql = mysql_query("SELECT id_negara FROM db_katnegara WHERE nama_negara = '$negara'");

// 	if(mysql_num_rows($sql) == 1){
// 		$row = mysql_fetch_row($sql);
// 		return $row[0];
// 	}
// 	else{
// 		return false;
// 	}
// }

// function url_exists($url){
// 	$sql = mysql_query("SELECT url FROM db_ WHERE url = '$url'");

// 	if(mysql_num_rows($sql) > 0){
// 		$row = mysql_fetch_row($sql);
// 		return $row[0];
// 	}
// 	else{
// 		return false;
// 	}
// }

// function save_konten($domain,$idd,$judul, $deadline, $jenjang,$jurusanid,$jurusan, $negara, $univ,$konten,$tipe,$penyedia,$pick,$picb){
// function save_konten($domain_id, $kategori_id, $url, $judul, $deadline, $univ, $negara, $isi,$jurusan,$thumb,$img){
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
// // function save_konten2($domain_id, $kategori_id, $url, $judul, $deadline, $univ, $negara, $isi, $jurusan){
// // 	$sql = mysql_query("SELECT id FROM db_beasiswa WHERE url='$url'");
// // 	if(mysql_num_rows($sql) > 0){
// // 		$row=mysql_fetch_array($sql);

// // 		//unlink("../images/".$row['gambar']); //hapus gambar lama

// // 		mysql_query("UPDATE db_beasiswa SET id_media='$domain_id', id_pendidikan='$kategori_id', url='$url', nama_beasiswa='$judul', detail='$isi', univ='$univ', array_tag='$negara', deadline='$deadline', jurusan='$jurusan' WHERE id='".$row['id']."'") or die("cant update konten");

// // 		// die("Update data berhasil");
// // 	}
// // 	else{
// // 		mysql_query("INSERT INTO db_beasiswa (id_media, id_pendidikan, url, nama_beasiswa, detail, univ, negara, deadline,jurusan) VALUES ('$domain_id', '$kategori_id', '$url','$judul', '$isi','$univ','$negara','$deadline','$jurusan')") or die("cant insert konten");
// // 	}
// //}

// function filtersearch($kategori,$program,$negara,$tipe,$deadline){
// // 	// $bobot = array(0.35, 0.35, 0.30);
// // 	// //$sql = "SELECT * from db_beasiswa where id_pendidikan = '$kategori' or id_jurusan  = '$program' or id_negara = '$negara' "; 
// // 	// $sql = "SELECT * from db_beasiswa b 
// // 	// INNER JOIN db_katpendidikan p on b.id_pendidikan = p.id_pendidikan 
// // 	// INNER JOIN db_katnegara n on b.id_negara = n.id_negara 
// // 	// where b.id_pendidikan = '$kategori' or b.id_jurusan  = '$program' or b.id_negara = '$negara' "; 
	
// // 	// $result = mysql_query($sql);
// // 	// 	if(!isset($result)||mysql_num_rows($result) == 0){
// // 	// 		$err = "No rows found";
// // 	// 		echo json_encode($err);
// // 	// 	}
// // 	// else{
// // 	// 	while ($row = mysql_fetch_array($result)) {
// // 	// 		$beasiswa[] 	= array('id' => $row['id'],
// // 	// 							'nama_beasiswa' => $row['nama_beasiswa'],
// // 	// 							'pic_normal' => $row['pic_normal'],
// // 	// 							'array_tag' => $row['array_tag'],
// // 	// 							'deadline' => $row['deadline'],
// // 	// 							'jenjang' => $row['nama_pendidikan'],
// // 	// 							'univ' => $row['univ'],
// // 	// 							'negara' => $row['nama_negara'],
// // 	// 							'IDkategori' => $row['id_pendidikan'],
// // 	// 							'IDnegara' => $row['id_negara'],
// // 	// 							'IDjurusan' => $row['id_jurusan']
// // 	// 							);
// // 	// 	}
// // 	// 	//bobot SAW
		
// // 	// 	$bobotped = array(0.75,0.25);

// // 	// 	for($i=0; $i < count($beasiswa); $i++){
// // 	// 		$bobotx = $bobotped[0];
// // 	// 		$boboty = $bobotped[1];
// // 	// 		if($beasiswa[$i]['IDkategori'] == $kategori  ){
// // 	// 			$beasiswa[$i]['bobkat'] = $bobotx;
// // 	// 		}
// // 	// 		else{
// // 	// 			$beasiswa[$i]['bobkat'] = $boboty;
// // 	// 		}
// // 	// 		if($negara == $beasiswa[$i]['IDnegara']){
// // 	// 			$beasiswa[$i]['bobneg'] = $bobotx;
// // 	// 		}
// // 	// 		else{
// // 	// 			$beasiswa[$i]['bobneg'] = $boboty;
// // 	// 		}
// // 	// 		if($program == $beasiswa[$i]['IDjurusan']){
// // 	// 			$beasiswa[$i]['bobjur'] = $bobotx;
// // 	// 		}
// // 	// 		else{
// // 	// 			$beasiswa[$i]['bobjur'] = $boboty;
// // 	// 		}
// // 	// 	}
// // 	// 	foreach ($beasiswa as $k => $v) {
// // 	// 		  $tArray[$k] = $v['bobkat'];
// // 	// 		  $uArray[$k] = $v['bobneg'];
// // 	// 		  $vArray[$k] = $v['bobjur'];
// // 	// 		}
// // 	// 		for($i=0; $i < count($beasiswa); $i++){
// // 	// 		$beasiswa[$i]['katmaxnow'] = max($tArray);
// // 	// 		$beasiswa[$i]['negmaxnow'] = max($uArray);
// // 	// 		$beasiswa[$i]['jurmaxnow'] = max($vArray);
// // 	// 	}

// // 	// 	for($i=0; $i < count($beasiswa); $i++){
// // 	// 			$beasiswa[$i]['rating'] = round((($beasiswa[$i]['bobkat']/$beasiswa[$i]['katmaxnow'])*$bobot[0])+
// // 	// 				(($beasiswa[$i]['bobjur']/$beasiswa[$i]['negmaxnow'])*$bobot[1])+
// // 	// 				(($beasiswa[$i]['bobneg']/$beasiswa[$i]['jurmaxnow'])*$bobot[2]),2);
// // 	// 	}

// // 	// 	function sortByOrder($a, $subkey) {
// // 	// 		foreach ($a as $key => $value) {
// // 	// 			$b[$key]=strtolower($value[$subkey]);
// // 	// 		}
// // 	// 		arsort($b); //mengurutkan nilai index array secara descending (dari besar ke kecil)
// // 	// 		foreach ($b as $key => $value) {
// // 	// 			$c[]=$a[$key];
// // 	// 		}
// // 	// 		return $c;
// // 	// 	}
// // 	// 	$beasiswa=sortByOrder($beasiswa,'rating');

// // 	// return $beasiswa;
// // 	// }

// // $bobot = array(0.255, 0.055, 0.53,0.50,0.40);
// // 	//$sql = "SELECT * from db_beasiswa where id_pendidikan = '$kategori' or id_jurusan  = '$program' or id_negara = '$negara' "; 
// // 	// $sql = "SELECT * from db_beasiswa b 
// // 	// INNER JOIN db_katpendidikan p on b.id_pendidikan = p.id_pendidikan 
// // 	// INNER JOIN db_katnegara n on b.id_negara = n.id_negara 
// // 	// where b.id_pendidikan = $kategori or b.id_jurusan  = $program or b.id_negara = $negara "; 
	
// 	$sql = "SELECT  b.id, b.judul_beasiswa, b.deadline2 , b.pic_normal ,b.univ, b.jurusan_tag,b.penyedia,p.id_pendidikan,n.id_negara,j.id_jurusan,
// 		GROUP_CONCAT(DISTINCT p.nama_pendidikan) as jenjang ,
// 		GROUP_CONCAT(DISTINCT n.nama_negara) as negara
// 		from db_scholarship b 
// 		INNER JOIN db_katpendidikan_hub ph on b.id = ph.id_beasiswa
// 		INNER JOIN db_katpendidikan p on ph.id_pendidikan = p.id_pendidikan 
// 		INNER JOIN db_katnegara_hub nh on b.id = nh.id_beasiswa
// 		INNER JOIN db_katnegara n on nh.id_negara = n.id_negara
// 		INNER JOIN db_katjurusan_hub jh on b.id = jh.id_beasiswa
// 		INNER JOIN db_katjurusan j on jh.id_jurusan = j.id_jurusan
// 		WHERE p.id_pendidikan = $kategori or n.id_negara=$negara or j.id_jurusan = $program
// 		GROUP BY b.id";
// 	//echo $sql;

// 	$result = mysql_query($sql);
// 	 //echo $result;
// 		if(!isset($result)||mysql_num_rows($result) == 0){
// 			$err = "No rows found";
// 			echo json_encode($err);
// 		}
// 	else{
// 		while ($row = mysql_fetch_array($result)) {
// 			$beasiswa[] 	= array('id' => $row['id'],
// 								'judul_beasiswa' => $row['judul_beasiswa'],
// 								'pic_normal' => $row['pic_normal'],
// 								'jurusan_tag' => $row['jurusan_tag'],
// 								'deadline2' => $row['deadline2'],
// 								'jenjang' => $row['jenjang'],
// 								'univ' => $row['univ'],
// 								'penyedia'=>$row['penyedia'],
// 								'negara' => $row['negara'],
// 								'IDkategori' => $row['id_pendidikan'],
// 								'IDnegara' => $row['id_negara'],
// 								'IDjurusan' => $row['id_jurusan'],
// 								'tipe_beasiswa' => $row['tipe_beasiswa']
// 								);
// 		}

// 		// foreach($beasiswa as $key=>$value){
// 		// 	//echo $key ."=>".$value['tipe'] ."<br/>";
// 		// 	$baru = $value['tipe'];
// 		// 	$baru2[] = explode(",",$baru);
// 		// 	//echo $baru2;

// 		// 	// foreach($value as $key=>$isi){
// 		// 	// 	echo "<br/>";
// 		// 	// 	echo $key."->". $isi . "<br/>";
// 		// 	// }
// 		// }
// 		// foreach($baru2 as $val){
// 		// 	//echo $key ."=>".$val ."<br/>";
// 		// 	foreach($val as $k=> $v){
// 		// 		//echo $k."=>".$v."<br/>";
// 		// 	}
// 		// }


// 		date_default_timezone_set('Asia/Jakarta'); 
// 		$waktu = date("Y-m-d");	
// 		$bobotped = array(0.75,0.25);

// 		//MEMBERIKAN BOBOT SESUAI DATA QUERY
// 		for($i=0; $i < count($beasiswa); $i++){
// 			$bobotx = $bobotped[0];
// 			$boboty = $bobotped[1];
// 			if($beasiswa[$i]['IDkategori'] == $kategori  ){
// 				$beasiswa[$i]['bobkat'] = $bobotx;
// 			}
// 			else{
// 				$beasiswa[$i]['bobkat'] = $boboty;
// 			}
// 			///$id_benua = 
// 			if($negara == $beasiswa[$i]['IDnegara']){
// 				$beasiswa[$i]['bobneg'] = $bobotx;
// 			}
// 			else{
// 				$beasiswa[$i]['bobneg'] = $boboty;
// 			}
// 			if($program == $beasiswa[$i]['IDjurusan']){
// 				$beasiswa[$i]['bobjur'] = $bobotx;
// 			}
// 			else{
// 				$beasiswa[$i]['bobjur'] = $boboty;
// 			}

// 			//MENGHITUNG BOBOT TIPE PENDIDIKAN
// 			$baru = $beasiswa[$i]['tipe_beasiswa'];
// 			$baru2[] = explode(",",$baru);
// 			foreach($baru2 as $val){
// 			//echo $key ."=>".$val ."<br/>";
// 			foreach($val as $k=> $v){
// 				if(count($tipe == $v[$K])>0){
// 					$beasiswa[$i]['bobtip'] = $bobotx;
// 					}	
// 				else{
// 					$beasiswa[$i]['bobtip'] = $boboty;
// 					}
// 			}
// 		}
			
// 			$deadlinex = $beasiswa[$i]['deadline2'];
// 			$date_diff=strtotime($deadlinex)-strtotime($waktu);
//  			$selisih = floor(($date_diff)/2628000);
// 			//$selisih = (int)abs((strtotime($beasiswa[$i]['deadline2']) - strtotime($waktu))/(60*60*24*30));

// 			$beasiswa[$i]['selisih'] = "tersisa" . " ". $selisih;
// 			if($selisih == $deadline){
// 				$beasiswa[$i]['bobdead'] = $bobotx;
// 			}
// 			else{
// 				$beasiswa[$i]['bobdead'] = $boboty;
// 			}
// 			//if($beasiswa[$i]['deadline2'])
// 		}
// 		//SATUKAN DATA BOBOT TIAP BEASISWA KE DALAM ARRAY
// 		foreach ($beasiswa as $k => $v) {
// 			  $tArray[$k] = $v['bobkat'];
// 			  $uArray[$k] = $v['bobneg'];
// 			  $vArray[$k] = $v['bobjur'];
// 			  $sArray[$k] = $v['bobtip'];
// 			  $dArray[$k] = $v['bobdead'];
// 			}

// 			// foreach ($tArray as $key => $value) {
// 			// 	echo $key . "->" .$value ."<br/>";
// 			// }


// 			//MENGHITUNG MAXIMAL DARI SETIAP KATEGORI YANG DICARI
// 			for($i=0; $i < count($beasiswa); $i++){
// 			$beasiswa[$i]['katmaxnow'] = max($tArray);
// 			$beasiswa[$i]['negmaxnow'] = max($uArray);
// 			$beasiswa[$i]['jurmaxnow'] = max($vArray);
// 			$beasiswa[$i]['tipemaxnow'] = max($sArray);
// 			$beasiswa[$i]['deadmaxnow'] = max($dArray);
// 		}

// 		//MENGHITUNG RATING AKHIR
// 		for($i=0; $i < count($beasiswa); $i++){
// 				$beasiswa[$i]['rating'] = round((($beasiswa[$i]['bobkat']/$beasiswa[$i]['katmaxnow'])*$bobot[0])+
// 					(($beasiswa[$i]['bobjur']/$beasiswa[$i]['negmaxnow'])*$bobot[1])+
// 					(($beasiswa[$i]['bobneg']/$beasiswa[$i]['jurmaxnow'])*$bobot[2])+
// 					(($beasiswa[$i]['bobtip']/$beasiswa[$i]['tipemaxnow'])*$bobot[3])+
// 					(($beasiswa[$i]['bobdead']/$beasiswa[$i]['deadmaxnow'])*$bobot[4]),2);
// 		}

// 		//PERANGKINGAN DAN DI ORDER BERDASARKAN 
// 		function sortByOrder($a, $subkey) {
// 			foreach ($a as $key => $value) {
// 				$b[$key]=strtolower($value[$subkey]);
// 			}
// 			arsort($b); //mengurutkan nilai index array secara descending (dari besar ke kecil)
// 			foreach ($b as $key => $value) {
// 				$c[]=$a[$key];
// 			}
// 			return $c;
// 		}
// 		$beasiswa=sortByOrder($beasiswa,'rating');

// 	return $beasiswa;

// 	// 	// // echo $katmax;
// 	// 	// echo $max_value;

// 		// echo "<pre>\n";
// 		// print_r($beasiswa)."\n";
// 		// echo "<pre>\n";	
// 	 }















// }
// 	// $kategori = 1; //get pendidikan value from form
// 	// $negara= 1;
// 	// $program= 1;
// 	// //select query db_bobot kriteria utama
// 	// $bsql = mysql_query("SELECT * FROM db_bobot");
// 	// 	while($row = mysql_fetch_array($bsql)){
// 	// 		// $kata[] = array('bobotjudul' => $row['bobotjudul'], 'bobotisi' => $row['bobotisi']);
// 	// 		$bobot1 = $row['bobot_cocok'];
// 	// 		$bobot0 = $row['bobot_tidakcocok'];
// 	// 		$bobotx = $row['bobot_serupa'];

// 	// 	}
// 	// $bobot = array(0.35, 0.35, 0.30);
// 	// //$sql = mysql_query("SELECT * FROM konten WHERE judul LIKE '%$cari%' AND isi LIKE '%$cari%' ORDER BY favorit DESC LIMIT 25 OFFSET ".$offset."");
// 	// //$sql = mysql_query("SELECT * FROM konten WHERE judul = $cari AND isi LIKE '%$cari%' ORDER BY favorit DESC LIMIT 25 OFFSET ".$offset."");
// 	// $sql = "SELECT * from db_beasiswa where id_pendidikan = '$kategori' or id_negara ='$negara' or id_jurusan  = '$program' ";

// 	// $result = mysql_query($sql);
// 	// if(!isset($result)||mysql_num_rows($result) == 0){
// 	// 	$err = "No rows found";
// 	// 	echo json_encode($err);
// 	// }
// 	// else{
// 	// 	while ($row = mysql_fetch_array($result)) {
// 	// 		$beasiswa[] 	= array('id' => $row['id'],
// 	// 							'nama_beasiswa' => $row['nama_beasiswa'],
// 	// 							'deskripsi' => $row['deskripsi'],
// 	// 							'pic_normal' => $row['pic_normal'],
// 	// 							'array_tag' => $row['array_tag'],
// 	// 							'deadline' => $row['deadline'],								
// 	// 							'negara' => $row['negara'],
// 	// 							'jurusan' => $row['jurusan'],
// 	// 							'IDkategori' => $row['id_pendidikan'],
// 	// 							'IDnegara' => $row['id_negara'],
// 	// 							'IDjurusan' => $row['id_jurusan']
// 	// 							);
// 	// 	}

// 	// //Inilisailisasi bobot sub kriteria dengan array
// 	// $bobotped = array(0.75,0.25);
// 	// $bobotsub = array('pendidikan'=>array('cocok'=>0.75, 'tidak'=>0.25),
// 	// 				  'jurusan'=>array('cocok'=>0.75, 'tidak'=>0.25),	
// 	// 				  'negara'=>array('cocok'=>0.75, 'tidak'=>0.25)
// 	// 				  );

// 	// for($i=0; $i < count($beasiswa); $i++){
// 	// 		$bobotx = $bobotped[0];
// 	// 		$boboty = $bobotped[1];
// 	// 		if($beasiswa[$i]['IDkategori'] == $kategori  ){
// 	// 			$beasiswa[$i]['bobkat'] = $bobotx;
// 	// 		}
// 	// 		else{
// 	// 			$beasiswa[$i]['bobkat'] = $boboty;
// 	// 		}
// 	// 		if($negara == $beasiswa[$i]['IDnegara']){
// 	// 			$beasiswa[$i]['bobneg'] = $bobotx;
// 	// 		}
// 	// 		else{
// 	// 			$beasiswa[$i]['bobneg'] = $boboty;
// 	// 		}
// 	// 		if($program == $beasiswa[$i]['IDjurusan']){
// 	// 			$beasiswa[$i]['bobjur'] = $bobotx;
// 	// 		}
// 	// 		else{
// 	// 			$beasiswa[$i]['bobjur'] = $boboty;
// 	// 		}
// 	// }
// 	// 		foreach ($beasiswa as $k => $v) {
// 	// 		  $tArray[$k] = $v['bobkat'];
// 	// 		  $uArray[$k] = $v['bobneg'];
// 	// 		  $vArray[$k] = $v['bobjur'];
// 	// 		}
// 	// 		for($i=0; $i < count($beasiswa); $i++){
// 	// 		$beasiswa[$i]['katmaxnow'] = max($tArray);
// 	// 		$beasiswa[$i]['negmaxnow'] = max($uArray);
// 	// 		$beasiswa[$i]['jurmaxnow'] = max($vArray);
// 	// 		//$max_value = max($tArray);
// 	// 	}
// 	// 		for($i=0; $i < count($beasiswa); $i++){
// 	// 			$beasiswa[$i]['rating'] = round((($beasiswa[$i]['bobkat']/$beasiswa[$i]['katmaxnow'])*$bobot[0])+
// 	// 				(($beasiswa[$i]['bobjur']/$beasiswa[$i]['negmaxnow'])*$bobot[1])+
// 	// 				(($beasiswa[$i]['bobneg']/$beasiswa[$i]['jurmaxnow'])*$bobot[2]),2);
// 	// }
// 	// function sortByOrder($a, $subkey) {
// 	// 		foreach ($a as $key => $value) {
// 	// 			$b[$key]=strtolower($value[$subkey]);
// 	// 		}
// 	// 		arsort($b); //mengurutkan nilai index array secara descending (dari besar ke kecil)
// 	// 		foreach ($b as $key => $value) {
// 	// 			$c[]=$a[$key];
// 	// 		}
// 	// 		return $c;
// 	// 	}
// 	// 	// $resep=sortByOrder($resep,'views');
// 	// 	$beasiswa=sortByOrder($beasiswa,'rating');

// 	// 	echo '{"items":'.json_encode($beasiswa).'}';
		

// 	// 	// // echo $katmax;
// 	// 	// echo $max_value;
// 	// 	// echo "<pre>\n";
// 	// 	// print_r($beasiswa)."\n";
// 	// 	// echo "<pre>\n";	
	
// 	// }
// //}
// // function save_img($url, $filename){
// // 	$img = file_get_contents($url);
// // 	file_put_contents(dirname(__FILE__). '/images/'.$filename,$img);
// // }
?>