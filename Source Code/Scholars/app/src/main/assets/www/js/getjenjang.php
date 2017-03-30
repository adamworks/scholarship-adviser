<?php
$sql	= "SELECT id_pendidikan,nama_pendidikan FROM db_katpendidikan";
	
	$result = mysql_query($sql);
	if(!isset($result)||mysql_num_rows($result) == 0){
		$err = "No rows found";
		echo json_encode($err);
	}
	else{
		$data = array();
		while ($row = mysql_fetch_assoc($result)) {
			$data[] = $row;
		}
		
		header('Content-type: application/json');
		echo json_encode($data);
	}
?>