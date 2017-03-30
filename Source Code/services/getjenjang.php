<?php
include "config.php";
header('Content-type: application/json');

$sql	= "SELECT id_pendidikan,nama_pendidikan FROM db_katpendidikan";
	
	$result = mysql_query($sql);
	//echo $result;
	if(!isset($result)||mysql_num_rows($result) == 0){
		$err = "No rows found";
		echo json_encode($err);
	}
	else{
		$data = array();
		while ($row = mysql_fetch_assoc($result)) {
			$data[] = $row;
		}
		
		
		echo json_encode($data);
	}
?>