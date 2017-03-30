<?php
include 'config.php';

//$getkategori = $_GET['kategori'];
//$sql = "SELECT * FROM beasiswa WHERE kategori =".$_POST['getdata'] AND ;

$filterdata	= $_POST['filterdata'];

$kategori = $filterdata['pendidikan']; //get pendidikan value from form
$negara= $filterdata['negara'];
$program= $filterdata['program'];


/*$kategori = $_POST['pendidikan']; //get pendidikan value from form
$negara= $_POST['negara'];
$program= $_POST['program'];*/


$sql = "SELECT * from db_beasiswa where id_pendidikan = 1 and id_negara = 1 and id_jurusan  = 1 "; 

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
								'deadline' => $row['deadline']
								);
		}

		//header('Content-type: application/json');
		//echo '{"items":'.json_encode($beasiswa).'}';
		print_r($beasiswa);
	}


//$sql = "SELECT * FROM beasiswa WHERE kategori =".$_POST['getdata'] AND ;

/*$result = mysql_query($sql);
	if(!$result){
		$err = "Data tidak ditemukan";
		echo json_encode($err);
	}
	else{
		$sks = "Data ada";
		echo json_encode($sks);
	}
*/
/*try {
	$dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);	
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$stmt = $dbh->query($sql);  
	$filter = $stmt->fetchAll(PDO::FETCH_OBJ);
	
	$dbh = null;
	echo '{"items":'. json_encode($filter) .'}'; 
} catch(PDOException $e) {
	echo '{"error":{"text":'. $e->getMessage() .'}}'; 
}*/

?>
