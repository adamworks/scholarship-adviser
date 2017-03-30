<?php 
include("config.php");

$kategori = 4;
//$program = array(19);
$program = 19;
$negara = 2;
$tipe = "Beasiswa";
$deadline = 3;

//$bobot = array(0.35, 0.35, 0.30);
$bobot = array(0.255, 0.055, 0.53,0.50,0.40);
	//$sql = "SELECT * from db_beasiswa where id_pendidikan = '$kategori' or id_jurusan  = '$program' or id_negara = '$negara' "; 
	// $sql = "SELECT * from db_beasiswa b 
	// INNER JOIN db_katpendidikan p on b.id_pendidikan = p.id_pendidikan 
	// INNER JOIN db_katnegara n on b.id_negara = n.id_negara 
	// where b.id_pendidikan = $kategori or b.id_jurusan  = $program or b.id_negara = $negara "; 
	//WHERE b.judul_beasiswa like '%Kalla%' or p.id_pendidikan = $kategori or n.id_negara=$negara or j.id_jurusan IN('".implode(',',$program)."')
	$sql = "SELECT * from db_scholarship b 
		INNER JOIN db_katpendidikan_hub ph on b.id = ph.id_beasiswa
		INNER JOIN db_katpendidikan p on ph.id_pendidikan = p.id_pendidikan 
		INNER JOIN db_katnegara_hub nh on b.id = nh.id_beasiswa
		INNER JOIN db_katnegara n on nh.id_negara = n.id_negara
		INNER JOIN db_katjurusan_hub jh on b.id = jh.id_beasiswa
		INNER JOIN db_katjurusan j on jh.id_jurusan = j.id_jurusan
		WHERE p.id_pendidikan ='$kategori' and n.id_negara='$negara' or  j.id_jurusan = '$program'
		GROUP BY b.id";
		
		//WHERE p.id_pendidikan = $kategori and n.id_negara=$negara or  j.id_jurusan IN('".implode(',',$program)."')
		//WHERE b.judul_beasiswa like '%bidikmisi%' or p.id_pendidikan = $kategori or n.id_negara=$negara or j.id_jurusan IN('".implode(',',$program)."')
		//GROUP BY b.id";

// 		$_POST['sports'] = array('basketball', 'baseball', 'football', 'soccer');

// $sql = sprintf("SELECT * FROM sports WHERE sport.name IN (%s)", implode( ',', array_fill(1,count($_POST['sports']), '?') ) );
// // SELECT * FROM sports WHERE sport.name IN (?,?,?,?)
// 	echo $sql;

	$result = mysql_query($sql);
	 echo $result;
		if(!isset($result)||mysql_num_rows($result) == 0){
			$err = "No rows found";
			echo json_encode($err);
		}
	else{
		while ($row = mysql_fetch_array($result)) {
			$beasiswa[] 	= array('id' => $row['id'],
								'nama_beasiswa' => $row['judul_beasiswa'],
								'pic_normal' => $row['pic_normal'],
								'array_tag' => $row['jurusan_tag'],
								'deadline' => $row['deadline2'],
								'jenjang' => $row['nama_pendidikan'],
								'univ' => $row['univ'],
								'negara' => $row['nama_negara'],
								'IDkategori' => $row['id_pendidikan'],
								'IDnegara' => $row['id_negara'],
								'IDjurusan' => $row['id_jurusan'],
								'tipe' => $row['tipe_beasiswa']
								);
		}
		// foreach ($row as $key => $value) {
		// 	echo $value . "<br/>";
		// }

		foreach($beasiswa as $key=>$value){
			//echo $key ."=>".$value['tipe'] ."<br/>";
			echo $key ."=>".$value ."<br/>";
			$baru = $value['tipe'];
			$baru2[] = explode(",",$baru);
			//echo $baru2;

			foreach($value as $key=>$isi){
				echo "<br/>";
				//echo $key."->". $isi . "<br/>";
				print_r($isi);
			}
		}
		foreach($baru2 as $val){
			//echo $key ."=>".$val ."<br/>";
			foreach($val as $k=> $v){
				//echo $k."=>".$v."<br/>";
			}
		}


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
			// foreach ($program as $key => $value) {
			// 		if($value == $beasiswa[$i]['IDjurusan']){
			// 		$beasiswa[$i]['bobjur'] = $bobotx;
			// 	}
			// 	else{
			// 		$beasiswa[$i]['bobjur'] = $boboty;
			// 	}
			// }
			// }
			if($program == $beasiswa[$i]['IDjurusan']){
				$beasiswa[$i]['bobjur'] = $bobotx;
			}
			else{
				$beasiswa[$i]['bobjur'] = $boboty;
			}
			
			//MENGHITUNG BOBOT TIPE PENDIDIKAN
			$baru = $beasiswa[$i]['tipe'];
			$baru2[] = explode(",",$baru);
			foreach($baru2 as $val){
			//echo $key ."=>".$val ."<br/>";
			foreach($val as $k=> $v){
				if(count($tipe == $v[$K])>0){
					$beasiswa[$i]['bobtip'] = $bobotx;
					}	
				else{
					$beasiswa[$i]['bobtip'] = $boboty;
					}
			}
		}
			



			$deadlinex = $beasiswa[$i]['deadline'];
			$date_diff=strtotime($deadlinex)-strtotime($waktu);
 			$selisih = floor(($date_diff)/2628000);
			//$selisih = (int)abs((strtotime($beasiswa[$i]['deadline2']) - strtotime($waktu))/(60*60*24*30));

			$beasiswa[$i]['selisih'] = "tersisa" . " ". $selisih;
			if($selisih >= $deadline){
				$beasiswa[$i]['bobdead'] = $bobotx;
			}
			else{
				$beasiswa[$i]['bobdead'] = $boboty;
			}
			//if($beasiswa[$i]['deadline2'])
		}
		//SATUKAN DATA BOBOT TIAP BEASISWA KE DALAM ARRAY
		foreach ($beasiswa as $k => $v) {
			  $tArray[$k] = $v['bobkat'];
			  $uArray[$k] = $v['bobneg'];
			  $vArray[$k] = $v['bobjur'];
			  $sArray[$k] = $v['bobtip'];
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
			$beasiswa[$i]['tipemaxnow'] = max($sArray);
			$beasiswa[$i]['deadmaxnow'] = max($dArray);
		}

		//MENGHITUNG RATING AKHIR
		for($i=0; $i < count($beasiswa); $i++){
				$beasiswa[$i]['rating'] = round((($beasiswa[$i]['bobkat']/$beasiswa[$i]['katmaxnow'])*$bobot[0])+
					(($beasiswa[$i]['bobjur']/$beasiswa[$i]['negmaxnow'])*$bobot[1])+
					(($beasiswa[$i]['bobneg']/$beasiswa[$i]['jurmaxnow'])*$bobot[2])+
					(($beasiswa[$i]['bobdead']/$beasiswa[$i]['deadmaxnow'])*$bobot[3])+
					(($beasiswa[$i]['bobtip']/$beasiswa[$i]['tipemaxnow'])*$bobot[4]),2);
		}

		//PERANGKINGAN DAN DI ORDER BERDASARKAN 
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

	// //return $beasiswa;

	// 	// // echo $katmax;
	// 	// echo $max_value;

		echo "<pre>\n";
		print_r($beasiswa)."\n";
		echo "<pre>\n";	
	 }
?>