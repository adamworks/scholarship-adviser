<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include 'config.php';
$fnama = $_GET['fnama'];
// $sql = "SELECT uid, nama, tgl_lahir ,gender ,email ,foto_kecil FROM db_userd where id=".$_GET['id'];
//$sql = "SELECT ud.id,ud.lnama, ud.fnama , u.email FROM db_userdetail ud INNER JOIN db_user u on ud.user_id = u.id where u.username='$fnama'"; 

$sql = "SELECT u.id,ud.lnama, ud.fnama , u.email ,u.username,ud.universitas, ud.gender,ud.birth as tanggal_lahir,
		GROUP_CONCAT(DISTINCT p.nama_pendidikan) as nama_pendidikan,
		GROUP_CONCAT(DISTINCT j.nama_jurusan) as nama_jurusan
		FROM db_userdetail ud
		INNER JOIN db_user u on ud.user_id = u.id 
		INNER JOIN db_katpendidikan p on ud.id_pendidikan = p.id_pendidikan 
		INNER JOIN db_katjurusan j on ud.id_jurusan = j.id_jurusan
		where u.username='$fnama'";

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

// try {
// 	$dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);	
// 	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
// 	$stmt = $dbh->query($sql);  
// 	$beasiswa = $stmt->fetchAll(PDO::FETCH_OBJ);
	
// 	$dbh = null;
// 	echo '{"items":'. json_encode($beasiswa) .'}'; 
// } catch(PDOException $e) {
// 	echo '{"error":{"text":'. $e->getMessage() .'}}'; 
// }

// $sql = "SELECT ud.id,ud.lnama, ud.fnama , u.email ,
// 		GROUP_CONCAT(DISTINCT p.nama_pendidikan) as jenjang ,
// 		GROUP_CONCAT(DISTINCT j.nama_jurusan) as jurusan
// 		FROM db_userdetail ud
// 		INNER JOIN db_user u on ud.user_id = u.id 
// 		-- INNER JOIN db_user u on s.id_user = u.id
//         INNER JOIN db_userdetail ud on u.id = ud.id_user
// 		INNER JOIN db_katpendidikan_hub ph on b.id = ph.id_beasiswa
// 		INNER JOIN db_katpendidikan p on ph.id_pendidikan = p.id_pendidikan 
// 		INNER JOIN db_katjurusan_hub jh on b.id = jh.id_beasiswa
// 		INNER JOIN db_katjurusan j on jh.id_jurusan = j.id_jurusan
// 		where u.username='$fnama'";

?>

