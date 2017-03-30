<?php

function domain_exists($domain){
	$sql = mysql_query("SELECT id_media FROM media WHERE domain = '$domain'");

	if(mysql_num_rows($sql) == 1){      
		$row = mysql_fetch_row($sql);
		return $row[0];
	}
	else{
		return false;
	}
}

function kategori_exists($kategori){
	$sql = mysql_query("SELECT id_kategori FROM kategori WHERE nama_kategori = '$kategori'");

	if(mysql_num_rows($sql) == 1){
		$row = mysql_fetch_row($sql);
		return $row[0];
	}
	else{
		return false;
	}
}

function url_exists($url){
	$sql = mysql_query("SELECT url FROM konten WHERE url = '$url'");

	if(mysql_num_rows($sql) > 0){
		$row = mysql_fetch_row($sql);
		return $row[0];
	}
	else{
		return false;
	}
}

function save_konten($domain_id, $kategori_id, $url, $judul, $deadline, $univ, $negara, $isi,$jurusan){
	$sql = mysql_query("SELECT id FROM konten WHERE url='$url'");
	if(mysql_num_rows($sql) > 0){
		$row=mysql_fetch_array($sql);

		//unlink("../images/".$row['gambar']); //hapus gambar lama

		mysql_query("UPDATE konten SET id_media='$domain_id', id_kategori='$kategori_id', url='$url', judul='$judul', isi='$isi', univ='$univ', negara='$negara', deadline='$deadline', jurusan='$jurusan' WHERE id='".$row['id']."'") or die("cant update konten");

		// die("Update data berhasil");
	}
	else{
		mysql_query("INSERT INTO konten (id_media, id_kategori, url, judul, isi, univ, negara, deadline,jurusan) VALUES ('$domain_id', '$kategori_id', '$url','$judul', '$isi','$univ','$negara','$deadline','$jurusan')") or die("cant insert konten");
	}
}

function filtersearch($kategori){
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
}
// function save_img($url, $filename){
// 	$img = file_get_contents($url);
// 	file_put_contents(dirname(__FILE__). '/images/'.$filename,$img);
// }
?>