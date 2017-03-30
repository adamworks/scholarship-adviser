<?php 

// function filtersearch($kategori){
$kategori = $_POST['kategori'];
$sql = "SELECT * from konten where id_kategori = '$kategori' LIMIT 15 "; 

$result = mysql_query($sql);
	if(!isset($result)||mysql_num_rows($result) == 0){
		$err = "No rows found";
		echo json_encode($err);
	}
	else{
		while ($row = mysql_fetch_array($result)) {
			$beasiswa[] 	= array('id' => $row['id'],
								'nama_beasiswa' => $row['judul'],
								'jurusan' => $row['jurusan'],
								'negara' => $row['negara'],
								'univ' => $row['univ'],
								'deadline' => $row['deadline']
								);
		}
		return $beasiswa;
	}
//}

?>