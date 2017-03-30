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
			$bobotx[$i] = array();
			$boboty[$i] = array();
			$bobotz[$i] = array();
			//$bobotx = $bobotped[0];
			//$boboty = $bobotped[1];
			//$bobotisi = $bobot_isi;

			//hitung bobot kategori cocok atau tidak
			if($beasiswa[$i]['kategori'] == $kategori){
				 $bobotx[$i][0] = $bobotped[0];
			}elseif ($beasiswa[$i]['kategori']!= $kategori) {
				$bobotx[$i][0] = $bobotped[1];
			}

			if($beasiswa[$i]['negara'] == $negara){
				 $boboty[$i][1] = $bobotped[0];
			}elseif ($beasiswa[$i]['negara']!= $negara) {
				$boboty[$i][1] = $bobotped[1];
			}

			if($beasiswa[$i]['jurusan'] == $program){
				 $bobotz[$i][2] = $bobotped[0];
			}elseif ($beasiswa[$i]['jurusan']!= $program) {
				$bobotz[$i][2] = $bobotped[1];
			}

			//hitungmax($beasiswa[$i]['kategori'],$beasiswa[$i]['jurusan'],$beasiswa[$i]['negara']);

		}

		for($i=0; $i < count($beasiswa); $i++){
			
			$maxkir = round(max)
			.round($dt2['Kriteria1']/$max['maxK1'],2)."</td><td>"

			// HITUNG QUERY PERTAMA
                IF ($QW1[1] == 1) { //atau
                        IF ($uK[$i][$QW1[0]] <= $gK[$i][$QW1[2]]) { $nils = $gK[$i][$QW1[2]]; }
                        ELSE { $nils = $uK[$i][$QW1[0]]; }
                } ELSE { //dan
                        IF ($uK[$i][$QW1[0]] >= $gK[$i][$QW1[2]]) { $nils = $gK[$i][$QW1[2]]; }
                        ELSE { $nils = $uK[$i][$QW1[0]]; }
                }
                IF ($nils > 0) { $hQW1[$j] = $DT[$i][1]; $j++; }

		}

		function hitungmax($bobkmax,$bobjmax,$bobnmax){
			$maxi = array('katmax'=>'','jurmax'=>'','negmax'=>'');
			$maxi['katmax'] = max($beasiswa['bobkat']);
			$maxi['jurmax'] = max($beasiswa['bobjur']);
			$maxi['negmax'] = max($beasiswa['bobneg']);
			return $maxi;
		}

		// //mencari nilai max sub kriteria
		// 	$katmax = max($beasiswa['bobkat']);
		// 	$jurmax = max($beasiswa['bobjur']);
		// 	$negmax = max($beasiswa['bobneg']);

		hitungrating($maxi);
		// function normalisasi(){

		// }
			function hitungrating(){
				while ($no < count($beasiswa)) {
				$beasiswa[$no]['rating'] = round((($beasiswa[$no]['bobkat']/$maxi['katmax'])*$bobot[0])+
					(($beasiswa[$no]['bobjur']/$maxi)*$bobot[1])+
					(($beasiswa[$no]['bobneg']/$negmax)*$bobot[2]),2);
				$no++;
	}
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

	FOR ($i = 0; $i <= COUNT($DT) -1; $i++) {

                $uK[$i] = ARRAY(); $mK[$i] = ARRAY(); $gK[$i] = ARRAY();
                ECHO "<tr>";
                ECHO "<td class='bg'>".$DT[$i][1]."</td>";
                
                // HITUNG KEANGGOTAAN USIA MUDA
                IF ($DT[$i][2] <= $uMin[0]) { $uK[$i][0] = 1; }
                ELSE IF ($DT[$i][2] >= $uMin[0] && $DT[$i][2] <= $uMax[0]) {
                        $uK[$i][0] = ($uMax[0] - $DT[$i][2])/($uMax[0] - $uMin[0]);
                } ELSE IF ($DT[$i][2] >= $uMax[0]) { $uK[$i][0] = 0; }

                ECHO "<td class='bg'>".$uK[$i][0]."</td>";
                //$nil = $uMin[1] + round(($uMax[1] - $uMin[1])/ 2);
                $nil = 45;
                
                // HITUNG KEANGGOTAAN USIA PAROBAYA
                IF ($DT[$i][2] <= $uMin[1] || $DT[$i][2] >= $uMax[1]) { $uK[$i][1] = 0; }
                ELSE IF ($DT[$i][2] >= $uMin[1] && $DT[$i][2] <= $nil) {
                        $uK[$i][1] = ($DT[$i][2] - $uMin[1])/($nil - $uMin[1]);
                } ELSE IF ($DT[$i][2] >= $nil && $DT[$i][2] <= $uMax[1]) { 
                        $uK[$i][1] = ($uMax[1] - $DT[$i][2]) / ($uMax[1] - $nil);
                }

                ECHO "<td class='bg'>".$uK[$i][1]."</td>";
                
                // HITUNG KEANGGOTAAN USIA TUA
                IF ($DT[$i][2] <= $uMin[2]) { $uK[$i][2] = 0; }
                ELSE IF ($DT[$i][2] >= $uMin[2] && $DT[$i][2] <= $uMax[2]) {
                        $uK[$i][2] = ($DT[$i][2] - $uMin[2])/($uMax[2] - $uMin[2]);
                } ELSE IF ($DT[$i][2] >= $uMax[2]) { $uK[$i][2] = 1; }

                ECHO "<td class='bg'>".$uK[$i][2]."</td>";
                
                // HITUNG KEANGGOTAAN MASA KERJA BARU
                IF ($DT[$i][3] <= $mMin[0]) { $mK[$i][0] = 1; }
                ELSE IF ($DT[$i][3] >= $mMin[0] && $DT[$i][3] <= $mMax[0]) { $mK[$i][0] = ($mMax[0] - $DT[$i][3])/($mMax[0] - $mMin[0]); }
                ELSE IF ($DT[$i][3] >= $mMax[0]) { $mK[$i][0] = 0; }

                ECHO "<td class='bg'>".$mK[$i][0]."</td>";
                
                // HITUNG KEANGGOTAAN MASA KERJA LAMA
                IF ($DT[$i][3] <= $mMin[1]) { $mK[$i][1] = 0; }
                ELSE IF ($DT[$i][3] >= $mMin[1] && $DT[$i][3] <= $mMax[1]) { $mK[$i][1] = ($DT[$i][3] - $mMin[1])/($mMax[1] - $mMin[1]); }
                ELSE IF ($DT[$i][3] >= $mMax[1]) { $mK[$i][1] = 1; }

                ECHO "<td class='bg'>".$mK[$i][1]."</td>";

                // HITUNG KEANGGOTAAN GAJI RENDAH
                IF ($DT[$i][4] <= $gMin[0]) { $gK[$i][0] = 1; }
                ELSE IF ($DT[$i][4] >= $gMin[0] && $DT[$i][4] <= $gMax[0]) {
                        $gK[$i][0] = ($gMax[0] - $DT[$i][4])/($gMax[0] - $gMin[0]);
                } ELSE IF ($DT[$i][4] >= $gMax[0]) { $gK[$i][0] = 0; }

                ECHO "<td class='bg'>".$gK[$i][0]."</td>";
                //$nil = $uMin[1] + round(($uMax[1] - $uMin[1])/ 2);
                $nil1 = 1000000;
                
                // HITUNG KEANGGOTAAN GAJI SEDANG
                IF ($DT[$i][4] <= $gMin[1] || $DT[$i][4] >= $gMax[1]) { $gK[$i][1] = 0; }
                ELSE IF ($DT[$i][4] >= $gMin[1] && $DT[$i][4] <= $nil1) {
                        $gK[$i][1] = ($DT[$i][4] - $gMin[1])/($nil1 - $gMin[1]);
                } ELSE IF ($DT[$i][4] >= $nil1 && $DT[$i][4] <= $gMax[1]) { 
                        $gK[$i][1] = ($gMax[1] - $DT[$i][4]) / ($gMax[1] - $nil1);
                }

                ECHO "<td class='bg'>".$gK[$i][1]."</td>";
                
                // HITUNG KEANGGOTAAN GAJI TINGGI
                IF ($DT[$i][4] <= $gMin[2]) { $gK[$i][2] = 0; }
                ELSE IF ($DT[$i][4] >= $gMin[2] && $DT[$i][4] <= $gMax[2]) {
                        $gK[$i][2] = ($DT[$i][4] - $gMin[2])/($gMax[2] - $gMin[2]);
                } ELSE IF ($DT[$i][4] >= $gMax[2]) { $gK[$i][2] = 1; }

                ECHO "<td class='bg'>".$gK[$i][2]."</td>";
                ECHO "</tr>";
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