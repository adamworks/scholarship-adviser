<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include 'config.php'; 
$id = $_GET['id'];
// $sql = "SELECT id, nama_beasiswa, deadline , deskripsi , pic_normal , array_tag FROM db_beasiswa where id_jurusan=".$_GET['id'];
// $sql = "SELECT b.id, b.nama_beasiswa, b.deadline , b.pic_normal ,b.univ, b.array_tag, p.nama_pendidikan, n.nama_negara from db_beasiswa b INNER JOIN db_katpendidikan p on b.id_pendidikan = p.id_pendidikan INNER JOIN db_katnegara n on b.id_negara = n.id_negara where id_jurusan=".$_GET['id']; 

$sql ="SELECT b.id, b.judul_beasiswa, b.deadline2 , b.pic_normal ,b.univ, b.jurusan_tag,b.penyedia,
		GROUP_CONCAT(DISTINCT p.nama_pendidikan) as jenjang ,
		GROUP_CONCAT(DISTINCT n.nama_negara) as negara
		-- GROUP_CONCAT(DISTINCT n.nama_jurusan) as jurusan
		from db_scholarship b 
		INNER JOIN db_katpendidikan_hub ph on b.id = ph.id_beasiswa
		INNER JOIN db_katpendidikan p on ph.id_pendidikan = p.id_pendidikan 
		INNER JOIN db_katnegara_hub nh on b.id = nh.id_beasiswa
		INNER JOIN db_katnegara n on nh.id_negara = n.id_negara
		INNER JOIN db_katjurusan_hub jh on b.id = jh.id_beasiswa
		INNER JOIN db_katjurusan j on jh.id_jurusan = j.id_jurusan
		where jh.id_jurusan=$id
		GROUP BY b.deadline2 DESC,b.id ASC";

try {
	$dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);	
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$stmt = $dbh->query($sql);  
	$beasiswa = $stmt->fetchAll(PDO::FETCH_OBJ);
	
	$dbh = null;
	echo '{"items":'. json_encode($beasiswa) .'}'; 
} catch(PDOException $e) {
	echo '{"error":{"text":'. $e->getMessage() .'}}'; 
}

?>
