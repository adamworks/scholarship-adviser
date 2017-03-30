<?php
	//include ("configDB.php");
	include "config.php";
	$uid	= $_POST['uid'];
	$getid 	= $_POST['getid'];
	
	$resultlist = mysql_query("SELECT beasiswalist FROM db_userd where nama = '$uid'");	
	//fungsi tambah beasiswa
			while ($row = mysql_fetch_array($resultlist)) {
			$beasiswalist = $row['beasiswalist'];
			}

			if($beasiswalist !=null){
					$beasiswalist_array = explode(",", $beasiswalist);
					// foreach ($beasiswalist_array as $key => $value) {
				if (in_array($getid, $beasiswalist)) {
					$awas = "sudah tersimpan";
					echo json_encode($awas);
					//exit();
				}
				else{
					$beasiswalist_array = "$beasiswalist,'$getid'";
					$updatebeasiswalist = mysql_query("UPDATE db_userd SET beasiswalist='$beasiswalist_array' WHERE nama ='$uid'");
				}
			}else{
					$beasiswalist_array = "'$getid'";
					$updatebeasiswalist = mysql_query("INSERT INTO db_userd(beasiswalist) VALUES('$beasiswalist_array') WHERE nama ='$uid'");
				}
			//simpan id_beasiswa
			

	//fungsi mendapatkan beasiswa yang diinginkan
	$sql	= "SELECT * FROM beasiswa where id = '$getid'";	
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
								'defgambar' => $row['pic_besar'],
								'deadline' => $row['deadline']
								);
		}
		
		// if(mysql_num_rows(mysql_query("SELECT * FROM db_userd WHERE uid = '$'")))
		// {

		// 	$updatecounter = mysql_query("UPDATE konten SET count = count+1 WHERE id = '$getid'");
		// 	if (!$updatecounter) 
		// 	{
		// 	die ("Can't update the counter : " . mysql_error()); // remove ?
		// 	}
		
		// }
		// else{
			
		// }

		header('Content-type: application/json');
		echo '{"items":'.json_encode($beasiswa).'}';
	}
?>