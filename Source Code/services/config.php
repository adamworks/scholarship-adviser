<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
	error_reporting(E_ALL ^ E_DEPRECATED);
	// $dbhost = 'localhost';
	// $dbuser = 'root';
	// $dbpass = 'root';
	// $dbname = 'db_beasiswa';
	
	// $dbhost = 'mysql4.000webhost.com';
	// $dbuser = 'a3223936_sch';
	// $dbpass = 'halodunia23';
	// $dbname = 'a3223936_schdb';
	
	/*$mysql_host = "mysql4.000webhost.com";
$mysql_database = "a3223936_schdb";
$mysql_user = "a3223936_sch";
$mysql_password = "halodunia23";*/

	$dbhost = 'mysql.idhostinger.com';
	$dbuser = 'u891120410_dbusr';
	$dbpass = 'halodunia23';
	$dbname = 'u891120410_dbsch';

/*$dbhost = '127.0.0.1';
	$dbuser = 'root';
	$dbpass = 'halodunia23';
	$dbname = 'data_beasiswa';
*/
 mysql_connect($dbhost,$dbuser,$dbpass) or die("cannot connect");
mysql_select_db($dbname) or die("cannot select DB");
?>

