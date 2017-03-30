<?php
	//Gunakan Koneksi
	include 'config.php';
	//Buat array bobot { C1 = 35%; C2 = 25%; C3 = 25%; dan C4 = 15%.}
	$bobot = array(0.35, 0.35, 0.30);


	// $filterdata	= $_POST['filterdata'];
	// $kategori = $filterdata['pendidikan']; //get pendidikan value from form
	// $negara= $filterdata['negara'];
	// $program= $filterdata['program'];

	$kategori = $_POST['kat'];
	$jurusan = $_POST['jur'];
	$negara = $_POST['neg'];
	// $kategori = 1; //get pendidikan value from form
	// $negara= 1;
	// $program= 1;

	// $katnam = 's1';
	// $

	// $cari = $_POST['s'];
	// $offset = $_POST['offset'];
	//$sql = mysql_query("SELECT * FROM konten WHERE judul LIKE '%$cari%' AND isi LIKE '%$cari%' ORDER BY favorit DESC LIMIT 25 OFFSET ".$offset."");
	//$sql = mysql_query("SELECT * FROM konten WHERE judul = $cari AND isi LIKE '%$cari%' ORDER BY favorit DESC LIMIT 25 OFFSET ".$offset."");
	$sql = "SELECT * from db_beasiswa where id_pendidikan = '$kategori' or id_negara ='$negara' or id_jurusan  = '$program' ";

	$result = mysql_query($sql);
	if(!isset($result)||mysql_num_rows($result) == 0){
		$err = "No rows found";
		echo json_encode($err);
	}
	else{
		while ($row = mysql_fetch_array($result)) {
			$beasiswa[] 	= array('id' => $row['id'],
								'nama_beasiswa' => $row['nama_beasiswa'],
								'deskripsi' => $row['deskripsi'],
								'pic_normal' => $row['pic_normal'],
								'array_tag' => $row['array_tag'],
								'deadline' => $row['deadline'],								
								'negara' => $row['negara'],
								'jurusan' => $row['jurusan'],
								'IDkategori' => $row['id_pendidikan'],
								'IDnegara' => $row['id_negara'],
								'IDjurusan' => $row['id_jurusan']
								);
		}
	//Inilisailisasi bobot sub kriteria
		$bobotped = array(0.75,0.25);
	$bobotsub = array('pendidikan'=>array('cocok'=>0.75, 'tidak'=>0.25),
					  'jurusan'=>array('cocok'=>0.75, 'tidak'=>0.25),	
					  'negara'=>array('cocok'=>0.75, 'tidak'=>0.25)
					  );

	for($i=0; $i < count($beasiswa); $i++){
			$bobotx = $bobotped[0];
			$boboty = $bobotped[1];
			//$bobotisi = $bobot_isi;
			// if(in_array($kategori,$beasiswa[$i]['kategori'])){
			// 	$beasiswa[$i]['bobkat'] = $bobotx;
			// }
			if($beasiswa[$i]['IDkategori'] == $kategori  ){
				$beasiswa[$i]['bobkat'] = $bobotx;
			}
			else{
				$beasiswa[$i]['bobkat'] = $boboty;
			}

			// if(in_array($negara,$beasiswa)){
			// 	$beasiswa[$i]['bobneg'] = $bobotx;
			// }
			if($negara == $beasiswa[$i]['IDnegara']){
				$beasiswa[$i]['bobneg'] = $bobotx;
			}
			else{
				$beasiswa[$i]['bobneg'] = $boboty;
			}

			// if(in_array($program,$beasiswa)){
			// 	$beasiswa[$i]['bobjur'] = $bobotx;
			// }
			if($program == $beasiswa[$i]['IDjurusan']){
				$beasiswa[$i]['bobjur'] = $bobotx;
			}
			else{
				$beasiswa[$i]['bobjur'] = $boboty;
			}
	}
			// for($i=0; $i < count($beasiswa); $i++){
			// 	//$katmax = "$katmax,$beasiswa[$i]['bobkat']";
			// 	$katmax = max($beasiswa[$i]['bobkat']));
			// }

			// $numbers = array_map(function($beasiswa) {
			//   return $beasiswa['bobkat'];
			// }, $array);

			foreach ($beasiswa as $k => $v) {
			  $tArray[$k] = $v['bobkat'];
			  $uArray[$k] = $v['bobneg'];
			  $vArray[$k] = $v['bobjur'];
			}
			for($i=0; $i < count($beasiswa); $i++){
			$beasiswa[$i]['katmaxnow'] = max($tArray);
			$beasiswa[$i]['negmaxnow'] = max($uArray);
			$beasiswa[$i]['jurmaxnow'] = max($vArray);
			//$max_value = max($tArray);
		}


						//$katmax = max($numbers);

						// $katmax = max($beasiswa['bobkat']));
						// $jurmax = max(array($beasiswa['bobjur']));
						// $negmax = max(array($beasiswa['bobneg']));

	// 		foreach ($beasiswa as $key => $value) {
	// 	if($key == 'bobkat' ){
	// 		// $maxkat =max($value);
	// 		$b[] = $value;
	// 	}
	// 	$maxkat = max($b);
	// }


				for($i=0; $i < count($beasiswa); $i++){
				$beasiswa[$i]['rating'] = round((($beasiswa[$i]['bobkat']/$beasiswa[$i]['katmaxnow'])*$bobot[0])+
					(($beasiswa[$i]['bobjur']/$beasiswa[$i]['negmaxnow'])*$bobot[1])+
					(($beasiswa[$i]['bobneg']/$beasiswa[$i]['jurmaxnow'])*$bobot[2]),2);
	}

		
	// 			for($i=0; $i < count($beasiswa); $i++){
	// 			$beasiswa[$i]['rating'] = round((($beasiswa[$i]['bobkat']/$katmax)*$bobot[0])+
	// 				(($beasiswa[$i]['bobjur']/$jurmax)*$bobot[1])+
	// 				(($beasiswa[$i]['bobneg']/$negmax)*$bobot[2]),2);
	// }
	
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
		// $resep=sortByOrder($resep,'views');
		$beasiswa=sortByOrder($beasiswa,'rating');

		echo '{"items":'.json_encode($beasiswa).'}';
		

		// // echo $katmax;
		// echo $max_value;
		// echo "<pre>\n";
		// print_r($beasiswa)."\n";
		// echo "<pre>\n";
		
	
	}

	//pengurutuan berdasarkan rating terbesar dan terkecil
?>