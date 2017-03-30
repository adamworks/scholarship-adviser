<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include 'config.php';
$username   = $_GET['fnama'];
    //$sign   = $_GET['sign'];

$qryuser = mysql_query("SELECT * FROM db_user WHERE username='$username'");
        $row = mysql_fetch_array($qryuser);
        $userid = $row['id'];
        $sql= "SELECT count(id_beasiswa) AS num FROM db_simpan WHERE id_user = '$userid'";
        // $$num_rows = mysql_num_rows($result);
        // $output = array("count" => $num_rows);
        // echo json_encode($output);
        try {
            $dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);  
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $dbh->prepare($sql);  
            $stmt->bindParam("id", $_GET['id']);
            $stmt->execute();
            $employees = $stmt->fetchAll(PDO::FETCH_OBJ);
            $dbh = null;
            echo '{"items":'. json_encode($employees) .'}'; 
        } catch(PDOException $e) {
            echo '{"error":{"text":'. $e->getMessage() .'}}'; 
        }  

?>