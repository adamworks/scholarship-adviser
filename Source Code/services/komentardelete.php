<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include "config.php";

$idkom=$_POST['idkom'];
$user=$_POST['user'];
$idbea=$_POST['idbea'];
//if(isSet($_POST['idkom'])){
$uql = mysql_query("SELECT * FROM db_user where username='$user'");
//$jur = mysql_query("SELECT nama_jurusan FROM db_katjurusan WHERE id_jurusan='$idjur'");
$id= mysql_fetch_array($uql);
  $userid = $id['id'];

//echo $uql;
//echo $userid;
$hapus = "DELETE FROM db_komentar WHERE id_beasiswa='$idbea' AND id_kom='$idkom' AND id_user='$userid'";

$query =mysql_query($hapus);
// echo $query;

if ($query) {
     $output = array('status' => true,'id'=> $idkom);
        echo json_encode($output);
        print_r($output);
    }
    else{
        $output = array('status' => false);
        echo json_encode($output);
    }


// try {
//         $dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);  
//         $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//         $stmt = $dbh->query($hapus);  
//         $rekomendasi = $stmt->fetchAll(PDO::FETCH_OBJ);
//         $dbh = null;
//         echo '{"items":'. json_encode($rekomendasi) .'}'; 
//         } 
//     catch(PDOException $e) {
//         echo '{"error":{"text":'. $e->getMessage() .'}}'; 
//         }
//}
?>
