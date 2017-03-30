<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
	include "config.php";

	$fnama	= $_POST['fnama'];
	$getid 	= $_POST['getid'];
	$sign	= $_POST['sign'];

	//$cekidn = mysql_query("SELECT user_id FROM db_userdetail WHERE fnama='$fnama'");
	$cekidn = mysql_query("SELECT id FROM db_user WHERE username='$fnama'");
		 $cekid= mysql_fetch_array($cekidn);
		 $cekid2 = $cekid['id'];
	
	if($sign==1){
		// $cekidn = mysql_query("SELECT user_id FROM db_userdetail WHERE fnama='$fnama'");
		//  $cekid= mysql_fetch_array($cekidn);
		//  $cekid2 = $cekid['user_id'];
	// 	$resultlist = mysql_query("SELECT beasiswalist FROM db_userdetail where fnama = '$fnama'");	
	// //fungsi tambah beasiswa
	// 		while ($row = mysql_fetch_array($resultlist)) {
	// 		$beasiswalist = $row['beasiswalist'];
	// 		}

	// 		if($beasiswalist !=null){
	// 				//$beasiswalist_array = explode(",", $beasiswalist);
	// 				// foreach ($beasiswalist_array as $key => $value) {
	// 				$beasiswalist_array = "$beasiswalist,'$getid'";
	// 		}else{
	// 				$beasiswalist_array = "'$getid'";
	// 			}
	// 		//simpan id_beasiswa
	// 		//$updatebeasiswalist = mysql_query("UPDATE db_userd SET beasiswalist='$beasiswalist_array' WHERE lnama ='$uid'");
	// 		$updatebeasiswalist = mysql_query("UPDATE db_userdetail SET beasiswalist='$beasiswalist_array' WHERE fnama ='$fnama'");


		$query = "SELECT id_beasiswa FROM db_simpan WHERE id_beasiswa ='$getid' and id_user='$cekid2'";
	    $q= mysql_query($query);
	    $q2 = mysql_fetch_array($q);
	    $q3 = $q2['id_beasiswa'];
	    if($q3==$getid){
	        $output = array('info' => true);
	        header('Content-Type: application/json');
	        echo json_encode($output);
	    }
	    else{
	        $output = array('info' => false);
	        header('Content-Type: application/json');
	        echo json_encode($output);
	    }
	}
	if($sign==2){
		 // $cekidn = mysql_query("SELECT user_id FROM db_userdetail WHERE fnama='$fnama'");
		 // $cekid= mysql_fetch_array($cekidn);
		 // $cekid2 = $cekid['user_id'];

		 $sqlregkat = mysql_query("INSERT INTO db_simpan(id_beasiswa,id_user) VALUES ('".$getid."','".$cekid['id']."')");
	
		$query = "SELECT id_beasiswa FROM db_simpan WHERE id_beasiswa ='$getid' and id_user='$cekid2'";
	    $q= mysql_query($query);
	    $q2 = mysql_fetch_array($q);
	    $q3 = $q2["id_beasiswa"];
	    if($q3==$getid){
	        $output = array('status' => true);
	        header('Content-Type: application/json');
	        echo json_encode($output);
	    }
	    else{
	        $output = array('status' => false);
	        header('Content-Type: application/json');
	        echo json_encode($output);
	    }
	}
	if($sign==3){
		$sqlregkat = mysql_query("DELETE FROM db_simpan WHERE id_beasiswa='$getid' and id_user='$cekid2'");
		$query = "SELECT id_beasiswa FROM db_simpan WHERE id_beasiswa ='$getid' and id_user='$cekid2'";
	    $q= mysql_query($query);
	    $q2 = mysql_fetch_array($q);
	    $q3 = $q2["id_beasiswa"];
	    if($q3==NULL){
	        $output = array('status' => true);
	        header('Content-Type: application/json');
	        echo json_encode($output);
	    }
	    else{
	        $output = array('status' => false);
	        header('Content-Type: application/json');
	        echo json_encode($output);
	    }
	}

	// $resultlist = mysql_query("SELECT beasiswalist FROM db_userdetail where fnama = '$fnama'");	
	// //fungsi tambah beasiswa
	// 		while ($row = mysql_fetch_array($resultlist)) {
	// 		$beasiswalist = $row['beasiswalist'];
	// 		}

	// 		if($beasiswalist !=null){
	// 				//$beasiswalist_array = explode(",", $beasiswalist);
	// 				// foreach ($beasiswalist_array as $key => $value) {
	// 				$beasiswalist_array = "$beasiswalist,'$getid'";
	// 		}else{
	// 				$beasiswalist_array = "'$getid'";
	// 			}
	// 		//simpan id_beasiswa
	// 		//$updatebeasiswalist = mysql_query("UPDATE db_userd SET beasiswalist='$beasiswalist_array' WHERE lnama ='$uid'");
	// 		$updatebeasiswalist = mysql_query("UPDATE db_userdetail SET beasiswalist='$beasiswalist_array' WHERE fnama ='$fnama'");
	//fungsi mendapatkan beasiswa yang diinginkan / GAK DIPAKE
	// $sql	= "SELECT * FROM beasiswa where id = '$getid'";	
	// $result = mysql_query($sql);
	// if(!isset($result)||mysql_num_rows($result) == 0){
	// 	$err = "No rows found";
	// 	echo json_encode($err);
	// }
	// else{
	// 	while ($row = mysql_fetch_array($result)) {
	// 		$beasiswa[] 	= array('id' => $row['id'],
	// 							'nama_beasiswa' => $row['nama_beasiswa'],
	// 							'deskripsi' => $row['deskripsi'],
	// 							'defgambar' => $row['pic_besar'],
	// 							'deadline' => $row['deadline']
	// 							);
	// 	}
		
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

		// header('Content-type: application/json');
		// echo '{"items":'.json_encode($beasiswa).'}';
	//}
?>