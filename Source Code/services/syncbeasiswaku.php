<?php
//session_start();
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include 'config.php';

// $conn = mysql_connect('localhost','root','root');
// //$db   = mysql_select_db('data_beasiswa',$conn);
// $db   = mysql_select_db('db_beasiswa',$conn);

    $username   = $_GET['fnama'];
    //$sign   = $_GET['sign'];


    // if($sign == 1){
        
    // }
    //$username   = "icon";
    // $password   = mysql_real_escape_string($_GET['password']);
    
    //$q= mysql_query ("SELECT * FROM `tab_user` WHERE username = '".$username."' AND password = '".$password."' ");
    //$result= mysql_query ("SELECT * FROM db_userdetail ud INNER JOIN db_user u on ud.user_id=u.id WHERE u.username = '$username' ");
    
    $qryuser = mysql_query("SELECT * FROM db_user WHERE username='$username'");
    $row = mysql_fetch_array($qryuser);
    $userid = $row['id'];


    // if($sign == 1){
    //     $result= mysql_query("SELECT count(*) AS num FROM  db_simpan WHERE id_user = '$userid' ");
    //     $num_rows = mysql_num_rows($result);
    //     $output = array("count" => $num_rows);
    //     echo json_encode($output);
    // }
    //SELECT count(id_beasiswa) AS num FROM db_simpan WHERE id_user = '$userid'
     $sql2 = mysql_query("SELECT id_beasiswa FROM db_simpan WHERE id_user='$userid' ");
    // if(mysql_num_rows($sql)>0){
    //if(mysql_num_rows($sql2)>0){
        while ($row2=mysql_fetch_array($sql2)){ 
         $row2=mysql_fetch_array($sql2);
         $idb = $row2['id_beasiswa'];

    //     $sql2 = "SELECT b.id, b.judul_beasiswa, b.deadline2 , b.pic_normal ,b.univ, b.jurusan_tag,b.penyedia,u.username,
    //     GROUP_CONCAT(DISTINCT p.nama_pendidikan) as jenjang ,
    //     GROUP_CONCAT(DISTINCT n.nama_negara) as negara
    //     from db_scholarship b 
    //     INNER JOIN db_katpendidikan_hub ph on b.id = ph.id_beasiswa
    //     INNER JOIN db_katpendidikan p on ph.id_pendidikan = p.id_pendidikan 
    //     INNER JOIN db_katnegara_hub nh on b.id = nh.id_beasiswa
    //     INNER JOIN db_katnegara n on nh.id_negara = n.id_negara
    //     -- ORDER BY b.deadline
    //     WHERE 
    //     GROUP BY b.tanggal_scrap DESC,b.deadline2 DESC,b.id ASC";
    // }

    $sql = "SELECT  b.id, b.judul_beasiswa, b.deadline2 , b.pic_normal ,b.univ, b.jurusan_tag,b.penyedia,
            b.tipe_beasiswa,p.id_pendidikan,n.id_negara,
        GROUP_CONCAT(DISTINCT j.id_jurusan) as id_jurusan,
        GROUP_CONCAT(DISTINCT p.nama_pendidikan) as jenjang ,
        GROUP_CONCAT(DISTINCT n.nama_negara) as negara
        from db_scholarship b 
        INNER JOIN db_katpendidikan_hub ph on b.id = ph.id_beasiswa
        INNER JOIN db_katpendidikan p on ph.id_pendidikan = p.id_pendidikan 
        INNER JOIN db_katnegara_hub nh on b.id = nh.id_beasiswa
        INNER JOIN db_katnegara n on nh.id_negara = n.id_negara
        INNER JOIN db_katjurusan_hub jh on b.id = jh.id_beasiswa
        INNER JOIN db_katjurusan j on jh.id_jurusan = j.id_jurusan
        INNER JOIN db_simpan s on b.id = s.id_beasiswa
        INNER JOIN db_user u on s.id_user = u.id
        -- INNER JOIN db_userdetail ud on u.id = ud.id_user
        WHERE s.id_user ='$userid' 
        GROUP BY b.id DESC";
         //GROUP BY s.dibuat DESC";
        //}
    }
   
    try {
    $dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);  
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $dbh->query($sql);  
    $beasiswa = $stmt->fetchAll(PDO::FETCH_OBJ);
    
    $dbh = null;
    echo '{"items":'. json_encode($beasiswa) .'}'; 
} catch(PDOException $e) {
    echo '{"error":{"text":'. $e->getMessage() .'}}'; 
}

    // if(mysql_num_rows($q)>0){
    //     while ($row = mysql_fetch_array($result)) {
    //         $output = array('status' => true);
    //     echo json_encode($output);
    // }
    // else{
    //     $output = array('status' => false);
    //     echo json_encode($output);
    // }
        // while ($row = mysql_fetch_array($result)) {
        //     $beasiswa_array   = $row["beasiswalist"];
        // }
        
        // //cek isi array
        // if($beasiswa_array != ""){
        //     //pemisahan array
        //     $beasiswa_cek = explode(",", $beasiswa_array);
        //     $beasiswa = count(array_unique($beasiswa_cek));
        //     //echo $beasiswa_cek;
        //     // foreach ($beasiswa_cek as $key => $value) {
        //     //     echo $value . "<br/>";
        //     // }
        //     // foreach ($beasiswa_cek as $key => $value){ 
        //     // //query ke tabel beasiswa
        //     // $beasiswaku = mysql_query("SELECT id,nama_beasiswa,deskripsi,pic_besar,deadline  FROM db_beasiswa WHERE id='$value'") or die(mysql_error());
        //     // while($row=mysql_fetch_array($beasiswaku)){  
        //     //    $beasiswa[]  = array('id' => $row['id'],
        //     //                     'nama_beasiswa' => $row['nama_beasiswa'],
        //     //                     'deskripsi' => $row['deskripsi'],
        //     //                     'defgambar' => $row['pic_besar'],
        //     //                     'deadline' => $row['deadline']
        //     //                     );

        //     //header('Content-type: application/json');
        //      echo '{"items":'.json_encode($beasiswa).'}';
        //     //echo $beasiswa;
        //     }
           
        // }
            

    //}
//}
?>