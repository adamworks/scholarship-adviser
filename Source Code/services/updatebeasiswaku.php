<?php
	include "config.php";
	//$uid	= "adam";
	//$getid 	= "1";
	//$getid = " ";\
	//$fnama = 
	$fnama = $_POST['fnama'];
	$getid = $_POST['getid'];
	
	$resultlist = mysql_query("SELECT * FROM db_userdetail where fnama = '$fnama'");	
	//fungsi tambah beasiswa
	while ($row = mysql_fetch_array($resultlist)) {
			$beasiswalist = $row['beasiswalist'];
			}
	$beasiswalist_array = explode(",", $beasiswalist);
	foreach ($beasiswalist_array as $key => $value) {
		if($value == $getid ){
			unset($beasiswalist_array[$key]);
		}
	}
	$beasiswalist_baru = implode(",", $beasiswalist_array);
	$updatebeasiswalist = mysql_query("UPDATE db_userdetail SET beasiswalist='$beasiswalist_baru' WHERE fnama ='$fnama'");

	$q= mysql_query ("SELECT beasiswalist FROM db_userdetail WHERE fnama = '$fnama'");

	if(mysql_num_rows($q)>0){
        //while ($row = mysql_fetch_array($result)) {
            $output = array('status' => true);
        echo json_encode($output);
    }
    else{
        $output = array('status' => false);
        echo json_encode($output);
    }
?>