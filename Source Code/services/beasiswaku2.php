<?php
	//include ("configDB.php");
	include "config.php";
	$uid	= $_POST['uid'];
	$bid 	= $_POST['getid'];
	
	$sql	= "SELECT * FROM db_userd where lnama = '$uid'";
	
	$resultlist = mysql_query($sql);
	// if(!isset($result)||mysql_num_rows($result) == 0){
	// 	$err = "No rows found";
	// 	echo json_encode($err);
	// }
	// else{
	
	//fungsi tambah beasiswa
	if(mysql_num_rows($resultlist)>0){
	while ($row = mysql_fetch_array($resultlist)) {
			$beasiswalist = $row['beasiswalist'];
			}

			if($beasiswalist !=""){
					$beasiswalist_array = explode(",", $beasiswalist);
					// foreach ($beasiswalist_array as $key => $value) {
					$beasiswalist_array = "$beasiswalist,$bid";
			}else{
					$beasiswalist_array = "$bid";
				}
			//simpan id_beasiswa
			$updatebeasiswalist = mysql_query("UPDATE db_userd SET beasiswalist='$beasiswalist_array' WHERE lnama ='$uid' ");

				//cek array beasiswa yang disimpan
				// if($beasiswalist !=""){
				// 	$beasiswalist_array = explode(",", $beasiswalist);
				// 	// foreach ($beasiswalist_array as $key => $value) {
				// 	$beasiswalist_array = "$beasiswalist,$bid";
				// 	if(in_array($bid, $beasiswalist_array)){
				// 		$updatebeasiswalist = mysql_query("UPDATE db_userd SET beasiswalist='$beasiswalist_array' WHERE uid ='$uid'  ");
				// 	}else{
				// 		$insertbeasiswalist = mysql_query("INSERT INTO")
				// 	}
				// }else{
				// 	$beasiswalist_array = "$bid";
				// }
			
			// $beasiswa[] 	= array('id' => $row['id'],
			// 					'nama_beasiswa' => $row['nama_beasiswa'],
			// 					'deskripsi' => $row['deskripsi'],
			// 					'defgambar' => $row['pic_besar'],
			// 					'deadline' => $row['deadline']
			// 					);

		//}
		
		$output = array('status' => true);
        echo json_encode($output);
    }else{
    	$output = array('status' => false);
        echo json_encode($output);
    }

?>