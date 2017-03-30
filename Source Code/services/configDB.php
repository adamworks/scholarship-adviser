<?php 



$namahost = "localhost";

$username="root";

$password = "root";

$database="yqldb";



/*$namahost = "localhost";

$username="resepfin_resepdb";

$password = "kangmamad91";

$database="resepfin_deradmindb";*/



mysql_connect($namahost,$username,$password) or die ("failed");

mysql_select_db($database) or die ("database not exist");



?>