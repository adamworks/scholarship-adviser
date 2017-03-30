<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
// include_once 'db.php';

// // Ambil data komentar berdasarkan id status
// $qrykom = mysql_query("SELECT * FROM komentar WHERE id_status='$id_status' ORDER BY id_kom");

// // Tampilkan data yang diambil 
// while($rowkom=mysql_fetch_array($qrykom)){
//   $id_kom=$rowkom['id_kom'];
//   $komentar=$rowkom['komentar'];
// 


include_once 'config.php';

$id= $_GET['id'];
$fnama= $_GET['fnama'];

//$qrysimpan=mysql_query("INSERT INTO komentar(komentar,id_status) VALUES('$komentar','$id_status')");

// Tampilkan query komentar 
$result= "SELECT k.id_kom,k.id_beasiswa,k.komentar,DATE_FORMAT(k.dibuat,'%d %M %Y') AS dibuat,u.username FROM db_komentar k INNER JOIN db_user u on k.id_user=u.id INNER JOIN db_userdetail d on u.id=d.user_id WHERE k.id_beasiswa='$id' or u.username ='$fnama' ORDER BY k.id_kom DESC";
//$rowtampil=mysql_fetch_array($qrytampil);

//$result = mysql_query($sql);
	// if(!isset($result)||mysql_num_rows($result) == 0){
	// 	$err = "No rows found";
	// 	echo json_encode($err);
	// }
	// else{
	// 	while ($row = mysql_fetch_array($result)) {
	// 		$beasiswa[] 	= array('id' => $row['id_kome'],
	// 							'komentar' => $row['komentar']
	// 							//'status' => $row['id_status']
	// 							);
	// 	}

	// 	// header('Content-type: application/json');
	// 	// echo '{"items":'.json_encode($beasiswa).'}';
	// }

try {
	$dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);	
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$stmt = $dbh->query($result);  
	$beasiswa = $stmt->fetchAll(PDO::FETCH_OBJ);
	
	$dbh = null;
	echo '{"items":'. json_encode($beasiswa) .'}'; 
} catch(PDOException $e) {
	echo '{"error":{"text":'. $e->getMessage() .'}}'; 
}

// Ambil data komentar berdasarkan id status
//$qrykom = mysql_query("SELECT * FROM komentar WHERE id_beasiswa='$id_status' ORDER BY id_kom");

//   try {
// 	$dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);	
// 	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
// 	$stmt = $dbh->prepare($sql);  
// 	//$stmt->bindParam("id", $_GET[id]);
// 	$stmt->execute();
// 	$beasiswa = $stmt->fetchObject();
	
// 	$dbh = null;
// 	echo '{"item":'. json_encode($beasiswa) .'}'; 
// } catch(PDOException $e) {
// 	echo '{"error":{"text":'. $e->getMessage() .'}}'; 
// }


?>
