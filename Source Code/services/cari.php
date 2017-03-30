<?php

include 'config.php';

$cari_kata = $_POST['kata'];
$q = mysql_query("SELECT * FROM beasiswa WHERE nama_beasiswa LIKE '%cari_kata%' ");

if (mysql_num_rows($q)== 0){
	echo "data tidak ditemukan";
}
else{
	echo "<ul>";
	while ($row = mysql_fetch_array($q)) {
		$title = str_ireplace($cari_kata, "<b>".$cari_kata."</b>", $row['nama_beasiswa']);
		echo "<li><a href='#'>$title</a></li>";
		//echo $row['nama_beasiswa'];
		}
	echo "</ul>";
}


/*try {
        $dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);  
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $dbh->query($cari);  
        $rekomendasi = $stmt->fetchAll(PDO::FETCH_OBJ);
        $dbh = null;
        echo '{"items":'. json_encode($rekomendasi) .'}'; 
        } 
    catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
        }*/
?>