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
	$sql = mysql_query("SELECT id_jurusan FROM db_katjurusan WHERE nama_jurusan = '$program'");

	if(mysql_num_rows($sql) == 1){
		$row = mysql_fetch_row($sql);
		return $row[0];
	}
	else{
		return false;
	}
}

function negara_exists($negara){
	$sql = mysql_query("SELECT id_negara FROM db_katnegara WHERE nama_negara = '$negara'");

	if(mysql_num_rows($sql) == 1){
		$row = mysql_fetch_row($sql);
		return $row[0];
	}
	else{
		return false;
	}
}

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

function save_konten($domain_id, $kategori_id, $url, $judul, $deadline, $univ, $negara, $isi,$jurusan,$thumb,$img){
	$negaraid =negara_exists($negara);
	$programid= program_exists($jurusan);
	$sql = mysql_query("SELECT id FROM db_beasiswa WHERE url='$url'");
	if(mysql_num_rows($sql) > 0){
		$row=mysql_fetch_array($sql);

		//unlink("../images/".$row['gambar']); //hapus gambar lama
		mysql_query("UPDATE db_beasiswa SET id_media='$domain_id', id_pendidikan='$kategori_id',id_jurusan='$programid',id_negara='$negaraid', url='$url', nama_beasiswa='$judul', detail='$isi', univ='$univ', negara='$negara', deadline='$deadline', array_tag='$jurusan',pic_normal='$thumb',pic_besar='$img' WHERE id='".$row['id']."'") or die("cant update konten");

		//mysql_query("UPDATE db_beasiswa SET id_media='$domain_id', id_kategori='$kategori_id', url='$url', judul='$judul', isi='$isi', univ='$univ', negara='$negara', deadline='$deadline', jurusan='$jurusan' WHERE id='".$row['id']."'") or die("cant update konten");

		// die("Update data berhasil");
	}
	else{
		//mysql_query("INSERT INTO db_beasiswa (id_media, id_kategori, url, judul, isi, univ, negara, deadline,jurusan) VALUES ('$domain_id', '$kategori_id', '$url','$judul', '$isi','$univ','$negara','$deadline','$jurusan')") or die("cant insert konten");
		mysql_query("INSERT INTO db_beasiswa (id_media, id_pendidikan,id_negara,id_jurusan, url, nama_beasiswa, detail, univ, negara, deadline, array_tag) VALUES ('$domain_id', '$kategori_id','$negaraid','$programid', '$url','$judul', '$isi','$univ','$negara','$deadline','$jurusan')") or die("cant insert konten");
	}
}
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

function filtersearch($kategori,$program,$negara){
	$bobot = array(0.35, 0.35, 0.30);
	//$sql = "SELECT * from db_beasiswa where id_pendidikan = '$kategori' or id_jurusan  = '$program' or id_negara = '$negara' "; 
	$sql = "SELECT * from db_beasiswa b INNER JOIN db_katpendidikan p on b.id_pendidikan = p.id_pendidikan INNER JOIN db_katnegara n on b.id_negara = n.id_negara where b.id_pendidikan = '$kategori' or b.id_jurusan  = '$program' or b.id_negara = '$negara' "; 
	
	$result = mysql_query($sql);
		if(!isset($result)||mysql_num_rows($result) == 0){
			$err = "No rows found";
			echo json_encode($err);
		}
	else{
		while ($row = mysql_fetch_array($result)) {
			$beasiswa[] 	= array('id' => $row['id'],
								'nama_beasiswa' => $row['nama_beasiswa'],
								'pic_normal' => $row['pic_normal'],
								'array_tag' => $row['array_tag'],
								'deadline' => $row['deadline'],
								'jenjang' => $row['nama_pendidikan'],
								'univ' => $row['univ'],
								'negara' => $row['nama_negara'],
								'IDkategori' => $row['id_pendidikan'],
								'IDnegara' => $row['id_negara'],
								'IDjurusan' => $row['id_jurusan']
								);
		}
		$bobotped = array(0.75,0.25);

		for($i=0; $i < count($beasiswa); $i++){
			$bobotx = $bobotped[0];
			$boboty = $bobotped[1];
			if($beasiswa[$i]['IDkategori'] == $kategori  ){
				$beasiswa[$i]['bobkat'] = $bobotx;
			}
			else{
				$beasiswa[$i]['bobkat'] = $boboty;
			}
			if($negara == $beasiswa[$i]['IDnegara']){
				$beasiswa[$i]['bobneg'] = $bobotx;
			}
			else{
				$beasiswa[$i]['bobneg'] = $boboty;
			}
			if($program == $beasiswa[$i]['IDjurusan']){
				$beasiswa[$i]['bobjur'] = $bobotx;
			}
			else{
				$beasiswa[$i]['bobjur'] = $boboty;
			}
		}
		foreach ($beasiswa as $k => $v) {
			  $tArray[$k] = $v['bobkat'];
			  $uArray[$k] = $v['bobneg'];
			  $vArray[$k] = $v['bobjur'];
			}
			for($i=0; $i < count($beasiswa); $i++){
			$beasiswa[$i]['katmaxnow'] = max($tArray);
			$beasiswa[$i]['negmaxnow'] = max($uArray);
			$beasiswa[$i]['jurmaxnow'] = max($vArray);
		}

		for($i=0; $i < count($beasiswa); $i++){
				$beasiswa[$i]['rating'] = round((($beasiswa[$i]['bobkat']/$beasiswa[$i]['katmaxnow'])*$bobot[0])+
					(($beasiswa[$i]['bobjur']/$beasiswa[$i]['negmaxnow'])*$bobot[1])+
					(($beasiswa[$i]['bobneg']/$beasiswa[$i]['jurmaxnow'])*$bobot[2]),2);
		}

		function sortByOrder($a, $subkey) {
			foreach ($a as $key => $value) {
				$b[$key]=strtolower($value[$subkey]);
			}
			arsort($b); //mengurutkan nilai index array secara descending (dari besar ke kecil)
			foreach ($b as $key => $value) {
				$c[]=$a[$key];
			}
			return $c;
		}
		$beasiswa=sortByOrder($beasiswa,'rating');

	return $beasiswa;
	}



}
	// $kategori = 1; //get pendidikan value from form
	// $negara= 1;
	// $program= 1;
	// //select query db_bobot kriteria utama
	// $bsql = mysql_query("SELECT * FROM db_bobot");
	// 	while($row = mysql_fetch_array($bsql)){
	// 		// $kata[] = array('bobotjudul' => $row['bobotjudul'], 'bobotisi' => $row['bobotisi']);
	// 		$bobot1 = $row['bobot_cocok'];
	// 		$bobot0 = $row['bobot_tidakcocok'];
	// 		$bobotx = $row['bobot_serupa'];

	// 	}
	// $bobot = array(0.35, 0.35, 0.30);
	// //$sql = mysql_query("SELECT * FROM konten WHERE judul LIKE '%$cari%' AND isi LIKE '%$cari%' ORDER BY favorit DESC LIMIT 25 OFFSET ".$offset."");
	// //$sql = mysql_query("SELECT * FROM konten WHERE judul = $cari AND isi LIKE '%$cari%' ORDER BY favorit DESC LIMIT 25 OFFSET ".$offset."");
	// $sql = "SELECT * from db_beasiswa where id_pendidikan = '$kategori' or id_negara ='$negara' or id_jurusan  = '$program' ";

	// $result = mysql_query($sql);
	// if(!isset($result)||mysql_num_rows($result) == 0){
	// 	$err = "No rows found";
	// 	echo json_encode($err);
	// }
	// else{
	// 	while ($row = mysql_fetch_array($result)) {
	// 		$beasiswa[] 	= array('id' => $row['id'],
	// 							'nama_beasiswa' => $row['nama_beasiswa'],
	// 							'deskripsi' => $row['deskripsi'],
	// 							'pic_normal' => $row['pic_normal'],
	// 							'array_tag' => $row['array_tag'],
	// 							'deadline' => $row['deadline'],								
	// 							'negara' => $row['negara'],
	// 							'jurusan' => $row['jurusan'],
	// 							'IDkategori' => $row['id_pendidikan'],
	// 							'IDnegara' => $row['id_negara'],
	// 							'IDjurusan' => $row['id_jurusan']
	// 							);
	// 	}

	// //Inilisailisasi bobot sub kriteria dengan array
	// $bobotped = array(0.75,0.25);
	// $bobotsub = array('pendidikan'=>array('cocok'=>0.75, 'tidak'=>0.25),
	// 				  'jurusan'=>array('cocok'=>0.75, 'tidak'=>0.25),	
	// 				  'negara'=>array('cocok'=>0.75, 'tidak'=>0.25)
	// 				  );

	// for($i=0; $i < count($beasiswa); $i++){
	// 		$bobotx = $bobotped[0];
	// 		$boboty = $bobotped[1];
	// 		if($beasiswa[$i]['IDkategori'] == $kategori  ){
	// 			$beasiswa[$i]['bobkat'] = $bobotx;
	// 		}
	// 		else{
	// 			$beasiswa[$i]['bobkat'] = $boboty;
	// 		}
	// 		if($negara == $beasiswa[$i]['IDnegara']){
	// 			$beasiswa[$i]['bobneg'] = $bobotx;
	// 		}
	// 		else{
	// 			$beasiswa[$i]['bobneg'] = $boboty;
	// 		}
	// 		if($program == $beasiswa[$i]['IDjurusan']){
	// 			$beasiswa[$i]['bobjur'] = $bobotx;
	// 		}
	// 		else{
	// 			$beasiswa[$i]['bobjur'] = $boboty;
	// 		}
	// }
	// 		foreach ($beasiswa as $k => $v) {
	// 		  $tArray[$k] = $v['bobkat'];
	// 		  $uArray[$k] = $v['bobneg'];
	// 		  $vArray[$k] = $v['bobjur'];
	// 		}
	// 		for($i=0; $i < count($beasiswa); $i++){
	// 		$beasiswa[$i]['katmaxnow'] = max($tArray);
	// 		$beasiswa[$i]['negmaxnow'] = max($uArray);
	// 		$beasiswa[$i]['jurmaxnow'] = max($vArray);
	// 		//$max_value = max($tArray);
	// 	}
	// 		for($i=0; $i < count($beasiswa); $i++){
	// 			$beasiswa[$i]['rating'] = round((($beasiswa[$i]['bobkat']/$beasiswa[$i]['katmaxnow'])*$bobot[0])+
	// 				(($beasiswa[$i]['bobjur']/$beasiswa[$i]['negmaxnow'])*$bobot[1])+
	// 				(($beasiswa[$i]['bobneg']/$beasiswa[$i]['jurmaxnow'])*$bobot[2]),2);
	// }
	// function sortByOrder($a, $subkey) {
	// 		foreach ($a as $key => $value) {
	// 			$b[$key]=strtolower($value[$subkey]);
	// 		}
	// 		arsort($b); //mengurutkan nilai index array secara descending (dari besar ke kecil)
	// 		foreach ($b as $key => $value) {
	// 			$c[]=$a[$key];
	// 		}
	// 		return $c;
	// 	}
	// 	// $resep=sortByOrder($resep,'views');
	// 	$beasiswa=sortByOrder($beasiswa,'rating');

	// 	echo '{"items":'.json_encode($beasiswa).'}';
		

	// 	// // echo $katmax;
	// 	// echo $max_value;
	// 	// echo "<pre>\n";
	// 	// print_r($beasiswa)."\n";
	// 	// echo "<pre>\n";	
	
	// }
//}
// function save_img($url, $filename){
// 	$img = file_get_contents($url);
// 	file_put_contents(dirname(__FILE__). '/images/'.$filename,$img);
// }
?>