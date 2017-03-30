<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include 'config.php';

$sql = "SELECT id_jurusan, nama_jurusan FROM db_katjurusan 
		WHERE id_fakultas='1' 
		OR id_fakultas='2'
		OR id_fakultas='6'
		OR id_fakultas='7'
		OR id_fakultas='9'
		OR id_fakultas='11'
		OR id_fakultas='13'
		ORDER BY id_fakultas DESC";


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