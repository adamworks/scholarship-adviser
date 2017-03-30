<?php
include('config.php');
$program = "economics";
$sql = mysql_query("SELECT id_jurusan FROM db_katjurusan WHERE find_in_set('$program',nama_jurusan_en)");

	if(mysql_num_rows($sql) == 1){
		$row = mysql_fetch_row($sql);
		echo $row;
		foreach($row as $rox){
			echo $rox;
		}
	// 	return $row[0];
	}
	// else{
	// 	return false;
	// }
?>