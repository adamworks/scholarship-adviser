<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include 'config.php';

$sql = "SELECT id_negara, nama_negara FROM db_katnegara
		WHERE id_negara ='2'
		OR id_negara ='3'
		OR id_negara ='4'
		OR id_negara ='9'
		OR id_negara ='16'
		OR id_negara ='15'";


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