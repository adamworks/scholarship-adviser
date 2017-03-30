<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include 'config.php';
//$sql = "SELECT id, nama_beasiswa, deadline ,negara ,deskripsi ,detail, url, pic_besar FROM db_beasiswa where id=".$_GET['id']; 
//$sql = "SELECT b.id, b.nama_beasiswa,b.detail,b.url, b.deadline ,b.pic_normal, b.pic_besar ,b.univ, b.array_tag, p.nama_pendidikan, n.nama_negara,j.nama_jurusan from db_beasiswa b INNER JOIN db_katpendidikan p on b.id_pendidikan = p.id_pendidikan INNER JOIN db_katnegara n on b.id_negara = n.id_negara  INNER JOIN db_katjurusan j on b.id_jurusan = j.id_jurusan WHERE b.id=".$_GET['id']; 
$sql = "SELECT b.id, b.judul_beasiswa, b.deadline2 , b.pic_besar,b.pic_normal,b.univ,b.penyedia,b.url,b.detail,b.tipe_beasiswa,b.more_url,b.sertifikat,
		GROUP_CONCAT(DISTINCT p.nama_pendidikan) as jenjang ,
		GROUP_CONCAT(DISTINCT n.nama_negara) as negara,
		GROUP_CONCAT(DISTINCT j.nama_jurusan) as jurusan
		FROM db_scholarship b 
		INNER JOIN db_katpendidikan_hub ph on b.id = ph.id_beasiswa
		INNER JOIN db_katpendidikan p on ph.id_pendidikan = p.id_pendidikan 
		INNER JOIN db_katnegara_hub nh on b.id = nh.id_beasiswa
		INNER JOIN db_katnegara n on nh.id_negara = n.id_negara
		INNER JOIN db_katjurusan_hub jh on b.id = jh.id_beasiswa
		INNER JOIN db_katjurusan j on jh.id_jurusan = j.id_jurusan
		-- ORDER BY b.deadline
		WHERE b.id=".$_GET['id'];

try {
	$dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);	
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$stmt = $dbh->prepare($sql);  
	//$stmt->bindParam("id", $_GET[id]);
	$stmt->execute();
	$beasiswa = $stmt->fetchObject();
	
	$dbh = null;
	echo '{"item":'. json_encode($beasiswa) .'}'; 
} catch(PDOException $e) {
	echo '{"error":{"text":'. $e->getMessage() .'}}'; 
}

?>

