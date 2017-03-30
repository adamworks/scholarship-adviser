<?php
	//Gunakan Koneksi
	include 'config.php';
	//Buat array bobot { C1 = 35%; C2 = 25%; C3 = 25%; dan C4 = 15%.}
	$bobot = array(0.35, 0.35, 0.30);


	$filterdata	= $_POST['filterdata'];
	$kategori = $filterdata['pendidikan']; //get pendidikan value from form
	$negara= $filterdata['negara'];
	$program= $filterdata['program'];

	// $cari = $_POST['s'];
	// $offset = $_POST['offset'];
	//$sql = mysql_query("SELECT * FROM konten WHERE judul LIKE '%$cari%' AND isi LIKE '%$cari%' ORDER BY favorit DESC LIMIT 25 OFFSET ".$offset."");
	//$sql = mysql_query("SELECT * FROM konten WHERE judul = $cari AND isi LIKE '%$cari%' ORDER BY favorit DESC LIMIT 25 OFFSET ".$offset."");
	$sql = mysql_query("SELECT * from db_beasiswa where id_pendidikan = '$kategori' and id_negara ='$negara' and id_jurusan  = '$program' ");

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
								'kategori' => $row['id_pendidikan'],
								'negara' => $row['id_negara'],
								'jurusan' => $row['id_jurusan']
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
			if(in_array($kategori,$beasiswa)){
				$beasiswa[$i]['bobkat'] = $bobotx;
			}

			if($beasiswa[$i]['kategori'] == $kategori){
				//$bobotx;
				 // $beasiswa[$i]['kategori'] = $bobotx;
				 // $beasiswa[$i]['jurusan'] = $bobotx;
				 // $beasiswa[$i]['negara'] = $bobotx;

				 $beasiswa[$i]['bobkat'] = $bobotx;
				 // $beasiswa[$i]['bobjur'] = $bobotx;
				 // $beasiswa[$i]['bobneg'] = $bobotx;
			}
			else if($beasiswa[$i]['negara'] == $negara){
				$beasiswa[$i]['bobneg'] = $bobotx;
			}
			else if($beasiswa[$i]['jurusan'] == $program){
				$beasiswa[$i]['bobjur'] = $bobotx;
			}
			else if($beasiswa[$i]['kategori'] !== $kategori){
				$beasiswa[$i]['bobkat'] = $boboty;
			}
			else if($beasiswa[$i]['negara'] !== $negara){
				$beasiswa[$i]['bobneg'] = $boboty;
			}
			else if($beasiswa[$i]['jurusan'] = $program){
				$beasiswa[$i]['bobjur'] = $boboty;
			}
			// else{
			// 	// $beasiswa[$i]['kategori'] = $boboty;
			// 	// $beasiswa[$i]['jurusan'] = $boboty;
			// 	// $beasiswa[$i]['negara'] = $boboty;

			// 	 $beasiswa[$i]['bobkat'] = $boboty;
			// 	 // $beasiswa[$i]['bobjur'] = $boboty;
			// 	 // $beasiswa[$i]['bobneg'] = $boboty;
			// }
			// //membagi string menjadi array di kolom judul
			// $exp = explode(strtolower($cari), strtolower($resep[$i]['judul']));
			// if($exp > 0) $bobot += $bobot_judul;
			
			// //membagi string menjadi array di kolom isi
			// $exp2 = explode(strtolower($cari), strtolower($resep[$i]['isi']));
			// if($exp2 > 0) $bobotisi *= count($exp2) - 1;
			
			// $bobot += $bobotisi;
			// $resep[$i]['bobot'] = $bobot;
			// $beasiswa[$i]['bobkat'] = $beasiswa[$i]['kategori'];
			// $beasiswa[$i]['bobjur'] = $beasiswa[$i]['jurusan'];
			// $beasiswa[$i]['bobneg'] = $beasiswa[$i]['negara'];

			// $katmax = max($beasiswa['bobkat']);
			// $jurmax = max($beasiswa['bobjur']);
			// $negmax = max($beasiswa['bobneg']);
		}
			for($i=0; $i < count($beasiswa); $i++){
					//mencari nilai max sub kriteria
						$katmax = max($beasiswa['bobkat']);
						$jurmax = max($beasiswa['bobjur']);
						$negmax = max($beasiswa['bobneg']);
			}
			$no = 0;
			while ($no < count($beasiswa)) {
				$beasiswa[$no]['rating'] = round((($beasiswa[$no]['bobkat']/$katmax)*$bobot[0])+
					(($beasiswa[$no]['bobjur']/$jurmax)*$bobot[1])+
					(($beasiswa[$no]['bobneg']/$negmax)*$bobot[2]),2);
		// 	.round((($dt3['Kriteria1']/$max['maxK1'])*$bobot[0])+(($dt3['Kriteria2']/$max['maxK2'])*$bobot[1])+(($dt3['Kriteria3']/$max['maxK3'])*$bobot[2])+(($dt3['Kriteria4']/$max['maxK4'])*$bobot[3]),2)."</td>
		// </tr>";
	$no++;
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
		// $resep=sortByOrder($resep,'views');
		$beasiswa=sortByOrder($beasiswa,'rating');
		// 	while ($dt3 = mysql_fetch_array($sql3)) {
		// 	echo "<tr>
		// 		<td>$no</td><td>".getNama($dt3['idCalon'])."</td>
		// 		<td>"
		// 		.round((($dt3['Kriteria1']/$max['maxK1'])*$bobot[0])+
		// 		(($dt3['Kriteria2']/$max['maxK2'])*$bobot[1])+
		// 		(($dt3['Kriteria3']/$max['maxK3'])*$bobot[2])+
		// 		(($dt3['Kriteria4']/$max['maxK4'])*$bobot[3]),2)."</td>
		// 	</tr>";
		// $no++;
		// }

		echo '{"items":'.json_encode($beasiswa).'}';
	}

	//pengurutuan berdasarkan rating terbesar dan terkecil
?>